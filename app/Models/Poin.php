<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poin extends Model
{
  use HasFactory;

  protected $table = 'poin';

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'id_sub_kriteria',
    'keterangan',
    'poin',
  ];

  public $timestamps = false;

  public function sub_kriteria()
  {
    return $this->belongsTo(SubKriteria::class, 'id_sub_kriteria', 'id');
  }
}
