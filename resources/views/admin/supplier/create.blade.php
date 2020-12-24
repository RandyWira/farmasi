@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="span12">
            <div class="widget">
                <div class="widget-header">
                    <i class="icon-truck"></i>
                    <h3>Tambah Data Supplier</h3>
                </div>
                <div class="widget-content">
                    <form action="{{ route('supplier.store') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="control-group">
                            <label for="nama">Nama Supplier</label>
                            <input type="text" class="span6" name="nama" id="nama" required>
                        </div>
                        <div class="control-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="span11" rows="8"></textarea>
                        </div>
                        <div class="control-group">
                            <label for="nohp">No. Telp / HP / WA</label>
                            <input type="text" name="nohp" class="span6" id="nohp" required>
                        </div>
                        <div class="control-group">
                            <button type="submit" class="btn btn-success">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection