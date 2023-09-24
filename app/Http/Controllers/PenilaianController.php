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

  public function getList(Request $req)
  {
    try {
      
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }

  public function show($id)
  {
    try {
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }

  public function create(Request $req)
  {
    try {
      $validator = Validator::make($req->all(), [
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
        "C4_id" => 'required|numeric',
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
        "C4_nilai" => 'required|numeric',
      ], [
        'required' => ':attribute tidak boleh kosong',
        'numeric' => ':attribute harus berupa angka'
      ]);
      if ($validator->fails()) {
        throw new Exception($validator->errors()->first(), StatusCode::HTTP_BAD_REQUEST);
      }
      // Mengambil data Karyawan
      $queryKaryawan = Karyawan::query()->where('user_id', '=', $req->user_id);
      $dataKaryawan = $queryKaryawan->with('user')->first();
      if (empty($dataKaryawan)) throw new Exception("No Data", StatusCode::HTTP_NOT_FOUND);

      // Debug
      // dd($req->all());
      $data = $req->all();

      // Hitung nilai C1 (C1.1 + C1.2) / 2
      $C1 = round(floatval(($data['C1_1_nilai'] + $data['C1_2_nilai']) / $data['C1_length']));
      // Hitung nilai C2 (C2.1 + C2.2 + C2.3 + C2.4 + C2.5 + C2.6 + C2.7) / 7
      $C2 = round(floatval(($data['C2_1_nilai'] + $data['C2_2_nilai'] + $data['C2_3_nilai'] + $data['C2_4_nilai'] + $data['C2_5_nilai'] + $data['C2_6_nilai'] + $data['C2_7_nilai']) / $data['C2_length']));
      // Hitung nilai C3 (C3.1 + C3.2 + C3.3 + C3.4 + C3.5 + C3.6 + C3.7 + C3.8) / 8
      $C3 = round(floatval(($data['C3_1_nilai'] + $data['C3_2_nilai'] + $data['C3_3_nilai'] + $data['C3_4_nilai'] + $data['C3_5_nilai'] + $data['C3_6_nilai'] + $data['C3_7_nilai'] + $data['C3_8_nilai']) / $data['C3_length']));
      // Nilai C4
      $C4 = round(floatval($data['C4_nilai']));

      // Input nilai ke database
      DB::beginTransaction();
      try {
        // Input Nilai C1
        $insertC1 = Penilaian::create([
          'id_karyawan' => $dataKaryawan->id,
          'id_kriteria' => $data['C1_id'],
          'nilai' => $C1,
        ]);
        // Input Sub-Nilai C1
        for ($i=1; $i <= intval($data['C1_length']); $i++) {
          SubPenilaian::create([
            'id_penilaian' => $insertC1->id,
            'id_sub_kriteria' => $data['C1_' . $i . '_id'],
            'nilai' => $data['C1_' . $i . '_nilai'],
          ]);
        }

        // Input Nilai C2
        $insertC2 = Penilaian::create([
          'id_karyawan' => $dataKaryawan->id,
          'id_kriteria' => $data['C2_id'],
          'nilai' => $C2,
        ]);
        // Input Sub-Nilai C2
        for ($i = 1; $i <= intval($data['C2_length']); $i++) {
          SubPenilaian::create([
            'id_penilaian' => $insertC2->id,
            'id_sub_kriteria' => $data['C2_' . $i . '_id'],
            'nilai' => $data['C2_' . $i . '_nilai'],
          ]);
        }

        // Input Nilai C3
        $insertC3 = Penilaian::create([
          'id_karyawan' => $dataKaryawan->id,
          'id_kriteria' => $data['C3_id'],
          'nilai' => $C3,
        ]);
        // Input Sub-Nilai C3
        for ($i = 1; $i <= intval($data['C3_length']); $i++) {
          SubPenilaian::create([
            'id_penilaian' => $insertC3->id,
            'id_sub_kriteria' => $data['C3_' . $i . '_id'],
            'nilai' => $data['C3_' . $i . '_nilai'],
          ]);
        }

        // Input Nilai C4
        $insertC4 = Penilaian::create([
          'id_karyawan' => $dataKaryawan->id,
          'id_kriteria' => $data['C4_id'],
          'nilai' => $C4,
        ]);
        // Input Sub-Nilai C4
        SubPenilaian::create([
          'id_penilaian' => $insertC4->id,
          'id_sub_kriteria' => $data['C4_id'],
          'nilai' => $data['C4_nilai'],
        ]);
        
        DB::commit();
        return response()->json([
          'message' => 'Berhasil menginput nilai karyawan'
        ], 200);
      } catch (Exception $transEx) {
        DB::rollBack();
        throw new Exception($transEx->getMessage(), StatusCode::HTTP_INTERNAL_SERVER_ERROR);
      }
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }
  
  public function update(Request $req, $id)
  {
    try {
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }

  public function destroy($id)
  {
    try {
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }
}
