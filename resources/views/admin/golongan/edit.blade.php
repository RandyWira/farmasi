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
                                {{-- <a href="{{ route('jenis.index') }}">Lihat Data</a> --}}
                            </strong>

                        </div>
                    </div>
                </div>
                @endif
                <div class="widget-header">
                    <i class="icon-pencil"></i>
                    <h3>Edit satuan Barang</h3>
                </div>
                <div class="widget-content">
                    <form action="{{ url('admin/golongan', $golongan->id) }}" method="post" id="inputgolongan" class="form-horizontal">
                        @csrf
                        @method('patch')
                        <fieldset>
                            <div class="control-group">
                                <label for="golongan" class="control-label">Golongan</label>
                                <div class="controls">
                                    <input type="text" class="span6" name="golongan" id="golongan" value="{{ $golongan->golongan }}">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-info">
                                    Update
                                </button>
                                <a class="btn" href="{{ route('jenis.index') }}">Batal</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection