@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="span12">
            <div class="card">
                <div class="card-header">
                    Nama : {{ $penjualan->nama_pembeli }} <br>
                    No. Nota : {{ $penjualan->nota_jual }} <br>
                </div>
                <div class="card-content">
                    <table class="responsive-table">
                        <thead class="teal lighten3">
                            <tr>
                                <th>Nama Obat</th>
                                <th>Harga Modal</th>
                                <th>Qty</th>
                                <th>Harga Jual</th>
                                <th>Sub Total</th>
                                <th>Diskon</th>
                                <th>Jumlah Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail_jual as $item)
                            <tr>   
                                <td>{{ $item->nama }}</td>
                                <td>@currency($item->harga_beli)</td>
                                <td>{{ $item->jml_jual }}</td>
                                <td>@currency($item->harga_jual)</td>
                                <td>@currency($item->subtotal)</td>
                                <td>@currency($item->diskon)</td>
                                <td>@currency($item->total_jual)</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection