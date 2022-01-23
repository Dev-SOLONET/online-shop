<?php

namespace App\Http\Controllers\Admin;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
            $data = Barang::with('kategori')->select('id', 'nama', 'slug', 'id_kategori', 'foto_hover', 'foto_cover', 'deskripsi')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('images', function ($data) {
                    return '<img onclick="img_data(' . $data->id . ')" src="' . url("/images/$data->foto_cover") . '" style="width:80px;">';
                })
                ->addColumn('images_hover', function ($data) {
                    return '<img onclick="img_data(' . $data->id . ')" src="' . url("/imageshover/$data->foto_hover") . '" style="width:80px;">';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                            <center>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $row->id . ')"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="fas fa-trash"></i></a>
                            </center>';

                    return $actionBtn;
                })
                ->rawColumns(['action', 'images', 'images_hover'])
                ->make(true);
        }

        $kategori       = Kategori::select('id', 'nama')->get();

        return view('admin.barang.index', [
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
            'id_kategori'        => 'required',
            'foto_cover'         => 'required',
            'foto_hover'         => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if($request->id){

            $file = $request->file('foto_cover');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $dir = 'images';
            $file->move($dir, $file_name);
    
            $filehover = $request->file('foto_hover');
            $file_hover = time() . "_hv_" . $file->getClientOriginalName();
            $dir = 'images';
            $filehover->move($dir, $file_hover);

            Barang::find($request->id)->update([
                'nama'                => $request->nama,
                'slug'                => Str::slug($request->slug, '-'),
                'id_kategori'         => $request->id_kategori,
                'foto_cover'          => $file_name,
                'foto_hover'          => $file_hover,
                'deskripsi'           => $request->deskripsi,
            ]
        );

        }else{

            $file = $request->file('foto_cover');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $dir = 'images';
            $file->move($dir, $file_name);
    
            $filehover = $request->file('foto_hover');
            $file_hover = time() . "_hv_" . $file->getClientOriginalName();
            $dir = 'images';
            $filehover->move($dir, $file_hover);
    
            Barang::Create([
                    'nama'                => $request->nama,
                    'slug'                => Str::slug($request->slug, '-'),
                    'id_kategori'         => $request->id_kategori,
                    'foto_cover'          => $file_name,
                    'foto_hover'          => $file_hover,
                    'deskripsi'           => $request->deskripsi,
                ]
            );

        }


        return response()->json(['status' => true]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ceksatuan = Detail_barang::where('id_barang', $id)->first();

        if ($ceksatuan) {
            return response()->json(['status' => false]);
        } else {
            Barang::find($id)->delete();
            return response()->json(['status' => true]);
        }
    }
}
