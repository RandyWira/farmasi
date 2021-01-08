@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="span12">
            <div class="widget">
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
                <div class="widget-header">
                    <i class="icon-pencil"></i>
                    <h3>Edit Persentase [<strong> {{ $set_harga_jual->jenis->nama }} </strong>]</h3>
                </div>
                <div class="widget-content">
                    <form action="{{ url('admin/set_harga_jual', $set_harga_jual->id) }}" method="POST" id="edit_persentase" class="form-horizontal">
                        @csrf
                        @method('patch')
                        <fieldset>
                            <div class="control-group">
                                <label for="harga_grosir">Persentase Penjualan Grosir</label>
                                <input type="number" name="harga_grosir" id="harga_grosir" class="span3" placeholder="Dalam Persen (%)" value="{{$set_harga_jual->h_grosir}}">
                            </div>
                            <div class="control-group">
                                <label for="harga_langganan">Persentase Penjualan Langganan</label>
                                <input type="number" name="harga_langganan" id="harga_langganan" class="span6" placeholder="Dalam Persen (%)" value="{{$set_harga_jual->h_langganan}}">
                            </div>
                            <div class="control-group">
                                <label for="harga_umum">Persentase Penjualan Umum</label>
                                <input type="number" name="harga_umum" id="harga_umum" class="span6" placeholder="Dalam Persen (%)" value="{{$set_harga_jual->h_umum}}">
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-info">
                                    Update
                                </button>
                                <a class="btn" href="{{ route('set_harga_jual.index') }}">Batal</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection