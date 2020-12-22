<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Letak;
use App\Riwayat;
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

        // $i = array(1,2);
        // $x = count($i);

        // foreach($i as $a ){
        //     print_r($a++); 
        //     echo "<br>";
        // }
        // die();
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
        // $data['a'] = DB::table('barang')->where('nama', 'LIKE'  , "%{$cari}%")->get();
        $data_id = DB::table('barang')->where('nama',$cari)->first();
        $cari_riwayat = DB::table('riwayat')->where('barang_id',$data_id->id)->get();
        // dd(count($cari_riwayat));
        if(count($cari_riwayat) === 0){
            // $data = DB::table('barang')->where('nama',$cari)->get();
            $data = DB::select('select *, stok_minimal as stok from barang where id = ? limit 1', [$data_id->id]);
        }else{
            $data = DB::select('select barang.*,riwayat.stok_akhir as stok,riwayat.barang_id from barang join riwayat on barang.id = riwayat.barang_id where riwayat.barang_id = ? order by riwayat.barang_id DESC limit 1', [$data_id->id]);
            // $data['b'] = DB::table('riwayat')->where('barang_id',$data_id->id)->with('barang')->limit(1)->orderBy('barang_id','DESC')->first();
        }


        // $data['riwayat'] = DB::select('select * from riwayat where barang_id = ? order by DESC', [$data_id->id]);
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
            // print_r($id_barang); 
                // Riwayat::table('riwayat')->([
                //     ''=>
                // ]);
            // $data = new Opname;
            // $data->stok = $request->value;
            // $data->save();
            // Stokgudang::create($value);
            DB::table('riwayat')->insert([
                'barang_id'=>$value['id'],
                'stok_awal'=>$value['stok'],
                'stok_akhir'=>$value['real'],
                'masuk'=>$value['real'],
                'keluar'=>0,
                'bagian'=>'Opname',
                'aksi'=>'Simpan',
                'letak_id'=>$request->id_letak,
                'user_id'=>Auth::id(),
            ]);
        }
        
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
