@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="span12">
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
            <div class="col s8">
                <div class="card">
                    <div class="widget-header">
                        <i class="icon-tags"></i>
                        <h3>Rekening Tahun</h3>
                    </div>
                    <div class="widget-content">
                        <table class="responsive-table">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Kode Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Tipe</th>
                                    <th>Balance</th>
                                    <th>Saldo Awal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekening_tahun as $item)
                                <tr>
                                    <td>{{ $item->tahun }}</td>
                                    <td>{{ $item->subakun_id }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->tipe }}</td>
                                    <td>{{ $item->balance }}</td>
                                    <td>@currency ($item->saldo_awal)</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col s4">
                <div class="card">
                    <div class="widget-header">
                        <i class="icon-pencil"></i>
                        <h3>Input Saldo Awal Rekening</h3>
                    </div>
                    <div class="widget-content">
                        <form action="{{ route('rekening_tahun.store') }}" method="POST" class="form-horizontal">
                            @csrf
                            <div class="control-group">
                                <label for="tahun" class="red lighten-4">Tahun</label>
                                <input type="text" name="tahun" id="tahun">
                            </div>
                            <div class="control-group">
                                <label for="subakun_id" class="red lighten-4">Akun Bayar</label>
                                <select name="subakun_id" id="subakun_id" class="span3">
                                    @foreach ($sub_akun as $item)
                                    <option value={{ $item->id }}>{{ $item->id }} - {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="control-group">
                                <label for="saldo_awal" class="red lighten-4">Saldo Awal</label>
                                <input type="number" name="saldo_awal" id="saldo_awal">
                            </div>
                            <div class="control-group">
                                <button type="submit" class="btn teal lighten-3">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection