<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'siswa_id',
        'mapel_id',
        'nilai_tugas',
        'nilai_uts',
        'nilai_uas',
        'nilai_akhir',
        'kategori',
    ];


    public function Mapel() 
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
    public function Siswa() 
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
