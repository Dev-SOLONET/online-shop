<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_user',
        'id_detail_barang',
        'qty',
    ];

    public function detail_barang()
    {
        return $this->hasOne(Detail_barang::class,'id','id_detail_barang');
    }

    protected $table = 'keranjang';

}
