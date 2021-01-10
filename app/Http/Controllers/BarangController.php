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
use DataTables;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if ($request->ajax()) {
        //     $data = $barang = Barang::orderBy('nama', 'ASC')
        //             ->join('satuan', 'satuan.id_satuan', '=', 'barang.id_satuan')
        //             ->select('barang.*', 'satuan.satuan')->get();
        //     return Datatables::of($data)
        //             ->addIndexColumn()
        //             ->addColumn('action', function($row){
     
        //                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
       
        //                     return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        // }
        $barang = Barang::orderBy('nama', 'ASC')
                    ->join('satuan', 'satuan.id_satuan', '=', 'barang.id_satuan')
                    ->select('barang.*', 'satuan.satuan')
                    ->get();
        return view('admin.barang.index', compact('barang'));
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function tabelbarang(Request $request){
        $columns = array( 
                            0 =>'nama', 
                            1 =>'satuan',
                            2=> 'harga_beli',
                            3=> 'harga_grosir',
                            4=> 'harga_langganan',
                            5=> 'harga_umum',
                            6=> 'expire',
                            7=> 'option',
                        );
  
        $totalData = Barang::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $barang = Barang::join('satuan', 'satuan.id_satuan', '=', 'barang.id_satuan')
                        ->select('barang.*', 'satuan.satuan')
                        ->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $barang =  Barang::join('satuan', 'satuan.id_satuan', '=', 'barang.id_satuan')
                            ->select('barang.*', 'satuan.satuan')
                            ->where('barang.id','LIKE',"%{$search}%")
                            ->orWhere('nama', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Barang::where('id','LIKE',"%{$search}%")
                             ->orWhere('nama', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        if(!empty($barang))
        {
            foreach ($barang as $barangs)
            {
                $edit =  route('barang.edit',$barangs->id);
                $hapus =  route('barang.edit',$barangs->id);
                $klik = "if(confirm('APAKAH DATA INI INGIN ANDA HAPUS ???'))event.preventDefault(); document.getElementById('delete-".$barangs->id."').submit();";
                
                $nestedData['nama'] = $barangs->nama;
                $nestedData['satuan'] = $barangs->satuan;
                $nestedData['harga_beli'] = "Rp. ".number_format($barangs->harga_beli,0,',','.');
                $nestedData['harga_grosir'] = "Rp. ".number_format($barangs->harga_grosir,0,',','.');;
                $nestedData['harga_langganan'] = "Rp. ".number_format($barangs->harga_langganan,0,',','.');;
                $nestedData['harga_umum'] = "Rp. ".number_format($barangs->harga_umum,0,',','.');;
                $nestedData['expire'] = date('d-m-Y',strtotime($barangs->expire));
                $nestedData['option'] = "&emsp;<a href='{$edit}' class='icon-edit'> Edit</a>
                                            &emsp;<a href='' onclick='if(confirm(\"APAKAH DATA INI INGIN ANDA HAPUS ???\"))event.preventDefault(); document.getElementById(\"delete-{$barangs->id}\").submit();' class='icon-trash'> Hapus</a>
                                            <form id='delete-{$barangs->id}' method='post' action='{$hapus}' style='display: none;'>
                                            @csrf
                                            @method('DELETE')
                                            </form>";
                // $nestedData['id'] = $post->id;
                // $nestedData['title'] = $post->title;
                // $nestedData['body'] = substr(strip_tags($post->body),0,50)."...";
                // $nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));
                // $nestedData['options'] = "&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
                //                           &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>";
                                          
                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
        // return Datatables::of($barang = Barang::orderBy('nama', 'ASC')
        //             ->join('satuan', 'satuan.id_satuan', '=', 'barang.id_satuan')
        //             ->select('barang.*', 'satuan.satuan')->get())->make(true);
    }
    public function create()
    {
        $jenis = DB::table('set_harga_jual')->orderBy('id_jenis', 'ASC')->select('set_harga_jual.*','jenis.nama')->join('jenis','jenis.id_jenis','=','set_harga_jual.id_jenis')->get();
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
        $jenis = DB::table('set_harga_jual')->orderBy('id_jenis', 'ASC')->select('set_harga_jual.*','jenis.nama')->join('jenis','jenis.id_jenis','=','set_harga_jual.id_jenis')->get();
        $set_persentase_jual = Setpersentasejual::orderBy('id_persen', 'DESC')->limit(1)->get();
        $golongan = Golongan::orderBy('golongan', 'ASC')->get();
        $kategori = Kategori::orderBy('nama', 'ASC')->get();
        $satuan = Satuan::orderBy('satuan', 'ASC')->get();
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
    public function cari_jenis(Request $request){
        $id_jenis = $request->get('cari');
        $list = DB::table('set_harga_jual')->where('id_jenis',$id_jenis)->first();
        
        return response()->json($list);        
    }
}
