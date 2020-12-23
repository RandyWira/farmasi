@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            @if(Session::has('message'))
                <div class="control-group">
                    <div class="controls">
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>{{ Session('message') }}</strong>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-content">
                    <table class="responsive-table centered">
                        <thead class="teal lighten-3">
                            <tr>
                                <th>No. Nota</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>PPN</th>
                                <th>HPP</th>
                                <th>Tagihan</th>
                                <th>Laba</th>
                                <th>Cara Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report_jual as $jual)
                            <tr>
                                <td><a href="{{ route('penjualan.detail', $jual->nota_jual) }}"> {{ $jual->nota_jual }}</a></td>
                                <td>{{ $jual->created_at}}</td>
                                <td>@currency($jual->total_jual)</td>
                                <td>@currency($jual->ppn_jual)</td>
                                <td>@currency($jual->hpp)</td>
                                <td>@currency($jual->tagihan_jual)</td>
                                <td>@currency($jual->tagihan_jual - $jual->hpp)</td>
                                <td>{{ $jual->cara_bayar }}</td>
                                <td>
                                    <a href="{{ route('penjualan.cetak_nota', $jual->nota_jual) }}" target="_blank" class="icon-print"> Cetak Nota</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection