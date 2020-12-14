<?php

namespace App\Http\Controllers;

use App\Jenis;
use App\Letak;
use App\Satuan;
use App\Golongan;
use App\Kategori;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = Jenis::orderBy('id_jenis', 'ASC')->get();
        $kategori = Kategori::orderBy('id_kategori', 'ASC')->get();
        $satuan = Satuan::orderBy('id_satuan', 'ASC')->get();
        $letak = Letak::orderBy('id_letak', 'ASC')->get();
        $golongan = Golongan::orderBy('golongan', 'ASC')->get();
        return view('admin.jenis.index', compact('jenis', 'kategori', 'satuan', 'letak', 'golongan'));
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
