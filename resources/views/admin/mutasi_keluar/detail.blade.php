@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="span12">
            <div class="card">
                <div class="card-header" style="padding: 15px">
                    <table border="0">
                        <tr>
                            <td>Dari</td>
                            <td>{{ $mutasi_keluar->ke }}</td>
                            <td colspan='4'>
                                <font class="pull-right">
                                    <a href="{{ route('mutasi_keluar.cetak_nota', $mutasi_keluar->no_mutasi) }}" target="_blank" class="btn btn-default" title="Cetak"><i class="icon-print" style="font-size: 20px;"></i></a>
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td>No. Mutasi</td>
                            <td>{{ $mutasi_keluar->no_mutasi }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Tanggal Transaksi</td>
                            <td>{{ $mutasi_keluar->tanggal}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                    
                     
                </div>
                <div class="card-content">
                    <table class="responsive-table">
                        <thead class="teal lighten3">
                            <tr>
                                <th>Nama Obat</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Jumlah Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail_mutasi_keluar as $item)
                            <tr>   
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jml }}</td>
                                <td>@currency($item->harga_jual)</td>
                                <td>@currency($item->subtotal)</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection