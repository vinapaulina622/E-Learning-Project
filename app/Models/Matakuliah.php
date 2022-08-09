<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;
    protected $table = 'matakuliah';
    protected $fillable = ['nama_matakuliah', 'sks'];

    public function absen()
    {
        return $this->hasMany(Absen::class);
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
