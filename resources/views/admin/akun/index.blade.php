@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s6">
            <div class="widget">
                <div class="widget-header">
                    <i class="icon-money"></i>
                    <h3> Master Akun</h3>
                </div>
                <div class="widget-content">
                    <table class="responsive-table">
                        <thead>
                            <tr>
                                <th>No. Akun</th>
                                <th>Nama Akun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sub_akun as $item)
                            <tr>
                                <th>{{ $item->id }}</th>
                                <th>{{ $item->nama }}</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col s6">
            <div class="widget">
                <div class="widget-header">
                    <i class="icon-pencil"></i>
                    <h3>Tambah Data Akun</h3>
                </div>
                <div class="widget-content">
                    <form action="#" class="form-horizontal" method="POST">
                        @csrf
                        <div class="control-group">
                            <label for="id">Jenis Akun</label>
                            <select name="id_satuan" id="id_satuan" class="span5">
                                @foreach ($akun as $akun)
                                <option value={{ $akun->id }}>{{ $akun->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="control-group">
                            <label for="no_akun">No. Akun</label>
                            <input type="text" name="no_akun" id="no_akun" class="span6">
                        </div>
                        <div class="control-group">
                            <label for="nama">Nama Akun</label>
                            <input type="text" name="nama" id="nama" class="span6">
                        </div>
                        <div class="control-group">
                            <button type="submit" class="btn teal lighten-3">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection