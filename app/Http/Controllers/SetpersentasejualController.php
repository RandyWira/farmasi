<?php

namespace App\Http\Controllers;

use App\Setpersentasejual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SetpersentasejualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $set_persentase_jual = Setpersentasejual::orderBy('id_persen', 'DESC')->get();
        return view('admin.set_harga_jual.index', compact('set_persentase_jual'));
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
    public function edit(Setpersentasejual $set_persentase_jual)
    {
        // dd($set_persentase_jual);
        return view('admin.set_harga_jual.edit', compact('set_persentase_jual'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setpersentasejual $set_persentase_jual)
    {
        $set_persentase_jual->persen_grosir = $request->harga_grosir;
        $set_persentase_jual->persen_langganan = $request->harga_langganan;
        $set_persentase_jual->persen_umum = $request->harga_umum;
        $set_persentase_jual->save();

        Session::flash('message', 'Persentase keuntungan penjualan Berhasil diubah');
        return redirect()->route('set_persentase_jual.index');
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
