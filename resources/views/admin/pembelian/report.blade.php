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
                                <th>No. Faktur</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>PPN</th>
                                <th>Tagihan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report_beli as $beli)
                            <tr>
                                <td><a href="{{ route('pembelian.detail', $beli->no_faktur) }}"> {{ $beli->no_faktur }}</a></td>
                                <td>{{ $beli->created_at}}</td>
                                <td>@currency($beli->total_beli)</td>
                                <td>@currency($beli->ppn_beli)</td>
                                <td>@currency($beli->tagihan_beli)</td>
                                <td>
                                    <a href="{{ route('pembelian.cetak_nota', $beli->no_faktur) }}" target="_blank" class="icon-print"> Cetak Data</a>
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