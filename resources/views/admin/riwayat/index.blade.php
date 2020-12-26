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
                                <th>Stok Awal</th>
                                <th>Masuk</th>
                                <th>Keluar</th>
                                <th>Stok Akhir</th>
                                <th>Bagian</th>
                                <th>Jam dan Tanggal</th>
                                <th>Petugas</th>
                                <th>Lokasi</th>
                                <th>Aksi</th>
                                <th>No Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayat as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->stok_awal }}</td>
                                <td>{{ $item->masuk }}</td>
                                <td>{{ $item->keluar }}</td>
                                <td>{{ $item->stok_akhir }}</td>
                                <td>{{ $item->bagian }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->letak }}</td>
                                <td>{{ $item->aksi }}</td>
                                <td>{{ $item->no_faktur }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $riwayat->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection