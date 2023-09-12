<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response as StatusCode;

class KriteriaController extends Controller
{
  public function getAll()
  {
    try {
      $data = Kriteria::all();
      return response()->json($data);
    } catch (Exception $ex) {
      return response()->json([
        'code' => $ex->getCode(),
        'message' => $ex->getMessage()
      ]);
    }
  }
}
