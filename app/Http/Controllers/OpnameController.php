<?php

namespace App\Http\Controllers;

use App\Letak;
use App\Barang;
use App\Opname;
use App\Stokgudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OpnameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $barang = Barang::orderBy('nama', 'ASC')->get();
    //     $letak = Letak::orderBy('id_letak', 'ASC')->get();
    //     $total_barang = Barang::orderBy('nama', 'ASC')->count();
    //     return view('admin.opname.index', compact('barang', 'letak', 'total_barang'));
    // }

    //tlong jan di hapus
    public function index()
    {
        $barang = Barang::orderBy('nama', 'ASC')->with('jenis', 'golongan')->get();
        //relasi
        // $barang = Barang::orderBy('nama', 'ASC')->with('jenis', 'golongan', '')->take(2)->get();
        // limit
        // dd($barang);
        $letak = Letak::orderBy('id_letak', 'ASC')->get();
        $total_barang = Barang::orderBy('nama', 'ASC')->count();
        return view('admin.opname.index', compact('barang', 'letak', 'total_barang'));
        // return view('admin.opname.index', ['barang' => $barang, 'kampret' => $letak]);
    }
    public function loaddata(Request $request)
    {
        // if ($request->has('q')) {
        //     $cari = $request->q;
        //     $data = DB::table('barang')->select('id', 'nama', 'harga_beli')->where('nama', 'LIKE', '%$cari%')->get();
        //     return response()->json($data);
        // }
        $cari = $request->input('cari');
<<<<<<< HEAD
        // $data['a'] = DB::table('barang')->where('nama', 'LIKE'  , "%{$cari}%")->get();
        
        $data_id = DB::select('select * from barang where nama = ?', [$cari]);
        $data['a'] = DB::select('select * from barang where nama = ?', [$cari]);
        $data['riwayat'] = DB::select('select stok_akhir from riwayat where barang_id = ? order by DESC', [$data_id->id]);
        // $data['b'] = 'dd';
=======
        $data['a'] = DB::table('barang')->select('*')->where('nama', "%{$cari}%")->get();
        $data['b'] = 'dd';
>>>>>>> naufal
        return response()->json($data);
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
        $cek_stok_akhir = $request->stok;
        
        $request->validate([
            'angka.*.real'=>'required'
            ]);
        foreach ($request->angka as $key => $value) {
                $id_barang = $value['id'];
                // dd($id_barang);
                // $query_cek = DB::select('select barang_id, stok_akhir from riwayat where barang_id = ?', [$id_barang]);

                // if(count($query_cek) === 0) {
                //     echo('Data Obat Belum Ada');
                // } else {
                //     echo('data sudah ada');
                // }

                // die();
            print_r($value); die();
            // $data = new Opname;
            // $data->stok = $request->value;
            // $data->save();
            // Stokgudang::create($value);
        }
        // die();
        
        return redirect()->route('opname.index');
        
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
}
