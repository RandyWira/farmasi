<?php

namespace App\Http\Controllers;

use App\Sethargajual;
use Illuminate\Http\Request;

class SethargajualController extends Controller
{
    public function index()
    {
        $set_harga_jual = Sethargajual::orderBy('id_jenis', 'ASC')
                            ->join('jenis', 'jenis.id_jenis', '=', 'set_harga_jual.id_jenis')
                            ->select('jenis.id_jenis', 'jenis.nama', 'set_harga_jual.h_grosir', 'set_harga_jual.h_langganan', 'set_harga_jual.h_umum')
                            ->get();
        return view('admin.set_harga_jual.index', compact('set_harga_jual'));
    }
}
