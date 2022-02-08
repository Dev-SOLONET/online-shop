<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alamat_pengiriman;
use App\Models\Detail_penjualan;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

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

        //buat kode penjualan
        $kodePenjualan  = date('Y-m-d') . '-' . rand();
        foreach ($keranjang as $data) {
            $subtotal += $data->qty * $data->detail_barang->harga;

            // buat array untuk memasukan data keranjang ke detail penjualan
            $array = [
                'kode_penjualan'    => $kodePenjualan,
                'id_detail_barang'  => $data->id_detail_barang,
                'qty'               => $data->qty,
                'harga'             => $data->detail_barang->harga
            ];

            $barang[] = $array;
        }

        //masukan data ke detail penjualan
        Detail_penjualan::insert($barang);

        //buat transaksi di penjualan
        Penjualan::create([
            'kode_penjualan'    => $kodePenjualan,
            'tgl'               => date('Y-m-d'),
            'id_user'           => Auth::user()->id,
            'ongkir'            => $request->ongkir,
            'total'             => $subtotal + $request->ongkir,
            'status'            => '',
        ]);

        //simpan alamat pengiriman
        Alamat_pengiriman::create([
            'kode_penjualan'    => $kodePenjualan,
            'origin'            => config('rajaongkir.origin', '445'),
            'destination'       => $request->kota,
            'courier'           => $request->kurir,
            'weight'            => 1,
            'service'           => $request->service,
            'alamat'            => $request->alamat,
        ]);

        //hapus data keranjang
        Keranjang::where('id_user', Auth::user()->id)->delete();

        //ambil data user
        $user   = User::find(Auth::user()->id);

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
                'order_id'      => $kodePenjualan,
                'gross_amount'  => intval($subtotal + $request->ongkir),
            ],
            'customer_details' => [
                'first_name'   => $request->name,
                'email'        => $user->email,
                'phone'        => $request->telp,
            ],
            'vtweb' => []
        );

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($params)->redirect_url;

            return redirect($paymentUrl);

            // Redirect to Snap Payment Page
            header('Location: ' . $paymentUrl);
        } catch (Exception $e) {
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
        } catch (Exception $e) {
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

    public function notificationCallback()
    {

        // config midtrans
        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = config('midtrans.isProduction');

        try {
            $notif = new Notification();
        } catch (\Exception $e) {
            exit($e->getMessage());
        }

        $notif = $notif->getResponse();
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    echo "Transaction order_id: " . $order_id . " is challenged by FDS";
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    echo "Transaction order_id: " . $order_id . " successfully captured using " . $type;
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            echo "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
        }
    }
}
