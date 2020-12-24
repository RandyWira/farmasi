@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <div class="card">
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
    </div>
@endsection 