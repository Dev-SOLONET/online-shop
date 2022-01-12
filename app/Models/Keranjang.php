<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_user',
        'id_barang',
        'qty',
    ];

    public function barang()
    {
        return $this->hasOne(Barang::class,'id','id_barang');
    }

    protected $table = 'keranjang';

}
