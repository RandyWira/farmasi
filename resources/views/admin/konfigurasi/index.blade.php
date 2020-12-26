@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s8">
            <div class="card">
                <div class="widget-header">
                    <i class="icon-gear"></i>
                    <h3>Konfigurasi Aplikasi</h3>
                </div>
                <div class="widget-content">
                    <table class="responsive-table">
                        <thead>
                            <tr>
                                <th>Nama Aplikasi</th>
                                <td>{{ $konfigurasi->nama }}</td>
                            </tr>
                            <tr>
                                <th>Apoteker</th>
                                <td>{{ $konfigurasi->apoteker }}</td>
                            </tr>
                            <tr>
                                <th>No. SIPA</th>
                                <td>{{ $konfigurasi->no_sipa }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $konfigurasi->alamat }}</td>
                            </tr>
                            <tr>
                                <th>No. Telp / HP / WA</th>
                                <td>{{ $konfigurasi->nohp }}</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col s4">
            <div class="card">
                <div class="widget-header">
                    <i class="icon-pencil"></i>
                    <h3>Edit Konfigurasi</h3>
                </div>
                <div class="widget-content">

                </div>
            </div>
        </div>
    </div>
@endsection