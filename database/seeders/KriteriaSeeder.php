<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Kriteria::create([
        'kode_kriteria' => 'c1',
        'nama_kriteria' => 'hasil psikotes',
        'bobot' => '20',
        'label' => 'benefit'
       ]);
       Kriteria::create([
        'kode_kriteria' => 'c2',
        'nama_kriteria' => 'usia',
        'bobot' => '10',
        'label' => 'const'
       ]);
       Kriteria::create([
        'kode_kriteria' => 'c3',
        'nama_kriteria' => 'pengalaman',
        'bobot' => '20',
        'label' => 'benefit'
       ]);
       Kriteria::create([
        'kode_kriteria' => 'c4',
        'nama_kriteria' => 'wawancara',
        'bobot' => '20',
        'label' => 'benefit'
       ]);
       Kriteria::create([
        'kode_kriteria' => 'c5',
        'nama_kriteria' => 'penguasaan aspek teknik',
        'bobot' => '30',
        'label' => 'benefit'
       ]);
    }
}
