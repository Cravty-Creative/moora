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

class PenilaianController extends Controller
{
  public function index()
  {
    return view('pages.penilaian');
  }

  // Notes: Data tampil hanya sesuai periode yang dipilih
  public function getList(Request $req)
  {
    try {
      $countAll = Karyawan::query()->get()->count();
      $queryData = Karyawan::query();
      // Join ke penilaian dan filter
      $queryData = $queryData->with('penilaian', function ($subquery) use ($req) {
        if ($req->has('bulan') && !empty($req->bulan) && $req->has('tahun') && !empty($req->tahun)) {
          $subquery->where('periode', 'LIKE', '%' . $req->bulan . " " . $req->tahun . '%');
        }
      })
      ->whereHas('penilaian', function ($subquery) use ($req) {
        if ($req->has('bulan') && !empty($req->bulan) && $req->has('tahun') && !empty($req->tahun)) {
          $subquery->where('periode', 'LIKE', '%' . $req->bulan . " " . $req->tahun . '%');
        }
      });
      // Filter Karyawan
      if ($req->has('nama') && !empty($req->nama)) {
        $queryData->where('nama', 'LIKE', '%' . $req->nama . '%');
      }
      if ($req->has('departemen') && !empty($req->departemen)) {
        $queryData->where('departemen', 'LIKE', '%' . $req->departemen . '%');
      }
      $queryData = $queryData->orderBy('kode', 'ASC')->get();
      // dd($queryData);
      $data = array();
      $i = 1;
      foreach ($queryData as $item) {
        $row = array();
        $row[] = $i++;
        $row[] = $item->kode;
        $row[] = $item->nama;
        $row[] = $item->departemen;
        $row[] = $item->penilaian[0]->periode;
        $row[] = $item->penilaian[0]->nilai;
        $row[] = $item->penilaian[1]->nilai;
        $row[] = $item->penilaian[2]->nilai;
        $row[] = $item->penilaian[3]->nilai;
        $row[] = '<button type="button" class="btn btn-info btn-link" href="" data-original-title="" data_id="' . $item->id . '" data_periode="' . $item->penilaian[0]->periode . '" title="" onclick="ShowDetail(this)">
                  <span class="ripple-container">Edit</span>
                </button>
                <button type="button" class="btn btn-danger btn-link" data-original-title="" data_id="' . $item->id . '" data_periode="' . $item->penilaian[0]->periode . '" title="" onclick="Delete(this)">
                  <span class="ripple-container">Hapus</span>
                </button>';
        $data[] = $row;
      }
      return response()->json([
        "draw" => $req->draw ?: 10,
        "recordsTotal" => $countAll,
        "recordsFiltered" => $countAll,
        "data" => $data,
      ]);
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }

  public function show(Request $req)
  {
    try {
      $dataPenilaian = Penilaian::query()->where('id_karyawan', '=', $req->id)->where('periode', '=', $req->periode)
                        ->with('sub_penilaian')->get();
      $dataKaryawan = Karyawan::query()->where('id', '=', $req->id)->first();
      $data = [
        'karyawan' => $dataKaryawan,
        'penilaian' => $dataPenilaian
      ];
      if (empty($data)) throw new Exception("No Data", StatusCode::HTTP_NOT_FOUND);

      return response()->json($data);
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }

  // Fungsi Penilaian
  public function create(Request $req)
  {
    try {
      $validator = $this->validasiNilai($req);
      if ($validator->fails()) {
        throw new Exception($validator->errors()->first(), StatusCode::HTTP_BAD_REQUEST);
      }
      // Mengambil data Karyawan
      $queryKaryawan = Karyawan::query()->where('user_id', '=', $req->user_id);
      $dataKaryawan = $queryKaryawan->with('user')->first();
      if (empty($dataKaryawan)) throw new Exception("No Data", StatusCode::HTTP_NOT_FOUND);

      $periode = $req->bulan . " " . $req->tahun;
      // Validasi data duplicate
      $checkPenilaian = Penilaian::query()->where('id_karyawan', '=', $dataKaryawan->id)->where('periode', '=', $periode)->get();
      if ($checkPenilaian->count() > 0) throw new Exception("Data penilaian karyawan " . $dataKaryawan->nama . " pada periode " . $periode . " sudah ada", StatusCode::HTTP_UNPROCESSABLE_ENTITY);

      // Mengambil data kriteria
      $dataKriteria = Kriteria::query()->get();
      $countKriteria = $dataKriteria->count();

      // Debug
      // dd($req->all());
      $data = $req->all();

      // Hitung nilai
      $nilai = array();
      // Hitung nilai C1 (C1.1 + C1.2) / 2
      $nilai['C1'] = round(floatval(($data['C1_1_nilai'] + $data['C1_2_nilai']) / $data['C1_length']));
      // Hitung nilai C2 (C2.1 + C2.2 + C2.3 + C2.4 + C2.5 + C2.6 + C2.7) / 7
      $nilai['C2'] = round(floatval(($data['C2_1_nilai'] + $data['C2_2_nilai'] + $data['C2_3_nilai'] + $data['C2_4_nilai'] + $data['C2_5_nilai'] + $data['C2_6_nilai'] + $data['C2_7_nilai']) / $data['C2_length']));
      // Hitung nilai C3 (C3.1 + C3.2 + C3.3 + C3.4 + C3.5 + C3.6 + C3.7 + C3.8) / 8
      $nilai['C3'] = round(floatval(($data['C3_1_nilai'] + $data['C3_2_nilai'] + $data['C3_3_nilai'] + $data['C3_4_nilai'] + $data['C3_5_nilai'] + $data['C3_6_nilai'] + $data['C3_7_nilai'] + $data['C3_8_nilai']) / $data['C3_length']));
      // Nilai C4
      $nilai['C4'] = round(floatval($data['C4_1_nilai']));

      // Input nilai ke database
      DB::beginTransaction();
      try {
        for ($index=1; $index <= $countKriteria; $index++) {
          // Input Nilai Karyawan
          $insert = Penilaian::create([
            'id_karyawan' => $dataKaryawan->id,
            'id_kriteria' => $data['C' . $index . '_id'],
            'nilai' => $nilai['C' . $index],
            'periode' => $periode,
          ]);
          // Input Sub-Nilai Karyawan
          for ($i = 1; $i <= intval($data['C' . $index . '_length']); $i++) {
            SubPenilaian::create([
              'id_penilaian' => $insert->id,
              'id_sub_kriteria' => $data['C' . $index . '_' . $i . '_id'],
              'nilai' => $data['C' . $index . '_' . $i . '_nilai'],
            ]);
          }
        }
        DB::commit();
        return response()->json([
          'code' => StatusCode::HTTP_OK,
          'message' => 'Berhasil menginput nilai karyawan'
        ], 200);
      } catch (Exception $SqlEx) {
        DB::rollBack();
        throw new Exception($SqlEx->getMessage(), StatusCode::HTTP_INTERNAL_SERVER_ERROR);
      }
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }
  
  // Masih undone
  public function update(Request $req, $id)
  {
    try {
      $validator = $this->validasiNilai($req);
      if ($validator->fails()) {
        throw new Exception($validator->errors()->first(), StatusCode::HTTP_BAD_REQUEST);
      }

      // Mengambil data Karyawan
      $queryKaryawan = Karyawan::query()->where('user_id', '=', $id);
      $dataKaryawan = $queryKaryawan->with('user')->first();
      if (empty($dataKaryawan)) throw new Exception("No Data", StatusCode::HTTP_NOT_FOUND);

      // Mengambil data kriteria
      $dataKriteria = Kriteria::query()->get();
      $countKriteria = $dataKriteria->count();

      // Debug
      // dd($req->all());
      $data = $req->all();

      // Hitung nilai
      $nilai = array();
      // Hitung nilai C1 (C1.1 + C1.2) / 2
      $nilai['C1'] = round(floatval(($data['C1_1_nilai'] + $data['C1_2_nilai']) / $data['C1_length']));
      // Hitung nilai C2 (C2.1 + C2.2 + C2.3 + C2.4 + C2.5 + C2.6 + C2.7) / 7
      $nilai['C2'] = round(floatval(($data['C2_1_nilai'] + $data['C2_2_nilai'] + $data['C2_3_nilai'] + $data['C2_4_nilai'] + $data['C2_5_nilai'] + $data['C2_6_nilai'] + $data['C2_7_nilai']) / $data['C2_length']));
      // Hitung nilai C3 (C3.1 + C3.2 + C3.3 + C3.4 + C3.5 + C3.6 + C3.7 + C3.8) / 8
      $nilai['C3'] = round(floatval(($data['C3_1_nilai'] + $data['C3_2_nilai'] + $data['C3_3_nilai'] + $data['C3_4_nilai'] + $data['C3_5_nilai'] + $data['C3_6_nilai'] + $data['C3_7_nilai'] + $data['C3_8_nilai']) / $data['C3_length']));
      // Nilai C4
      $nilai['C4'] = round(floatval($data['C4_1_nilai']));

      // Update nilai ke database
      DB::beginTransaction();
      try {
        for ($index = 1; $index <= $countKriteria; $index++) {
          // Input Nilai Karyawan
          $update = Penilaian::query()
            ->where('id_karyawan', '=', $dataKaryawan->id)
            ->where()
            ->update([
              'id_karyawan' => $dataKaryawan->id,
              'id_kriteria' => $data['C' . $index . '_id'],
              'nilai' => $nilai['C' . $index],
              'periode' => $req->bulan . " " . $req->tahun,
            ]);
          // Input Sub-Nilai Karyawan
          for ($i = 1; $i <= intval($data['C' . $index . '_length']); $i++) {
            SubPenilaian::query()->where()->update([
              'id_penilaian' => $insert->id,
              'id_sub_kriteria' => $data['C' . $index . '_' . $i . '_id'],
              'nilai' => $data['C' . $index . '_' . $i . '_nilai'],
            ]);
          }
        }
        DB::commit();
        return response()->json([
          'code' => StatusCode::HTTP_OK,
          'message' => 'Berhasil mengupdate nilai karyawan'
        ], 200);
      } catch (Exception $SqlEx) {
        DB::rollBack();
        throw new Exception($SqlEx->getMessage(), StatusCode::HTTP_INTERNAL_SERVER_ERROR);
      }
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }

  public function destroy(Request $req)
  {
    try {
      // Mengambil data Karyawan
      $dataKaryawan = Karyawan::query()->where('id', '=', $req->id_karyawan)->first();
      if (empty($dataKaryawan)) throw new Exception("No Data", StatusCode::HTTP_NOT_FOUND);

      // Delete smua data penilaian karyawan tsb
      Penilaian::query()
        ->where('id_karyawan', '=', $dataKaryawan->id)
        ->where('periode', '=', $req->periode)
        ->delete();
      
      return response()->json([
        'code' => StatusCode::HTTP_OK,
        'message' => 'Delete Success'
      ]);
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }

  private function validasiNilai(Request $req) {
    return Validator::make($req->all(), [
      "user_id" => 'required|numeric',
      "bulan" => 'required|string',
      "tahun" => 'required',
      "C1_id" => 'required|numeric',
      "C2_id" => 'required|numeric',
      "C3_id" => 'required|numeric',
      "C4_id" => 'required|numeric',
      "C1_length" => 'required|numeric',
      "C2_length" => 'required|numeric',
      "C3_length" => 'required|numeric',
      "C4_length" => 'required|numeric',
      "C1_1_id" => 'required|numeric',
      "C1_2_id" => 'required|numeric',
      "C2_1_id" => 'required|numeric',
      "C2_2_id" => 'required|numeric',
      "C2_3_id" => 'required|numeric',
      "C2_4_id" => 'required|numeric',
      "C2_5_id" => 'required|numeric',
      "C2_6_id" => 'required|numeric',
      "C2_7_id" => 'required|numeric',
      "C3_1_id" => 'required|numeric',
      "C3_2_id" => 'required|numeric',
      "C3_3_id" => 'required|numeric',
      "C3_4_id" => 'required|numeric',
      "C3_5_id" => 'required|numeric',
      "C3_6_id" => 'required|numeric',
      "C3_7_id" => 'required|numeric',
      "C3_8_id" => 'required|numeric',
      "C4_1_id" => 'required|numeric',
      "C1_1_nilai" => 'required|numeric',
      "C1_2_nilai" => 'required|numeric',
      "C2_1_nilai" => 'required|numeric',
      "C2_2_nilai" => 'required|numeric',
      "C2_3_nilai" => 'required|numeric',
      "C2_4_nilai" => 'required|numeric',
      "C2_5_nilai" => 'required|numeric',
      "C2_6_nilai" => 'required|numeric',
      "C2_7_nilai" => 'required|numeric',
      "C3_1_nilai" => 'required|numeric',
      "C3_2_nilai" => 'required|numeric',
      "C3_3_nilai" => 'required|numeric',
      "C3_4_nilai" => 'required|numeric',
      "C3_5_nilai" => 'required|numeric',
      "C3_6_nilai" => 'required|numeric',
      "C3_7_nilai" => 'required|numeric',
      "C3_8_nilai" => 'required|numeric',
      "C4_1_nilai" => 'required|numeric',
    ], [
      'required' => ':attribute tidak boleh kosong',
      'numeric' => ':attribute harus berupa angka'
    ]);
  }
}
