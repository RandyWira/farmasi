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

class PembelianController extends Controller
{
    public function index(){
    	$ppn = Ppn::orderBy('ppn', 'ASC')->first();
        $letak = Letak::orderBy('letak', 'ASC')->get();
        $barang = Barang::orderBy('nama', 'ASC')->get();
        // $stok_akhir = Barang::orderBy('nama', 'ASC')
        //             ->join('riwayat', 'riwayat.barang_id', '=', 'barang.id')
        //             ->select('barang.*', 'riwayat.stok_akhir')
        //             ->get();
        $supplier = DB::table('supplier')->orderBy('id','ASC')->get();
        //Set Nota Jual
        $now = now()->format('dmY');
        // $nota_jual = 'JUAL';

        // $tgl = now()->format('Y-m-d');
        // $nota_tgl = now()->format('dmY');
        // $data = DB::table('pembelian')->whereDate('created_at', $tgl)->count();
        // $angka = '000'.$data;

        // mengambil nota jual
        // $no_nota = 'PBL'.$nota_tgl.$angka;

        return view('admin.pembelian.index', compact('letak','barang','ppn', 'supplier'));
    }

    public function store(Request $request){
    	foreach($request->jual as $key => $value){
    		$cari_stok = DB::table('stok_per_lokasi')->where(['id_barang'=>$value['id'],'id_letak'=>$request->id_letak])->first();
            DB::table('riwayat')->insert([
                'barang_id' => $value['id'],
                'stok_awal' => $cari_stok->stok,
                'stok_akhir' => $cari_stok->stok+$value['qty'],
                'masuk' => 0,
                'keluar' => $value['qty'],
                'bagian' => 'Pembelian',
                'user_id'=>Auth::id(),
                'letak_id' => $request->id_letak,
                'aksi' => 'Simpan'
            ]);
            $cari_stok = DB::table('stok_per_lokasi')->where(['id_barang'=>$value['id'],'id_letak'=>$request->id_letak])->update(['stok'=>$cari_stok->stok-$value['qty']]);
    	}
    	DB::table('pembelian')->insert([
            'no_faktur'     => $request->nota_jual,
            'total_beli'  => $request->total_keseluruhan,
            'suplier_id'      => $request->supplier,
            'letak_id'      => $request->id_letak,
            'potongan_beli'  => 0,
            'ppn_beli'      => $request->harga_ppn,
            'tagihan_beli'  => $request->tagihan,
            'created_at'    => $request->tanggal,
            // 'cara_bayar'    => $request->cara_bayar ? 1 : 0

        ]);
        Session::flash('message', 'Data Pembelian berhasil ditambahkan');
        return redirect()->route('pembelian.index');
    }
}
