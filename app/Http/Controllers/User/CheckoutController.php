<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data   =  Keranjang::with('detail_barang.barang')->where('id_user', '1')->get();
        $user   = Auth::user();
        $province   = $this->get_province();

        return view('user.checkout',[
            'data'  => $data,
            'user'  => $user,
            'province'  => $province,
        ]);
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
    public function show($id)
    {
        //
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

    // raja ongkir 

    public function get_province(){

        $key = config('services.rajaongkir.key', '');

        $response = Http::get('https://api.rajaongkir.com/starter/province', [
            'key'       => $key
        ]);

        $data = json_decode($response, true);

        return $data['rajaongkir']['results'];
    }

    public function get_city(Request $request){

        $key = config('services.rajaongkir.key', '');

        $response = Http::get('https://api.rajaongkir.com/starter/city', [
            'key'          => $key,
            'province'     => $request->get('province_id')
        ]);

        $data = json_decode($response, true);

        return $data['rajaongkir']['results'];

    }

    public function get_cost(Request $request){

        $key = config('services.rajaongkir.key', '');

        $response = Http::post('https://api.rajaongkir.com/starter/cost', [
            'key'           => $key,
            'origin'        => '445',
            'destination'   => $request->get('destination'),
            'weight'        => 1,
            'courier'       => $request->get('courier'),
        ]);

        $data = json_decode($response, true);

        return $data['rajaongkir']['results'][0]['costs'];

    }
}
