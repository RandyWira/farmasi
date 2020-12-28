<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_barang = DB::table('barang')->count();
        $now = now()->format('Y-m-d');
        $laba = DB::table('penjualan')->whereDate('created_at', $now)->sum('tagihan_jual');

        $year = now()->format('Y');
        $barang_expd = DB::table('barang')->whereYear('expire', $year)->paginate(10);
        
        return view('home', compact('total_barang', 'laba', 'barang_expd'));
    }
}
