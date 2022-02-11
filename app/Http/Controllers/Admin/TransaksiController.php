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
use Illuminate\Support\Facades\Http;


class TransaksiController extends Controller
{
    public function index()
    {
        // $detailpenjualan     = Detail_penjualan::with('barang')->get();
        // $data = Penjualan::with('detailpenjualan','alamatpengiriman')->get();
        // return $detailpenjualan;
        
        //datatable
        if (request()->ajax()) {
        $data = Penjualan::with('detailpenjualan','alamatpengiriman')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($row) {
                    return date("d F Y", strtotime($row->tgl));
                })
                ->addColumn('total_nominal', function ($row) {
                    return number_format($row->total);
                })
                ->addColumn('total_ongkir', function ($row) {
                    return number_format($row->ongkir);
                })
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

    public function get_city(Request $request){

        $key = config('rajaongkir.key', '');

        $response = Http::get('https://api.rajaongkir.com/starter/city', [
            'key'          => $key,
            'province'     => $request->get('province_id')
        ]);

        $data = json_decode($response, true);

        return $data['rajaongkir']['results'];

    }

    function show($id, Request $request)
    {
       

        // return $data['rajaongkir']['results'];
        
        $kode                = $request->get('kode');
        $po                  = Penjualan::with('alamatpengiriman')->where('kode_penjualan', $kode)->get();
        $detailpenjualan     = Detail_penjualan::with('barang')->where('kode_penjualan', $kode)->get();
        // $alamat              = Alamat_pengiriman::select('destination')->where('kode_penjualan', $kode)->get();

        $alamat   = DB::table('alamat_pengiriman')
                    ->select('destination')
                    ->where('kode_penjualan', $kode)
                    ->first();
        
        $asal   = DB::table('alamat_pengiriman')
                    ->select('origin')
                    ->where('kode_penjualan', $kode)
                    ->first();

        $key = config('rajaongkir.key', '');

        $response = Http::get('https://api.rajaongkir.com/starter/city', [
            'key'          => $key,
            'id'           => $alamat->destination
        ]);

        $city = json_decode($response, true);


        $responseasal = Http::get('https://api.rajaongkir.com/starter/city', [
            'key'          => $key,
            'id'           => $asal->origin
        ]);

        $hasilasal = json_decode($responseasal, true);

        // return $city;

        return view('admin.transaksi.detail', [
            'title'           => 'Detail Penjualan',
            'po'              =>  $po,
            'detailpenjualan' =>  $detailpenjualan,
            'city'            =>  $city,
            'hasilasal'       =>  $hasilasal
        ]);
    }
}
