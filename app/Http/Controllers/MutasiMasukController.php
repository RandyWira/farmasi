<?php

namespace App\Http\Controllers;

use App\Letak;
use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MutasiMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $letak = Letak::orderBy('letak', 'ASC')->get();
        $barang = Barang::orderBy('nama', 'ASC')->get();
        $tgl = now()->format('Y-m-d');
        $nota_tgl = now()->format('dmY');
        $data = DB::table('mutasi_masuk')->whereDate('tanggal', $tgl)->count();
        $angka = '000'.$data;
        $total_barang = Barang::orderBy('nama', 'ASC')->count();

        // mengambil nota jual
        $no_mutasi = 'MM'.$nota_tgl.$angka;
        return view('admin.mutasi_masuk.index', compact('letak', 'barang', 'no_mutasi','total_barang'));
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
        foreach ($request->mutasi_masuk as $key => $value) {
            $id_barang = $value['id'];

            DB::table('detail_mutasi_masuk')->insert([
                'no_mutasi' => $request->no_mutasi,
                'barang_id' => $value['id'],
                'jml'       => $value['qty'],
                'harga_beli' => $value['harga_beli'],
                'sub_total' => $value['subtotal']
            ]);
            $cari_stok = DB::table('stok_per_lokasi')->where(['id_barang'=>$value['id'],'id_letak'=>$request->id_letak])->first();

            DB::table('riwayat')->insert([
                'barang_id' => $value['id'],
                'stok_awal' => $cari_stok->stok,
                'stok_akhir' => $cari_stok->stok+$value['qty'],
                'masuk' => $value['qty'],
                'keluar' => 0,
                'bagian' => 'Mutasi Masuk',
                'user_id'=>Auth::id(),
                'letak_id' => $request->id_letak,
                'aksi' => 'Simpan',
                'tanggal' => $request->tanggal,
                'no_faktur' => $request->no_mutasi
            ]);
            $cari_stok = DB::table('stok_per_lokasi')->where(['id_barang'=>$value['id'],'id_letak'=>$request->id_letak])->update(['stok'=>$cari_stok->stok+$value['qty']]);
        }

            DB::table('mutasi_masuk')->insert([
                'no_mutasi'     => $request->no_mutasi,
                'dari'          => $request->dari,
                'letak_id'      => $request->id_letak,
                'tanggal'       => $request->tanggal
                // 'cara_bayar'    => $request->cara_bayar ? 1 : 0
            ]);

            Session::flash('message', 'Data Mutasi Masuk berhasil ditambahkan');
            return redirect()->route('report');
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
