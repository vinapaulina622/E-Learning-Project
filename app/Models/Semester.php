<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $table = 'semester';
    protected $fillable = ['semester'];

    public function kontrak_matakuliah()
    {
        return $this->hasMany(Kontrak::class);
    }
}
