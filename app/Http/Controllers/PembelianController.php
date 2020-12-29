<?php

namespace App\Http\Controllers;

use App\Ppn;
use App\Letak;
use App\Barang;
use App\Subakun;
use App\Pembelian;
use App\Detailpembelian;
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
        $sub_akun = Subakun::orderBy('id', 'ASC')->get();
        $supplier = DB::table('supplier')->orderBy('id','ASC')->get();
        $now = now()->format('dmY');
        //Set Nota Beli
        $nota_jual = 'BELI';
        $tgl = now()->format('Y-m-d');
        $nota_tgl = now()->format('dmY');
        $data = DB::table('pembelian')->whereDate('created_at', $tgl)->count();
        $angka = '000'.$data;

        $no_faktur = 'PBL'.$nota_tgl.$angka;
        // mengambil nota beli
        $initJurnal = now()->format('Ymd');
        $countJurnal = DB::table('jurnal')->whereDate('tgl_transaksi', $tgl)->count();
        $angkaJurnal = '001'.$countJurnal;
        $no_jurnal = "JRL".$initJurnal.$angkaJurnal;
        return view('admin.pembelian.index', compact('letak','barang','ppn', 'supplier', 'sub_akun','no_faktur','no_jurnal'));
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
        $data = DB::table('supplier')->where('nama',$cari)->first();


        // $data['riwayat'] = DB::select('select * from riwayat where barang_id = ? order by DESC', [$data_id->id]);
        return response()->json($data);
    }

    public function store(Request $request){
        DB::table('pembelian')->insert([
            'no_faktur'     => $request->nota_jual,
            'total_beli'  => $request->total_keseluruhan,
            'suplier_id'      => $request->supplier_id,
            'letak_id'      => $request->id_letak,
            'potongan_beli'  => 0,
            'ppn_beli'      => $request->harga_ppn,
            'tagihan_beli'  => $request->tagihan,
            'created_at'    => $request->tanggal,
            // 'cara_bayar'    => $request->cara_bayar ? 1 : 0

        ]);
        DB::table('jurnal')->insert([
            'no_jurnal'     => $request->no_jurnal,
            'no_bukti'      => $request->no_faktur,
            'tgl_transaksi' => now(),
            'nama'          => $request->no_jurnal.",".$request->no_faktur." Pembelian Obat ".Auth::user()->name,
            'user_id'       => Auth::id()
        ]);
    	foreach($request->jual as $key => $value){
            DB::table('detail_beli')->insert([
                'no_faktur' => $request->nota_jual,
                'barang_id' => $value['id'],
                'supplier_id' => $request->supplier_id,
                'jml_beli' => $value['qty'],
                'harga_beli' => $value['harga_umum'],
                'subtotal' => $value['subtotal'],
                'diskon' => $value['diskon'],
                'total' => $value['total'],
            ]);
    		$cari_stok = DB::table('stok_per_lokasi')->where(['id_barang'=>$value['id'],'id_letak'=>$request->id_letak])->first();
            DB::table('riwayat')->insert([
                'barang_id' => $value['id'],
                'stok_awal' => $cari_stok->stok,
                'stok_akhir' => $cari_stok->stok+$value['qty'],
                'masuk' => $value['qty'],
                'keluar' => 0,
                'bagian' => 'Pembelian',
                'tanggal' => $request->tanggal,
                'user_id'=>Auth::id(),
                'letak_id' => $request->id_letak,
                'aksi' => 'Simpan',
                'no_faktur' => $request->nota_jual
            ]);
            $cari_stok = DB::table('stok_per_lokasi')->where(['id_barang'=>$value['id'],'id_letak'=>$request->id_letak])->update(['stok'=>$cari_stok->stok+$value['qty']]);
    	}
    	
        
        Session::flash('message', 'Data Pembelian berhasil ditambahkan');
        return redirect()->route('report-beli');
    }

    public function report(Request $request)
    {
        $now = now()->format('Y-m-d');
        $year = now()->format('Y');
        $month = now()->format('m');
        $lastmonth = now()->format('m') - 1;
        $cari = $request->get('cari');
        $data['a'] = 0;
        if($cari == 'semua'){
            $carijudul = 'Semua';
            $report_beli = Pembelian::orderBy('created_at', 'DESC')->get();

        }elseif($cari == 'hariini'){
            $carijudul = 'Hari Ini';
            $report_beli = Pembelian::orderBy('created_at', 'DESC')->where('created_at',$now)->get();

        }elseif($cari == 'bulanini'){
            $carijudul = 'Bulan Ini';
            $report_beli = Pembelian::orderBy('created_at', 'DESC')->whereMonth('created_at',$month)->get();
            
        }elseif($cari == 'bulanlalu'){
            $carijudul = 'Bulan Lalu';
            $report_beli = Pembelian::orderBy('created_at', 'DESC')->whereMonth('created_at',$lastmonth)->get();
            
        }elseif($cari == 'tahunini'){
            $carijudul = 'Tahun Ini';
            $report_beli = Pembelian::orderBy('created_at', 'DESC')->whereYear('created_at',$year)->get();
        }elseif($cari == 'filter'){
            $data['ke'] = $request->get('ke');
            $data['dari'] = $request->get('dari');
            $carijudul = 'Filter';
            $report_beli = Pembelian::orderBy('created_at', 'DESC')->whereBetween('created_at',[$data['dari'],$data['ke']])->get();
            
        }else{
            $carijudul = 'Hari Ini';
            $report_beli = Pembelian::orderBy('created_at', 'DESC')->where('created_at',$now)->get();
        }

        return view('admin.pembelian.report', compact('report_beli','cari','carijudul','data'));
    }

    public function detail(Pembelian $pembelian)
    {
        $nama_supplier = DB::table('supplier')->where('id',$pembelian->suplier_id)->first();

        $detail_beli = Detailpembelian::orderBy('no_faktur', 'ASC')
                        ->join('pembelian', 'pembelian.no_faktur', '=', 'detail_beli.no_faktur')
                        ->join('barang', 'barang.id', '=', 'detail_beli.barang_id')
                        ->join('supplier', 'supplier.id', '=', 'detail_beli.supplier_id')
                        ->select('detail_beli.no_faktur', 'barang.nama', 'barang.harga_beli', 'detail_beli.jml_beli', 'detail_beli.harga_beli', 'detail_beli.subtotal', 'detail_beli.diskon', 'detail_beli.total','supplier.nama as nama_supplier')
                        ->where('detail_beli.no_faktur', $pembelian->no_faktur)
                        ->get();
        // print_r($pembelian->nota_jual); die();
        return view('admin.pembelian.detail', compact('pembelian', 'detail_beli', 'nama_supplier'));
    }

    public function cetak_nota(Pembelian $pembelian)
    {
        $today = Carbon::now()->isoFormat('D MMMM Y');
        $nama_supplier = DB::table('supplier')->where('id',$pembelian->suplier_id)->first();
        $detail_beli = Detailpembelian::orderBy('no_faktur', 'ASC')
                            ->join('pembelian', 'pembelian.no_faktur', '=', 'detail_beli.no_faktur')
                            ->join('barang', 'barang.id', '=', 'detail_beli.barang_id')
                            ->join('supplier', 'supplier.id', '=', 'detail_beli.supplier_id')
                            ->select('detail_beli.no_faktur', 'barang.nama', 'barang.harga_beli', 'detail_beli.jml_beli', 'detail_beli.harga_beli as harga', 'detail_beli.subtotal', 'detail_beli.diskon', 'detail_beli.total','supplier.nama as nama_supplier')
                            ->where('detail_beli.no_faktur', $pembelian->no_faktur)
                            ->get();
        $ppn = DB::table('set_ppn_jual')->first();
        $judul = "Nota pembelian ".$pembelian->no_faktur;
        return view('admin.pembelian.nota', compact('pembelian','judul', 'detail_beli','ppn','today','nama_supplier'));
    }

    public function retur(Request $request){
        $cari = $request->get('cari');
        $now = now()->format('Y-m-d');
        $year = now()->format('Y');
        $month = now()->format('m');
        $lastmonth = now()->format('m')-1;
        $data['a'] = 0;
        if($cari == 'semua'){
            $carijudul = 'Semua';
            $list_data = Pembelian::orderBy('created_at','DESC')->get();

        }elseif($cari == 'hariini'){
            $carijudul = 'Hari Ini';
            $list_data = Pembelian::orderBy('created_at','DESC')->where('created_at',$now)->get();

        }elseif($cari == 'bulanini'){
            $carijudul = 'Bulan Ini';
            $list_data = Pembelian::orderBy('created_at','DESC')->where('created_at',$month)->get();
            
        }elseif($cari == 'bulanlalu'){
            $carijudul = 'Bulan Lalu';
            $list_data = Pembelian::orderBy('created_at','DESC')->whereMonth('created_at',$lastmonth)->get();
            
        }elseif($cari == 'tahunini'){
            $carijudul = 'Tahun Ini';
            $list_data = Pembelian::orderBy('created_at','DESC')->whereYear('created_at',$year)->get();
            
        }elseif($cari == 'filter'){
            $carijudul = 'Filter';
            $data['dari'] = $request->get('dari');
            $data['ke'] = $request->get('ke');
            $list_data = Pembelian::orderBy('created_at','DESC')->whereBetween('created_at',[$data['dari'],$data['ke']])->get();
            
        }else{
            $carijudul = 'Hari Ini';
            $list_data = Pembelian::orderBy('created_at','DESC')->where('created_at',$now)->get();

        }
        return view('admin.pembelian.retur', compact('list_data','cari','carijudul','data'));
    }

    public function hapus($no){
        $list = Detailpembelian::join('barang', 'barang.id', '=', 'detail_beli.barang_id')
                        ->select('detail_beli.*','barang.stok_minimal')
                        ->where('detail_beli.no_faktur',$no)
                        ->get();
        foreach ($list as $key) {
            $barang = Barang::where('id',$key->barang_id)->update(['stok_minimal'=>$key->stok_minimal-$key->jml_beli]);
        }
        Pembelian::where('no_faktur',$no)->delete();
        Session::flash('delete-message', 'Berhasil diretur');
        return redirect()->route('retur-pembelian');
    }
}
