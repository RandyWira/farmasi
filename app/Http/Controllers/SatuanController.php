<?php

namespace App\Http\Controllers;

use App\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuan = Satuan::orderBy('id_satuan', 'ASC');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.satuan.create');
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
            "satuan" => 'required|unique:satuan'
        ],
            [
                'satuan.unique' => 'Satuan telah ada',
            ]
    );

        $satuan = new Satuan();
        $satuan->satuan = $request->satuan;
        $satuan->save();

        Session::flash('message', 'Satuan berhasil ditambahkan !! ');
        return redirect()->route('satuan.create');
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
    public function edit(Satuan $satuan)
    {
        return view('admin.satuan.edit', compact('satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Satuan $satuan)
    {
        $this->validate($request, [
            "satuan" => 'required|unique:satuan'
        ]);

        $satuan->update([
            'satuan' => $request->satuan
        ]);

        Session::flash('message', 'Satuan Berhasil diubah');
        return redirect()->route('jenis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Satuan $satuan)
    {
        $satuan->delete();
        Session::flash('delete-message', 'Data Satuan berhasil dihapus');
        return redirect()->route('jenis.index');
    }
}
