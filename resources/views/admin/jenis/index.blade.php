@extends('layouts.app')
@section('content')
<div class="row">
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
    @if(Session::has('delete-message'))
        <div class="control-group">
            <div class="controls">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>{{ Session('delete-message') }}</strong>
                </div>
            </div>
        </div>
    @endif
    <div class="col s4">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <a href="#" class="btn btn-xs green lighten-4">
                        <i class="icon-plus"></i>
                    </a>
                </span>
                <table class="responsive-table centered">
                    <thead class="teal lighten-3">
                        <tr>
                            <th>Kategori Obat</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="body150">
                        @foreach($kategori as $kat)
                        <tr>
                            <td>{{ $kat->nama }}</td>
                            <td>
                                <a href="#modalKategori" class="icon-edit"> Edit</a>
                            </td>
                            <td>
                                <a href="#" class="icon-trash"> Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col s4">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <a href="{{ route('satuan.create') }}" class="btn btn-xs green lighten-4">
                        <i class="icon-plus"></i>
                    </a>
                </span>
                <table class="responsive-table centered">
                    <thead class="teal lighten-3">
                        <tr>
                            <th>Satuan</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="body150">
                        @foreach($satuan as $satuan)
                        <tr>
                            <td>{{ $satuan->satuan }}</td>
                            <td>
                                <a href="{{ route('satuan.edit', $satuan->id_satuan) }}" class="icon-edit"> Edit</a>
                            </td>
                            <td>
                                <a href="" onclick="if(confirm('APAKAH DATA INI INGIN ANDA HAPUS ???'))event.preventDefault(); document.getElementById('delete-{{$satuan->id_satuan}}').submit();" class="icon-trash"> Hapus</a>
                                <form id="delete-{{$satuan->id_satuan}}" method="post" action="{{route('satuan.destroy',$satuan->id_satuan)}}" style="display: none;">
                                @csrf
                                @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col s4">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <a href="#" class="btn btn-xs green lighten-4">
                        <i class="icon-plus"></i>
                    </a>
                </span>
                <table class="responsive-table centered">
                    <thead class="teal lighten-3">
                        <tr>
                            <th>Jenis Obat</th>
                            <th>Keterangan</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="body150">
                        @foreach($jenis as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->ket }}</td>
                            <td>
                                <a href="#" class="icon-edit"> Edit</a>
                            </td>
                            <td>
                                <a href="#" class="icon-trash"> Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col s4">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <a href="{{ route('golongan.create') }}" class="btn btn-xs green lighten-4">
                        <i class="icon-plus"></i>
                    </a>
                </span>
                <table class="responsive-table centered">
                    <thead class="teal lighten-3">
                        <tr>
                            <th>Golongan Obat</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="tbody150">
                        @foreach ($golongan as $gol)
                        <tr>
                            <td>{{ $gol->golongan }}</td>
                            <td>
                                <a href="{{ route('golongan.edit', $gol->id) }}" class="icon-edit"> Edit</a>
                            </td>
                            <td>
                                <a href="" onclick="if(confirm('APAKAH DATA INI INGIN ANDA HAPUS ???'))event.preventDefault(); document.getElementById('delete-{{$gol->id}}').submit();" class="icon-trash"> Hapus</a>
                                <form id="delete-{{ $gol->id }}" method="post" action="{{ route('golongan.destroy',$gol->id) }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                                </form>
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