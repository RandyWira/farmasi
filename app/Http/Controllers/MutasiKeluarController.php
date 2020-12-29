<?php

namespace App\Http\Controllers;

use App\Letak;
use App\Barang;
use App\Detailmutasikeluar;
use App\Mutasikeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MutasiKeluarController extends Controller
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
        $data = DB::table('mutasi_keluar')->whereDate('tanggal', $tgl)->count();
        $angka = '000'.$data;
        $total_barang = Barang::orderBy('nama', 'ASC')->count();

        // mengambil nota jual
        $no_mutasi = 'MK'.$nota_tgl.$angka;
        return view('admin.mutasi_keluar.index', compact('letak', 'barang', 'no_mutasi','total_barang'));
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

            DB::table('detail_mutasi_keluar')->insert([
                'no_mutasi' => $request->no_mutasi,
                'barang_id' => $value['id'],
                'jml'       => $value['qty'],
                'harga_jual' => $value['harga_beli'],
                'subtotal' => $value['subtotal']
            ]);
            $cari_stok = DB::table('stok_per_lokasi')->where(['id_barang'=>$value['id'],'id_letak'=>$request->id_letak])->first();

            DB::table('riwayat')->insert([
                'barang_id' => $value['id'],
                'stok_awal' => $cari_stok->stok,
                'stok_akhir' => $cari_stok->stok-$value['qty'],
                'masuk' => 0,
                'keluar' => $value['qty'],
                'bagian' => 'Mutasi Keluar',
                'user_id'=>Auth::id(),
                'letak_id' => $request->id_letak,
                'aksi' => 'Simpan',
                'tanggal' => $request->tanggal,
                'no_faktur' => $request->no_mutasi
            ]);
            $cari_stok = DB::table('stok_per_lokasi')->where(['id_barang'=>$value['id'],'id_letak'=>$request->id_letak])->update(['stok'=>$cari_stok->stok-$value['qty']]);
        }

            DB::table('mutasi_keluar')->insert([
                'no_mutasi'     => $request->no_mutasi,
                'ke'          => $request->dari,
                'letak_id'      => $request->id_letak,
                'tanggal'       => $request->tanggal
                // 'cara_bayar'    => $request->cara_bayar ? 1 : 0
            ]);

            Session::flash('message', 'Data Mutasi Keluar berhasil ditambahkan');
            return redirect()->route('report-mutasi-keluar');
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

    public function report(Request $request) 
    {
        $cari = $request->get('cari');
        $now = now()->format('Y-m-d');
        $year = now()->format('Y');
        $month = now()->format('m');
        $lastmonth = now()->format('m')-1;
        $data['a'] = 0;

        if($cari == 'semua'){
            $carijudul = 'Semua';
            $report_mutasi_keluar = Mutasikeluar::orderBy('tanggal', 'DESC')->get();
        }elseif($cari == 'hariini'){
            $carijudul = 'Hari Ini';
            $report_mutasi_keluar = Mutasikeluar::orderBy('tanggal', 'DESC')->where('tanggal',$now)->get();
        }elseif($cari == 'bulanini'){
            $carijudul = 'Bulan Ini';
            $report_mutasi_keluar = Mutasikeluar::orderBy('tanggal', 'DESC')->whereMonth('tanggal',$month)->get();
        }elseif($cari == 'bulanlalu'){
            $carijudul = 'Bulan Lalu';
            $report_mutasi_keluar = Mutasikeluar::orderBy('tanggal', 'DESC')->whereMonth('tanggal',$lastmonth)->get();
        }elseif($cari == 'tahunini'){
            $carijudul = 'Tahun Ini';
            $report_mutasi_keluar = Mutasikeluar::orderBy('tanggal', 'DESC')->whereYear('tanggal',$year)->get();
        }elseif($cari == 'filter'){
            $carijudul = 'Filter';
            $data['dari'] = $request->get('dari');
            $data['ke'] = $request->get('ke');
            $report_mutasi_keluar = Mutasikeluar::orderBy('tanggal', 'DESC')->whereBetween('tanggal',[$data['dari'],$data['ke']])->get();
        }else{
            $carijudul = 'Hari Ini';
            $report_mutasi_keluar = Mutasikeluar::orderBy('tanggal', 'DESC')->where('tanggal',$now)->get();
        }


        return view('admin.mutasi_keluar.report', compact('report_mutasi_keluar','cari','carijudul','data'));
    }

    public function detail(Mutasikeluar $mutasi_keluar)
    {

        $detail_mutasi_keluar = DetailMutasikeluar::orderBy('no_mutasi', 'ASC')
                        ->join('mutasi_keluar', 'mutasi_keluar.no_mutasi', '=', 'detail_mutasi_keluar.no_mutasi')
                        ->join('barang', 'barang.id', '=', 'detail_mutasi_keluar.barang_id')
                        ->select('detail_mutasi_keluar.no_mutasi', 'barang.nama', 'barang.harga_beli as harga_brg', 'detail_mutasi_keluar.jml', 'detail_mutasi_keluar.harga_jual', 'detail_mutasi_keluar.subtotal')
                        ->where('detail_mutasi_keluar.no_mutasi', $mutasi_keluar->no_mutasi)
                        ->get();
        // print_r($mutasi_keluar->nota_jual); die();
        return view('admin.mutasi_keluar.detail', compact('mutasi_keluar', 'detail_mutasi_keluar'));
    }

    public function cetak_nota(Mutasikeluar $mutasi_keluar)
    {
        $today = Carbon::now()->isoFormat('D MMMM Y');
        $detail_mutasi_keluar = DetailMutasikeluar::orderBy('no_mutasi', 'ASC')
                        ->join('mutasi_keluar', 'mutasi_keluar.no_mutasi', '=', 'detail_mutasi_keluar.no_mutasi')
                        ->join('barang', 'barang.id', '=', 'detail_mutasi_keluar.barang_id')
                        ->select('detail_mutasi_keluar.no_mutasi', 'barang.nama', 'barang.harga_beli as harga_brg', 'detail_mutasi_keluar.jml', 'detail_mutasi_keluar.harga_jual', 'detail_mutasi_keluar.subtotal')
                        ->where('detail_mutasi_keluar.no_mutasi', $mutasi_keluar->no_mutasi)
                        ->get();
        $judul = "Laporan Mutasi Masuk".$mutasi_keluar->nota_jual;
        return view('admin.mutasi_keluar.nota', compact('mutasi_keluar','judul', 'detail_mutasi_keluar','today'));
    }
}
