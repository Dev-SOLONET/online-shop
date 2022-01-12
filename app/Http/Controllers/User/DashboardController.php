<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\Kategori;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->get('search')){

            $barang     = Barang::with(['one_detail_barang' => function($query){
                                $query->where('detail_barang.stok', '>', '0');
                            }])->where('nama', 'like', '%'.$request->get('search').'%')->get();

            return view('user.search',[
                'barang'    => $barang,
                'keyword'   => $request->get('search')
            ]);

        }else{

            $barang     = Barang::with(['one_detail_barang' => function($query){
                                        $query->where('detail_barang.stok', '>', '0');
                                    }])->get();

            $kategori   = Kategori::with('barang.one_detail_barang')->limit(3)->get();

            return view('user.dashboard',[
                'barang'    => $barang,
                'kategori'  => $kategori
            ]);

        }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $barang         = Barang::with('many_detail_barang')->where('slug', $slug)->first();
        $relate_barang  = Barang::with('one_detail_barang')->where('nama', 'like', '%'.$barang->nama.'%')->get();
        $new_barang     = Barang::with('one_detail_barang')->where('nama', 'like', '%'.$barang->nama.'%')->orderBy('created_at')->limit(3)->get();

        return view('user.product-detail',[
            'barang'    => $barang,
            'relate'    => $relate_barang,
            'new'       => $new_barang,
        ]);
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
