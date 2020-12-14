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
                            <strong>
                                {{ Session('message') }}
                                <a href="{{ route('jenis.index') }}">Lihat Data</a>
                            </strong>

                        </div>
                    </div>
                </div>
                @endif
                <div class="widget-header">
                    <i class="icon-pencil"></i>
                    <h3>Input satuan Barang</h3>
                </div>
                <div class="widget-content">
                    <form action="{{ route('satuan.store') }}" method="POST" id="inputsatuan" class="form-horizontal">
                        @csrf
                        <fieldset>
                            <div class="control-group">
                                <label for="satuan" class="control-label">Satuan</label>
                                <div class="controls">
                                    <input type="text" class="span6" name="satuan" id="satuan">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-info">
                                    Simpan
                                </button>
                                <button class="btn">Batal</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection