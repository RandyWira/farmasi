<?php

namespace App\Http\Controllers;

use App\Ppn;
use App\Letak;
use App\Barang;
use App\Penjualan;
use App\Detailpenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ppn = Ppn::orderBy('ppn', 'ASC')->first();
        $letak = Letak::orderBy('letak', 'ASC')->get();
        $barang = Barang::orderBy('nama', 'ASC')->get();
        // $stok_akhir = Barang::orderBy('nama', 'ASC')
        //             ->join('riwayat', 'riwayat.barang_id', '=', 'barang.id')
        //             ->select('barang.*', 'riwayat.stok_akhir')
        //             ->get();
        
        //Set Nota Jual
        $now = now()->format('dmY');
        $nota_jual = 'JUAL';

        $tgl = now()->format('Y-m-d');
        $nota_tgl = now()->format('dmY');
        $data = DB::table('penjualan')->whereDate('created_at', $tgl)->count();
        $angka = '000'.$data;

        // mengambil nota jual
        $no_nota = 'PJL'.$nota_tgl.$angka;

        return view('admin.penjualan.index', compact('letak','barang','ppn', 'angka', 'no_nota'));
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
        foreach($request->jual as $key => $value){
            $id_barang = $value['id'];

            DB::table('detail_jual')->insert([
                'nota_jual' => $request->nota_jual,
                'barang_id' => $value['id'],
                'jml_jual' => $value['qty'],
                'harga_jual' => $value['harga_umum'],
                'subtotal' => $value['subtotal'],
                'diskon' => $value['diskon'],
                'total_jual' => $value['total'],
            ]);
            $cari_stok = DB::table('stok_per_lokasi')->where(['id_barang'=>$value['id'],'id_letak'=>$request->id_letak])->first();
            DB::table('riwayat')->insert([
                'barang_id' => $value['id'],
                'stok_awal' => $cari_stok->stok,
                'stok_akhir' => $cari_stok->stok-$value['qty'],
                'masuk' => 0,
                'keluar' => $value['qty'],
                'bagian' => 'Penjualan',
                'user_id'=>Auth::id(),
                'letak_id' => $request->id_letak,
                'aksi' => 'Simpan'
            ]);
            $cari_stok = DB::table('stok_per_lokasi')->where(['id_barang'=>$value['id'],'id_letak'=>$request->id_letak])->update(['stok'=>$cari_stok->stok-$value['qty']]);
        }

        DB::table('penjualan')->insert([
            'nota_jual'     => $request->nota_jual,
            'nama_pembeli'  => $request->pembeli,
            'letak_id'      => $request->id_letak,
            'nama_pembeli'  => $request->pembeli,
            'total_jual'    => $request->total_keseluruhan,
            'ppn_jual'      => $request->harga_ppn,
            'tagihan_jual'  => $request->tagihan,
            'created_at'    => $request->tanggal,
            'hpp'           => $request->total_hpp,
            'bayar'         => $request->bayar,
            'kembalian'     => $request->kembalian
            // 'cara_bayar'    => $request->cara_bayar ? 1 : 0

        ]);
        

        Session::flash('message', 'Data Penjualan berhasil ditambahkan');
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

    public function report()
    {
        $report_jual = Penjualan::orderBy('created_at', 'DESC')->get();

        return view('admin.penjualan.report', compact('report_jual'));
    }

    public function detail(Penjualan $penjualan)
    {

        $detail_jual = Detailpenjualan::orderBy('nota_jual', 'ASC')
                        ->join('penjualan', 'penjualan.nota_jual', '=', 'detail_jual.nota_jual')
                        ->join('barang', 'barang.id', '=', 'detail_jual.barang_id')
                        ->select('detail_jual.nota_jual', 'barang.nama', 'barang.harga_beli', 'detail_jual.jml_jual', 'detail_jual.harga_jual', 'detail_jual.subtotal', 'detail_jual.diskon', 'detail_jual.total_jual')
                        ->where('detail_jual.nota_jual', $penjualan->nota_jual)
                        ->get();
        // print_r($penjualan->nota_jual); die();
        return view('admin.penjualan.detail', compact('penjualan', 'detail_jual'));
    }

    public function cetak_nota(Penjualan $penjualan)
    {
        $today = Carbon::now()->isoFormat('d MMMM Y');
        $detail_jual = Detailpenjualan::orderBy('nota_jual', 'ASC')
                            ->join('penjualan', 'penjualan.nota_jual', '=', 'detail_jual.nota_jual')
                            ->join('barang', 'barang.id', '=', 'detail_jual.barang_id')
                            ->select('detail_jual.nota_jual', 'barang.nama', 'barang.harga_beli', 'detail_jual.jml_jual', 'detail_jual.harga_jual', 'detail_jual.subtotal', 'detail_jual.diskon', 'detail_jual.total_jual')
                            ->where('detail_jual.nota_jual', $penjualan->nota_jual)
                            ->get();
        $ppn = DB::table('set_ppn_jual')->first();
        $judul = "Nota Penjualan ".$penjualan->nota_jual;
        return view('admin.penjualan.nota', compact('penjualan','judul', 'detail_jual','ppn','today'));
    }

}
