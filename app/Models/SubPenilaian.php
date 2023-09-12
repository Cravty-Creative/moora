<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPenilaian extends Model
{
  use HasFactory;

  protected $table = 'sub_penilaian';

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'id_penilaian',
    'id_sub_kriteria',
    'nilai',
    'created_at',
    'updated_at',
  ];

  public function penilaian()
  {
    return $this->belongsTo(Penilaian::class, 'id_penilaian', 'id');
  }

  public function sub_kriteria()
  {
    return $this->belongsTo(SubKriteria::class, 'id_sub_kriteria', 'id');
  }
}
