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
                                <th>Jenis Obat</th>
                                <th>Grosir</th>
                                <th>Langganan</th>
                                <th>Umum</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($set_harga_jual as $harjul)
                            <tr>                                
                                <td>{{ $harjul->jenis->nama }}</td>
                                <td>{{ $harjul->h_grosir }}</td>
                                <td>{{ $harjul->h_langganan }}</td>
                                <td>{{ $harjul->h_umum }}</td>
                                <td>
                                    <a href="{{ route('set_harga_jual.edit', $harjul->id) }}" class="icon-edit"> Edit</a>
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