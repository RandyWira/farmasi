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
                                <th>No. Mutasi</th>
                                <th>Tanggal</th>
                                <th>Dari</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report_mutasi_masuk as $beli)
                            <tr>
                                <td><a href="{{ route('mutasi_masuk.detail', $beli->no_mutasi) }}"> {{ $beli->no_mutasi }}</a></td>
                                <td>{{ $beli->tanggal }}</td>
                                <td>{{ $beli->dari }}</td>
                                <td>
                                    <a href="{{ route('mutasi_masuk.cetak_nota', $beli->no_mutasi) }}" target="_blank" class="icon-print"> Cetak Data</a>
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