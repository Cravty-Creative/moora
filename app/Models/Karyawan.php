<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
  use HasFactory;

  protected $table = 'karyawan';

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'user_id',
    'kode',
    'nama',
    'nik',
    'jabatan',
    'departemen',
    'created_at',
    'updated_at',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function penilaian()
  {
    return $this->hasMany(Penilaian::class, 'id_karyawan', 'id');
  }
}
