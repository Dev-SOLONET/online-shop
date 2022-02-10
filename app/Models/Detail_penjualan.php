<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_penjualan',
        'id_detail_barang',
        'qty',
        'harga'
    ];

    protected $table = 'detail_penjualan';

    public function barang()
    {
        return $this->belongsTo(Barang::class,'id_detail_barang');
    }
}
