<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Karyawan;
use App\Models\User;
use App\Models\DateTime;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response as StatusCode;

class KaryawanController extends Controller
{
  private function validasiUsername($username)
  {
    // Validasi username
    $user = User::query()->where('username', '=', $username)->first();
    if (!empty($user)) {
      return ['status' => false, 'message' => 'Username sudah ada'];
    }
    else {
      return ['status' => true, 'message' => 'Username tersedia'];
    }
  }

  private function validasiEmail($email)
  {
    // Validasi email
    $user = User::query()->where('email', '=', $email)->first();
    if (!empty($user)) {
      return ['status' => false, 'message' => 'Email sudah ada'];
    } else {
      return ['status' => true, 'message' => 'Email tersedia'];
    }
  }

  private function validasiNik($nik)
  {
    // Validasi NIK Karyawan
    $karyawan = Karyawan::query()->where('nik', '=', $nik)->first();
    if (!empty($karyawan)) {
      return ['status' => false, 'message' => 'NIK sudah ada'];
    } else {
      return ['status' => true, 'message' => 'NIK tersedia'];
    }
  }

  public function index()
  {
    return view('pages.karyawan');
  }

  public function create(Request $req)
  {
    try {
      // Validasi input
      $validator = Validator::make($req->all(), [
        'username' => 'required|string|min:4',
        'email' => 'required|email',
        'password' => 'required|string|min:6',
        'nama' => 'required|string',
      ], [
        'required' => ':attribute harus diisi',
        'min' => ':attribute minimal :min karakter',
        'string' => ':attribute harus string'
      ]);
      // Kondisi validator gagal
      if ($validator->fails()) {
        throw new Exception($validator->errors()->first(), StatusCode::HTTP_BAD_REQUEST);
      }

      // Validasi email
      $validasiEmail = $this->validasiEmail($req->email);
      if (!$validasiEmail['status']) {
        throw new Exception($validasiEmail['message'], StatusCode::HTTP_UNPROCESSABLE_ENTITY);
      }

      //validasi username
      $validasiUsername = $this->validasiUsername($req->username);
      if (!$validasiUsername['status']) {
        throw new Exception($validasiUsername['message'], StatusCode::HTTP_UNPROCESSABLE_ENTITY);
      }

      if (!empty($req->nik)) {
        // Validasi NIK
        $validasiNIK = $this->validasiNik($req->nik);
        if (!$validasiNIK['status']) {
          throw new Exception($validasiNIK['message'], StatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }
      }
      
      // Generate Kode Karyawan
      $kode = "A";
      $count = Karyawan::query()->get()->count();
      $kode .= ($count + 1);
      // Mulai input data user dan karyawan ke database dengan SQL Transaction
      DB::beginTransaction();
      try {
        // Create data user
        $newUser = [
          'role' => Role::Karyawan,
          'username' => $req->username,
          'email' => $req->email,
          'password' => Crypt::encrypt($req->password),
          'created_at' => DateTime::Now()
        ];
        $iduser = User::create($newUser)->id;
        // Create data karyawan
        $newKaryawan = [
          'user_id' => $iduser,
          'kode' => $kode,
          'nama' => $req->nama,
          'nik' => $req->nik ?? '-',
          'jabatan' => $req->jabatan ?? '-',
          'departemen' => $req->departemen ?? '-',
          'created_at' => DateTime::Now()
        ];
        Karyawan::create($newKaryawan);
        DB::commit();
        return response()->json([
          'code' => StatusCode::HTTP_OK,
          'message' => "Data berhasil dibuat"
        ]);
      } catch (QueryException $qe) {
        DB::rollBack();
        throw new Exception($qe->getCode() . ": " . $qe->getMessage(), StatusCode::HTTP_INTERNAL_SERVER_ERROR);
      }
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }

  public function getAll()
  {
    try {
      $data = Karyawan::all();
      return response()->json($data);
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }

  public function getList(Request $req)
  {
    $countAll = Karyawan::query()->get()->count();
    $queryData = Karyawan::query();
    // Filter
    if ($req->has('nama') && !empty($req->nama)) {
      $queryData->where('nama', 'LIKE', '%'.$req->nama.'%');
    }
    if ($req->has('nik') && !empty($req->nik)) {
      $queryData->where('nik', 'LIKE', '%'.$req->nik.'%');
    }
    if ($req->has('jabatan') && !empty($req->jabatan)) {
      $queryData->where('jabatan', 'LIKE', '%'.$req->jabatan.'%');
    }
    if ($req->has('departemen') && !empty($req->departemen)) {
      $queryData->where('departemen', 'LIKE', '%'.$req->departemen.'%');
    }
    // Join ke user
    $queryData = $queryData->with('user')->orderBy('kode', 'ASC')->get();
    $data = array();
    $i = 1;
    foreach ($queryData as $item) {
      $row = array();
      $row[] = $i++;
      $row[] = $item->kode;
      $row[] = $item->nama;
      $row[] = $item->user->email;
      $row[] = $item->user->role;
      $row[] = date('Y-m-d H:i:s', strtotime($item->created_at));
      $row[] = '<button type="button" class="btn btn-info btn-link" href="" data-original-title="" data_id="' . $item->id . '" title="" onclick="ShowDetail(this)">
                  <span class="ripple-container">Edit</span>
                </button>
                <button type="button" class="btn btn-danger btn-link" data-original-title="" data_id="' . $item->id . '" title="" onclick="Delete(this)">
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
  }

  public function show($id)
  {
    try {
      $data = Karyawan::query()->where('id', '=', $id)->with('user')->first();
      if (empty($data)) throw new Exception("No Data", StatusCode::HTTP_NOT_FOUND);
      
      return response()->json($data);
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
      $queryKaryawan = Karyawan::query()->where('id', '=', $id);
      $data = $queryKaryawan->with('user')->first();
      if (empty($data) || empty($data->user)) throw new Exception("No Data", StatusCode::HTTP_NOT_FOUND);

      // Validasi email jika diubah
      if (!empty($req->email) && $req->email != $data->user->email) {
        $validasiEmail = $this->validasiEmail($req->email);
        if (!$validasiEmail['status']) {
          throw new Exception($validasiEmail['message'], StatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }
      }

      // Validasi username jika diubah
      if (!empty($req->username) && $req->username != $data->user->username) {
        $validasiUsername = $this->validasiUsername($req->username);
        if (!$validasiUsername['status']) {
          throw new Exception($validasiUsername['message'], StatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }
      }

      // Validasi nik jika diubah
      if (!empty($req->nik) && $req->nik != $data->nik) {
        $validasiNIK = $this->validasiNik($req->nik);
        if (!$validasiNIK['status']) {
          throw new Exception($validasiNIK['message'], StatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }
      }

      DB::beginTransaction();
      try {
        // Update data karyawan
        $queryKaryawan->update([
          'nama' => $req->nama,
          'nik' => $req->nik,
          'jabatan' => $req->jabatan,
          'departemen' => $req->departemen,
          'updated_at' => DateTime::Now(),
        ]);
        User::query()->where('id', '=', $data->user->id)->update([
          'username' => $req->username,
          'email' => $req->email,
          'password' => Crypt::encrypt($req->password),
          'updated_at' => DateTime::Now(),
        ]);
        DB::commit();
        return response()->json([
          'code' => StatusCode::HTTP_OK,
          'message' => "Data berhasil diubah"
        ]);
      } catch (QueryException $qe) {
        DB::rollBack();
        throw new Exception($qe->getCode() . ": " . $qe->getMessage(), StatusCode::HTTP_INTERNAL_SERVER_ERROR);
      }
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
      $queryKaryawan = Karyawan::query()->where('id', '=', $id);
      $data = $queryKaryawan->with(['user', 'penilaian'])->first();
      if (empty($data) || empty($data->user)) throw new Exception("No Data", StatusCode::HTTP_NOT_FOUND);

      if ($data->penilaian->count() > 0) throw new Exception("Tidak bisa menghapus data karena sudah memiliki penilaian", StatusCode::HTTP_NOT_ACCEPTABLE);

      DB::beginTransaction();
      try {
        // Delete data karyawan
        $queryKaryawan->delete();
        User::query()->where('id', '=', $data->user->id)->delete();
        DB::commit();
        return response()->json([
          'code' => StatusCode::HTTP_OK,
          'message' => "Data berhasil dihapus",
        ]);
      } catch (QueryException $qe) {
        DB::rollBack();
        throw new Exception($qe->getCode() . ": " . $qe->getMessage(), StatusCode::HTTP_INTERNAL_SERVER_ERROR);
      }
      return response()->json([
        'code' => StatusCode::HTTP_OK,
        'message' => 'Success'
      ]);
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }
}
