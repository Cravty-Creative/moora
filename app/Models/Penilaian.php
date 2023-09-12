<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
  use HasFactory;

  protected $table = 'penilaian';

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'id_karyawan',
    'id_kriteria',
    'nilai',
    'created_at',
    'updated_at',
  ];

  public function karyawan()
  {
    return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id');
  }

  public function kriteria()
  {
    return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id');
  }
}
