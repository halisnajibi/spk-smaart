<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function karyawan(){
        return $this->belongsTo(Karyawan::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function hasil()
    {
        return $this->hasOne(HasilSmart::class, 'penilaian_id');
    }
}
