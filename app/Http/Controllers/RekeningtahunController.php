<?php

namespace App\Http\Controllers;

use DateTime;
use App\Subakun;
use DateInterval;
use App\Rekeningtahun;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RekeningtahunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo date("Y",strtotime("-10 year")); die();
        $sub_akun = Subakun::orderBy('id', 'ASC')->get();
        $rekening_tahun = Rekeningtahun::orderBy('tahun', 'DESC')
                            ->select('rekening_tahun.*', 'sub_akun.nama', 'akun.tipe', 'akun.balance')
                            ->join('sub_akun', 'sub_akun.id', '=', 'rekening_tahun.subakun_id')
                            ->join('akun', 'akun.id', '=', 'sub_akun.akun_id')                      
                            ->get();
        // dd($rekening_tahun);
        return view('admin.rekening_tahun.index', compact('rekening_tahun', 'sub_akun'));
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
        $rekening_tahun = new Rekeningtahun();
        $rekening_tahun->tahun = $request->tahun;
        $rekening_tahun->subakun_id = $request->subakun_id;
        $rekening_tahun->saldo_awal = $request->saldo_awal;
        $rekening_tahun->save();

        Session::flash('message', 'Rekening Tahun berhasil ditambahkan');
        return redirect()->route('rekening_tahun.index');
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
