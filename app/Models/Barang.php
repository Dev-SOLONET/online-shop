<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
        'id_kategori',
        'foto_cover',
        'foto_hover',
        'deskripsi',
    ];

    protected $table = 'barang';

    public function kategori()
    {
        return $this->BelongsTo(Kategori::class,'id_kategori');
    }

    public function one_detail_barang()
    {
        return $this->hasOne(Detail_barang::class,'id_barang');
    }

    public function many_detail_barang()
    {
        return $this->hasMany(Detail_barang::class,'id_barang');
    }

}
