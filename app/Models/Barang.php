<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'id_kategori',
        'foto_cover',
        'foto_hover',
        'deskripsi',
    ];

    protected $table = 'barang';
}
