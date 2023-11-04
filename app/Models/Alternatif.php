<?php

namespace App\Models;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\HasilSmart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alternatif extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'alternatif_id');
    }
    public function karyawan()
    {
        return $this->belongsTo(Alternatif::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
    public function tahun()
    {
        return $this->belongsTo(Tahun::class);
    }
    public function hasil()
    {
        return $this->hasOne(HasilSmart::class);
    }
}
