<?php

namespace App\Models;

use App\Models\Penilaian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tahun(){
        return $this->belongsTo(Tahun::class);
    }
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}
