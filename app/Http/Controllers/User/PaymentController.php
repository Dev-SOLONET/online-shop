<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
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
        //ambil data keranjang user
        $keranjang = Keranjang::with('detail_barang')
                        ->where('id_user', Auth::user()->id)
                        ->get();
        //hitung subtotal barang di keranjang 
        $subtotal = 0;
        foreach($keranjang as $data){
            $subtotal += $data->qty * $data->detail_barang->harga;
        }
        

        // config midtrans
        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('midtrans.is3ds');

        //buat parameter yg akan di kirimkan ke midtrans
        $params = array(
            'transaction_details' => [
                'order_id'      => rand(),
                'gross_amount'  => intval($subtotal + $request->ongkir),
            ],
            'enabled_payments'  => ['gopay'],
            'vtweb' => []
        );
        
        try {
          // Get Snap Payment Page URL
          $paymentUrl = Snap::createTransaction($params)->redirect_url;

          return redirect($paymentUrl);

          // Redirect to Snap Payment Page
          header('Location: ' . $paymentUrl);
        }
        catch (Exception $e) {
          echo $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // config midtrans
        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('midtrans.isProduction');
        // Set sanitization on (default)
        Config::$isSanitized = config('midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        Config::$is3ds = config('midtrans.is3ds');

        //buat parameter yg akan di kirimkan ke midtrans
        $params = [
            'transaction_details' => [
                'order_id'      => rand(),
                'gross_amount'  => 10000000,
            ],
            'enabled_payments'  => ['gopay'],
            'vtweb' => []
        ];

        try {
          // Get Snap Payment Page URL
          $paymentUrl = Snap::createTransaction($params)->redirect_url;

          return redirect($paymentUrl);

          // Redirect to Snap Payment Page
          header('Location: ' . $paymentUrl);
        }
        catch (Exception $e) {
          echo $e->getMessage();
        }
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
