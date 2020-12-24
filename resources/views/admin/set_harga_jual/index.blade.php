@extends('layouts.app')

@section('content')
    {{-- <div class="row31 --}}

    <div class="row">
        <div class="col s10 offset-s1">
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
                    <span class="card-title">
                        Persentase Harga Jual Obat
                    </span>
                    <table class="responsive-table centered">
                        <thead class="teal lighten-3">
                            <tr>
                                <th>User yg Menginput</th>
                                <th>Tanggal Input</th>
                                <th>Persentase Grosir</th>
                                <th>Persentase Langganan</th>
                                <th>Persentase umum</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($set_persentase_jual as $persentase)
                            <tr>                                
                                <td>{{ $persentase->user->name }}</td>
                                <td>{{ $persentase->tgl_input }}</td>
                                <td>{{ $persentase->persen_grosir }} %</td>
                                <td>{{ $persentase->persen_langganan }} %</td>
                                <td>{{ $persentase->persen_umum }} %</td>
                                <td>
                                    <a href="{{ route('set_persentase_jual.edit', $persentase->id_persen) }}" class="icon-edit"> Edit</a>
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