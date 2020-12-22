<?php

namespace App\Http\Controllers;

use App\Jenis;
use App\Letak;
use App\Barang;
use App\Satuan;
use App\Golongan;
use App\Kategori;
use App\Stokperlokasi;
use App\Setpersentasejual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::orderBy('nama', 'ASC')
                    ->join('satuan', 'satuan.id_satuan', '=', 'barang.id_satuan')
                    ->select('barang.*', 'satuan.satuan')
                    ->paginate(20);
        return view('admin.barang.index', compact('barang'));
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = Jenis::orderBy('nama', 'ASC')->pluck('nama', 'id_jenis');
        $set_persentase_jual = Setpersentasejual::orderBy('id_persen', 'DESC')->limit(1)->get();
        $golongan = Golongan::orderBy('golongan', 'ASC')->get();
        $kategori = Kategori::orderBy('nama', 'ASC')->get();
        // $letak = Letak::orderBy('letak', 'ASC')->pluck('letak', 'id_letak');
        $satuan = Satuan::orderBy('satuan', 'ASC')->get();
        return view('admin.barang.create', compact('jenis', 'golongan', 'kategori', 'satuan', 'set_persentase_jual'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "nama" => 'required',
            "harga_modal" => 'required',
            "stok_minimal" => 'required',
            "expire" => 'required'
        ]);

        $barang = new Barang();
        $barang->nama = $request->nama;
        $barang->stok_minimal = $request->stok_minimal;
        $barang->harga_beli = $request->harga_modal;
        $barang->harga_grosir = $request->harga_grosir;
        $barang->harga_langganan = $request->harga_langganan;
        $barang->harga_umum = $request->harga_umum;
        $barang->expire = $request->expire;
        $barang->id_jenis = $request->id_jenis;
        $barang->id_golongan = $request->id_golongan;
        $barang->id_kategori = $request->id_kategori;
        $barang->id_satuan = $request->id_satuan;
        $barang->save();
        
        DB::table('barang');
        $id = DB::getPdo()->lastInsertId();
        
        $stok_gudang = new Stokperlokasi();
        $stok_gudang->id_letak = $request->id_letak;
        $stok_gudang->id_barang = $id;
        
        $stok_gudang->save();



        Session::flash('message', 'Data barang berhasil ditambahkan');
        return redirect()->route('barang.create');
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
    public function edit(Barang $barang)
    {
        $jenis = Jenis::orderBy('nama', 'ASC')->pluck('nama', 'id_jenis');
        $set_persentase_jual = Setpersentasejual::orderBy('id_persen', 'DESC')->limit(1)->get();
        $golongan = Golongan::orderBy('golongan', 'ASC')->get();
        $kategori = Kategori::orderBy('nama', 'ASC')->get();
        // $letak = Letak::orderBy('letak', 'ASC')->get();
        $satuan = Satuan::orderBy('satuan', 'ASC')->get();
        print_r($barang->nama); die();
        return view('admin.barang.edit', compact('jenis', 'set_persentase_jual', 'golongan', 'kategori', 'satuan', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        // $this->validate($request, [
        //     'nama' => 'required',
        //     "harga_modal" => 'required',
        //     "stok_minimal" => 'required',
        //     "expire" => 'required'
        // ]);
        
        // $barang->update([
        //     'nama'              => $request->nama,
        //     'stok_minimal'      => $request->stok_minimal,
        //     'harga_beli'        => $request->harga_modal,
        //     'harga_grosir'      => $request->harga_grosir,
        //     'harga_langganan'   => $request->harga_langganan,
        //     'harga_umum'        => $request->harga_umum,
        //     'expire'            => $request->expire,
        //     'id_jenis'          => $request->id_jenis,
        //     'id_golongan'       => $request->id_golongan,
        //     'id_kategori'       => $request->id_kategori,
        //     'id_satuan'         => $request->id_satuan
        // ]);

        $barang->nama = $request->nama;
        $barang->stok_minimal = $request->stok_minimal;
        $barang->harga_beli = $request->harga_modal;
        $barang->harga_grosir = $request->harga_grosir;
        $barang->harga_langganan = $request->harga_langganan;
        $barang->harga_umum = $request->harga_umum;
        $barang->expire = $request->expire;
        $barang->id_jenis = $request->id_jenis;
        $barang->id_golongan = $request->id_golongan;
        $barang->id_kategori = $request->id_kategori;
        $barang->id_satuan = $request->id_satuan;
        $barang->save();

        // echo $query;
        // die();

        Session::flash('message', 'Data Barang Berhasil diubah');
        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        Session::flash('delete-message', 'Data Barang berhasil dihapus');
        return redirect()->route('barang.index');
    }
}
