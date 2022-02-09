<?php

namespace App\Http\Controllers\Admin;

use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\Detail_penjualan;
use App\Models\Alamat_pengiriman;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    public function index()
    {
    
        // $data = Penjualan::with('detailpenjualan','alamatpengiriman')->get();
        // return $data;
        
        //datatable
        if (request()->ajax()) {
        $data = Penjualan::with('detailpenjualan','alamatpengiriman')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('price', function ($row) {
                    $actionBtn = number_format($row->harga);

                return $actionBtn;
            })
                ->addColumn('action', function ($row) {
                        $actionBtn = '
                            <center>
                            <a href="transaksi/'.'1'.'?kode=' . $row->kode_penjualan . '" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Barang"><i class="fas fa-search"></i></a>
                            </center>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $detail       = Detail_penjualan::select('id','kode_penjualan','id_detail_barang','qty','harga')->get();
        $alamat       = Alamat_pengiriman::select('id','kode_penjualan','destination','courier','origin','service','weight','alamat')->get();

        return view('admin.transaksi.index',[
            'title'     => 'Transaksi Penjualan',
            'detail'    => $detail,
            'alamat'    => $alamat,
        ]);
    }

    function show($id, Request $request)
    {
        $kode       = $request->get('kode');
        $po  = Penjualan::with('detailpenjualan','alamatpengiriman')->get();

        // $po         = Purchase_order::with('distributor')->where('kode_po', $kode)->get();
        // $pembelian  = Pembelian::select('no_invoice')->where('kode_po', $kode)->first();

        // $barang     = Detail_purchase_order::with('barang.satuan')->where('kode_po', $kode)->get();

        return view('admin.transaksi.detail', [
            'title'     => 'Detail Penjualan',
            'po'    =>  $po,
            // 'barang'    =>  $barang,
            // 'pembelian' =>  $pembelian,
            'kode'      =>  $kode
        ]);
    }
}
