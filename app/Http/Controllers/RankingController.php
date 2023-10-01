<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\SubPenilaian;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response as StatusCode;

class RankingController extends Controller
{
  public function index()
  {
    return view('pages.ranking');
  }

  public function getList(Request $req)
  {
    try {
      // Ambil data kriteria
      $kriteria = Kriteria::query()->get();
      $countAll = Karyawan::query()->get()->count();
      $queryData = Karyawan::query();
      // Get All Data karyawan sesuai periode penilaian
      $queryData = Karyawan::query()->with('penilaian', 'penilaian.sub_penilaian')->whereHas('penilaian', function ($subquery) use ($req) {
        if ($req->has('bulan') && !empty($req->bulan) && $req->has('tahun') && !empty($req->tahun)) {
          $subquery->where('periode', 'LIKE', '%' . $req->bulan . " " . $req->tahun . '%');
        }
      });
      if ($req->has('departemen') && !empty($req->departemen)) {
        $queryData->where('departemen', 'LIKE', '%' . $req->departemen . '%');
      }
      $queryData = $queryData->orderBy('kode', 'ASC')->get();
      // dd($queryData);
      /**
       * Perhitungan Ranking berdasarkan rumus Moora
       */
      // Normalisasi (X*ij)
      // Mencari nilai pembagi
      $sum_pangkat = array();
      foreach ($kriteria as $item) {
        $sum_pangkat[$item->kode] = 0;
      }
      // Loop berdasarkan jumlah Karyawan
      foreach ($queryData as $item) {
        // Loop jumlah nilai pangkat C1 - C4
        for ($i=0; $i < count($item->penilaian); $i++) { 
          $nilai_pangkat = pow(intval($item->penilaian[$i]->nilai), 2);
          $sum_pangkat['C' . ($i + 1)] += $nilai_pangkat;
        }
      }
      $pembagi = array();
      foreach ($kriteria as $item) {
        $pembagi[$item->kode] = round(sqrt(floatval($sum_pangkat[$item->kode])), 8);
      }
      // Mencari normalisasi Xij
      $normalisasi = array();
      foreach ($queryData as $item) {
        for ($i=0; $i < count($item->penilaian); $i++) {
          $hasil_bagi = round($item->penilaian[$i]->nilai / $pembagi['C' . ($i + 1)], 8);
          array_push($normalisasi, ['C' . ($i + 1) => $hasil_bagi]);
          $item->penilaian[$i]->nilai_normalisasi = $hasil_bagi;
        }
      }
      // Nilai Optimum (Y*n)
      $optimum = array();
      foreach ($queryData as $item) {
        $nilai_optimum = 0;
        for ($i=0; $i < count($item->penilaian); $i++) { 
          $nilai_x_bobot = round(floatval($item->penilaian[$i]->nilai_normalisasi * $kriteria[$i]->bobot), 8);
          $nilai_optimum += $nilai_x_bobot;
        }
        $item->nilai_optimum = round($nilai_optimum, 8);
        $optimum[$item->kode] = round($nilai_optimum, 8);
      }
      // Menentukan Ranking
      // Copy data ke array baru
      $data_ranking = array();
      foreach ($queryData as $item) {
        $row_data = array();
        $row_data['id'] = $item->id;
        $row_data['kode'] = $item->kode;
        $row_data['nama'] = $item->nama;
        $row_data['title'] = $item->jabatan;
        $row_data['departemen'] = $item->departemen;
        $row_data['nilai'] = $item->nilai_optimum;
        $data_ranking[] = $row_data;
      }
      // Mengurutkan Ranking
      array_multisort(array_column($data_ranking, 'nilai'), SORT_DESC, $data_ranking);

      // generate menjadi DataTable
      $data = array();
      $rank_number = 1;
      foreach ($data_ranking as $item) {
        $row = array();
        $row[] = $rank_number++;
        $row[] = $item['kode'];
        $row[] = $item['nama'];
        $row[] = $item['title'];
        $row[] = $item['departemen'];
        $row[] = $item['nilai'];
        $data[] = $row;
      }

      return response()->json([
        "draw" => $req->draw ?: 10,
        "recordsTotal" => $countAll,
        "recordsFiltered" => $countAll,
        "data" => $data,
        "sum_pangkat" => $sum_pangkat,
        "pembagi" => $pembagi,
        "normalisasi" => $normalisasi,
        "nilai_optimum" => $optimum,
        "data_ranking" => $data_ranking,
        "kriteria" => $kriteria,
        "karyawan" => $queryData
      ]);
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }
}
