<?php

namespace App\Http\Controllers;

use App\Golongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.golongan.create');
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
            "golongan" => 'required|unique:golongan'
        ],
            [
                'golongan.unique' => 'Golongan telah ada',
            ]
    );

        $golongan = new Golongan();
        $golongan->golongan = $request->golongan;
        $golongan->save();

        Session::flash('message', 'Data Golongan berhasil ditambahkan !! ');
        return redirect()->route('golongan.create');
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
    public function edit(Golongan $golongan)
    {
        return view('admin.golongan.edit', compact('golongan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Golongan $golongan)
    {
        $this->validate($request, [
            "golongan" => 'required|unique:golongan'
        ]);

        $golongan->update([
            'golongan' => $request->golongan
        ]);

        Session::flash('message', 'Data Golongan Berhasil diubah');
        return redirect()->route('jenis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Golongan $golongan)
    {
        $golongan->delete();
        Session::flash('delete-message', 'Data Golongan berhasil dihapus');
        return redirect()->route('jenis.index');
    }
}
