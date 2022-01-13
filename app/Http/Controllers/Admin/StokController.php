<?php

namespace App\Http\Controllers\Admin;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Detail_barang;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StokController 
{
    public function index()
    {
        //datatable
        if (request()->ajax()) {
            $data = Detail_barang::with('barang')->select('id','id_barang','size','harga','stok')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                        $actionBtn = '
                            <center>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $row->id . ')"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="fas fa-trash"></i></a>
                            </center>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $barang       = Barang::select('id', 'nama')->get();

        return view('stok.index',[
            'title'     => 'Stok',
            'barang'  => $barang,
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
        $validator = Validator::make($request->all(), [
            'id_barang'   => 'required',
            'size'        => 'required',
            'harga'       => 'required',
            'stok'        => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }

        Detail_barang::updateOrCreate(['id' => $request->id],
                [
                    'id_barang'          => $request->id_barang,
                    'size'               => $request->size,
                    'harga'              => $request->harga,
                    'stok'               => $request->stok,
                ]);   
   
        return response()->json(['status'=> true]);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Detail_barang::find($id);
        return response()->json($data);
    }

    public function updateStok(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'        => 'required',
            'id_barang' => 'required|min:2',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }

        Detail_barang::find($request->id)->update([
                    'id_barang'          => $request->id_barang,
                    'size'               => $request->size,
                    'harga'              => $request->harga,
                    'stok'               => $request->stok,
                ]);    
        
        return response()->json(['status'=> true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Detail_barang::find($id)->delete();
        return response()->json(['status'=> true]);
        
    }
}
