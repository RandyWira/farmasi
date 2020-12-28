@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="span12">
            <div class="card">
                <div class="widget-header">
                    <i class="icon-truck"></i>
                    <h3>Data Supplier</h3>
                </div>
                <div class="widget-content">
                    <a href="{{ route('supplier.create') }}" class="btn btn-xs green lighten-4">
                        <i class="icon-plus" style="font-size: 18px;" title="Tambah Data"></i>
                    </a>
                    <table class="responsive-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No. Telp / HP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supplier as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->no_hp }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection