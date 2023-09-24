<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
  use HasFactory;

  protected $table = 'sub_kriteria';

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'id_kriteria',
    'nama',
    'detail',
  ];

  public $timestamps = false;

  public function kriteria()
  {
    return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id');
  }

  public function poin()
  {
    return $this->hasMany(Poin::class, 'id_sub_kriteria', 'id');
  }
}
