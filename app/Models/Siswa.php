<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nisn',
        'nama_lengkap',
        'kelas',
        'tanggal_lahir',
    ];

      public function nilai() 
    {
        return $this->hasMany(NIlai::class, 'siswa_id');
    }
}