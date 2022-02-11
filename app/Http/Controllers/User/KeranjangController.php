<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Detail_barang;
use Illuminate\Http\Request;
use App\Models\Keranjang;

use Yajra\Datatables\Datatables;

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

        //datatable
        if (request()->ajax()) {

            $query =  Keranjang::with('detail_barang.barang')->where('id_user', Auth::user()->id)->get();

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('gambar', function ($row) {

                    $actionBtn = '
                            <center>
                            <img src="/images/'.$row->detail_barang->barang->foto_cover.'" style="width:50px;">
                            </center>';

                    return $actionBtn;
                })
                ->addColumn('total', function ($row) {

                    $actionBtn = number_format($row->qty * $row->detail_barang->harga);

                    return $actionBtn;
                })
                ->addColumn('harga_produk', function ($row) {

                    $actionBtn = number_format($row->detail_barang->harga);

                    return $actionBtn;
                })
                ->addColumn('cart_qty', function ($row) {

                    $actionBtn = '<div class="qty-box">
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-left-minus" data-type="minus"
                                                            data-field=""><i class="ti-angle-left"></i></button> </span>
                                                <input type="text" name="cart_qty" onchange="edit_cart('.$row->id.')" class="form-control input-number"
                                                    value="'.$row->qty.'"> <span class="input-group-prepend">
                                                <button type="button"
                                                        class="btn quantity-right-plus" data-type="plus"
                                                        data-field=""><i class="ti-angle-right"></i></button></span>
                                            </div>
                                </div>';

                    return $actionBtn;
                })
                ->addColumn('action', function ($row) {

                    $actionBtn = '
                            <center>
                            <a href="javascript:void(0)" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="remove_cart(' . $row->id . ')"><i class="far fa-trash-alt"></i></a>
                            </center>';

                    return $actionBtn;
                })
                ->rawColumns(['action', 'gambar', 'cart_qty'])
                ->make(true);
        }

        return view('user.cart');
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

        $cek                = Keranjang::where('id_user', Auth::user()->id)->where('id_detail_barang', $id_detail_barang->id)->first();

        if ($cek) {

            Keranjang::where('id_user', Auth::user()->id)->where('id_detail_barang', $id_detail_barang->id)->update([
                'qty'           => $request->qty + $cek->qty,
            ]);
        } else {

            Keranjang::create([
                'id_user'               => Auth::user()->id,
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
        $data   = Keranjang::with('detail_barang.barang')->where('id_user', Auth::user()->id)->get();

        return Response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        Keranjang::find($id)->update([
            'qty'           => $request->get('qty'),
        ]);

        return Response()->json(['status' => true]);
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
        Keranjang::find($id)->delete();
        return Response()->json(['status' => true]);
    }
}
