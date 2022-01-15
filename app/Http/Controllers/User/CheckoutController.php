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
            'snapToken'  => $this->snapToken(),
        ]);
    }

    public function snapToken(){
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return $snapToken;
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
