<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_penjualan',
        'tgl',
        'id_user',
        'ongkir',
        'status',
        'total'
    ];

    protected $table = 'penjualan';

    public function detailpenjualan()
    {
        return $this->BelongsTo(Detail_penjualan::class,'kode_penjualan','kode_penjualan');
    }

    public function alamatpengiriman()
    {
        return $this->BelongsTo(Alamat_pengiriman::class,'kode_penjualan','kode_penjualan');
    }

}
