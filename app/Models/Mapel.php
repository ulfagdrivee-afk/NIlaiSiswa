<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mapel'
    ];

       public function nilai() 
    {
        return $this->hasMany(nilai::class, 'mapel_id');
    }
}
