<?php

namespace App\Http\Controllers\Admin;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

use App\Models\Detail_barang;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BarangController 
{
    public function index()
    {
        //datatable
        if (request()->ajax()) {
            $data = Barang::with('kategori')->select('id','nama','slug','id_kategori','foto_hover','foto_cover','deskripsi')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('images', function ($data) {
                    return '<img onclick="img_data(' . $data->id . ')" src="' . url("/images/$data->foto_cover") . '" style="width:80px;">';
                })
                ->addColumn('action', function ($row) {
                        $actionBtn = '
                            <center>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $row->id . ')"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="fas fa-trash"></i></a>
                            </center>';

                    return $actionBtn;
                })
                ->rawColumns(['action','images'])
                ->make(true);
        }

        $kategori       = Kategori::select('id', 'nama')->get();

        return view('barang.index',[
            'title'     => 'Barang',
            'kategori'  => $kategori,
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
            'nama'               => 'required',
            'slug'               => 'required',
            'id_kategori'        => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }

        $file = $request->file('foto_cover');
                $file_name = time() . "_" . $file->getClientOriginalName();
                $dir = 'images';
                $file->move($dir, $file_name);

        // $filehover = $request->file('foto_hover');
        //         $file_hover = time() . "_" . $file->getClientOriginalName();
        //             $dir = 'images';
        //             $filehover->move($dir, $file_hover);

        Barang::updateOrCreate(['id' => $request->id],
                [
                    'nama'                => $request->nama,
                    'slug'                => $request->slug,
                    'id_kategori'         => $request->id_kategori,
                    'foto_cover'          => $file_name,
                    'foto_hover'          => $request->nama,
                    'deskripsi'           => $request->deskripsi,
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
        $data = Barang::find($id);
        return response()->json($data);
    }

    public function updateBarang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'nama' => 'required|min:2',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }

        Barang::find($request->id)->update([
                    'nama'                => $request->nama,
                    'slug'                => $request->slug,
                    'id_kategori'         => $request->id_kategori,
                    'foto_cover'          => $request->foto_cover,
                    'foto_hover'          => $request->foto_hover,
                    'deskripsi'           => $request->deskripsi,
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
        $barang = Barang::where('id',$id)->first();
        $ceksatuan = Detail_barang::where('id_barang', $barang->id)->first();

        if($ceksatuan){
            return response()->json(['status'=> false]);
        }else{
            Barang::find($id)->delete();
            return response()->json(['status' => true]);
        }
    }
}
