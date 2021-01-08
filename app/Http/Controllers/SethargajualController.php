<?php

namespace App\Http\Controllers;

use App\Sethargajual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SethargajualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $set_harga_jual = Sethargajual::orderBy('id_jenis', 'ASC')
                                ->join('jenis', 'jenis.id_jenis', '=', 'set_harga_jual.id_jenis')
                                ->select('set_harga_jual.*', 'jenis.nama')
                                ->get();
        return view('admin.set_harga_jual.index', compact('set_harga_jual'));
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
        //
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
    public function edit(Sethargajual $set_harga_jual)
    {
        return view('admin.set_harga_jual.edit', compact('set_harga_jual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sethargajual $set_harga_jual)
    {
        $set_harga_jual->h_grosir = $request->harga_grosir;
        $set_harga_jual->h_langganan = $request->harga_langganan;
        $set_harga_jual->h_umum = $request->harga_umum;
        $set_harga_jual->save();

        Session::flash('message', 'Persentase keuntungan penjualan Berhasil diubah');
        return redirect()->route('set_harga_jual.index');
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
