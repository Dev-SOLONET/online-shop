<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat_pengiriman extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_penjualan',
        'origin',
        'destination',
        'courier',
        'weight',
        'alamat',
    ];

    protected $table = 'alamat_pengiriman';

}
