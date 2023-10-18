<?php

namespace App\Models;

use App\Models\Penilaian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilSmart extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class);
    }
}
