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
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <a href="{{ route('barang.create') }}" class="btn btn-xs green lighten-4">
                        <i class="icon-plus"></i>
                    </a>
                </span>
                <table id="example" class="responsive-table centered ">
                    <thead class="teal lighten-3">
                        <tr>
                            <th>Nama Obat</th>
                            <th>Satuan</th>
                            <th>Harga Modal</th>
                            <th>Harga Jual Grosir</th>
                            <th>Harga Jual Langganan</th>
                            <th>Harga Jual Umum</th>
                            <th>Tanggal Expire</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barang as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->satuan }}</td>
                            <td>@currency($item->harga_beli)</td>
                            <td>@currency($item->harga_grosir)</td>
                            <td>@currency($item->harga_langganan)</td>
                            <td>@currency($item->harga_umum)</td>
                            <td>{{ $item->expire }}</td>
                            <td width="16%">
                                <a href="{{ route('barang.edit', $item->id) }}" class="icon-edit"> Edit</a>
                                <a href="" onclick="if(confirm('APAKAH DATA INI INGIN ANDA HAPUS ???'))event.preventDefault(); document.getElementById('delete-{{$item->id}}').submit();" class="icon-trash"> Hapus</a>
                                <form id="delete-{{$item->id}}" method="post" action="{{route('barang.destroy',$item->id)}}" style="display: none;">
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