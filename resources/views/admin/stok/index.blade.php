@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s8">
            <div class="card">
                <div class="widget-header">
                    <i class="icon-tasks"></i>
                    <h3>Sisa Stok</h3>
                </div>
                <div class="card-content">
                    <table class="responsive-table centered">
                        <thead class="teal lighten-3">
                            <tr>
                                <th>Nama Barang</th>
                                <th>Lokasi</th>
                                <th>Stok per Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stok as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->letak }}</td>
                                <td>{{ $item->stok }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $stok->links() }}
            </div>
        </div>
        <div class="col s4">
            <div class="card">
                <div class="widget-header">
                    <i class="icon-eye-open"></i>
                    <h3>Detail</h3>
                </div>
                <div class="card-content">

                </div>
            </div>
        </div>
    </div>
@endsection 