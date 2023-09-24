<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kriteria;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

  public function store(Request $req)
  {
    try {
      $validator = Validator::make($req->all(), [
        "user_id" => 'required|numeric',
        "bulan" => 'required|string',
        "tahun" => 'required',
        "C1.1" => 'required|numeric',
        "C1.2" => 'required|numeric',
        "C2.1" => 'required|numeric',
        "C2.2" => 'required|numeric',
        "C2.3" => 'required|numeric',
        "C2.4" => 'required|numeric',
        "C2.5" => 'required|numeric',
        "C2.6" => 'required|numeric',
        "C2.7" => 'required|numeric',
        "C3.1" => 'required|numeric',
        "C3.2" => 'required|numeric',
        "C3.3" => 'required|numeric',
        "C3.4" => 'required|numeric',
        "C3.5" => 'required|numeric',
        "C3.6" => 'required|numeric',
        "C3.7" => 'required|numeric',
        "C3.8" => 'required|numeric',
        "C4" => 'required|numeric',
      ], [
        'required' => ':attribute tidak boleh kosong',
        'numeric' => ':attribute harus berupa angka'
      ]);
      if ($validator->fails()) {
        throw new Exception($validator->errors()->first(), 400);
      }
      // Mengambil data kriteria dengan sub_kriteria
      $kriteria = Kriteria::query()->with('sub_kriteria')->get();
      if (empty($kriteria)) {
        throw new Exception("Data bobot tidak ditemukan", 404);
      }
      // Hitung nilai C1
      
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }
  
}
