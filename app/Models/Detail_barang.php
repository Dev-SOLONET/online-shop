<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barang',
        'size',
        'harga',
        'stok',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class,'id_barang');
    }

    protected $table = 'detail_barang';

}
