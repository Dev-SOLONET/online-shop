<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Detail_barang;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id_detail_barang   = Detail_barang::where('id_barang', $request->id_barang)->where('size', $request->size)->first();
        
        $cek                = Keranjang::where('id_user', '1')->where('id_detail_barang', $id_detail_barang->id)->first();
        
        if($cek){

            Keranjang::where('id_user', '1')->where('id_detail_barang', $id_detail_barang->id)->update([
                'qty'           => $request->qty + $cek->qty,
            ]);

        }else{

            Keranjang::create([
                'id_user'               => '1',
                'id_detail_barang'      => $id_detail_barang->id,
                'qty'                   => $request->qty,
            ]);

        }


        return Response()->json(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data   = Keranjang::with('detail_barang.barang')->where('id_user', '1')->get();

        return Response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
