@extends('layouts.app');

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
                    <i class="icon-user"></i>
                    <h3>Edit Data Barang</h3>
                </div>
                <div class="widget-content">
                    <form action="{{ url('admin/barang', $barang->id) }}" method="post" id="inputbarang" class="form-horizontal">
                        @csrf
                        @method('patch')
                        <fieldset>
                            <div class="control-group">
                                <label for="nama" class="control-label">Nama Obat</label>
                                <div class="controls">
                                    <input type="text" class="span6" name="nama" id="nama" value="{{ $barang->nama }}" required>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label for="id_satuan" class="control-label">Satuan</label>
                                <div class="controls">
                                    <select name="id_satuan" id="id_satuan" class="span6">
                                        @foreach ($satuan as $satuan)
                                        <option value={{ $satuan->id_satuan }}>{{ $satuan->satuan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="id_jenis" class="control-label">Jenis Obat</label>
                                <div class="controls">
                                    <select name="id_jenis" id="id_jenis" class="span6">
                                        @foreach ($jenis as $id_jenis => $nama)
                                        <option value={{ $id_jenis }}>{{ $nama }}</option>    
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Persentase Grosir -->
                            @foreach ($set_persentase_jual as $persentase)
                            <input type="hidden" class="span3" name="persen_grosir" id="persen_grosir" value="{{ $persentase->persen_grosir }}" disabled>
                            @endforeach

                            <!-- Persentase Langganan -->
                            @foreach ($set_persentase_jual as $persentase)
                            <input type="hidden" class="span3" name="persen_langganan" id="persen_langganan" value="{{ $persentase->persen_langganan }}" disabled>
                            @endforeach

                            <!-- Persentase Umum -->
                            @foreach ($set_persentase_jual as $persentase)
                            <input type="hidden" class="span3" name="persen_umum" id="persen_umum" value="{{ $persentase->persen_umum }}" disabled>
                            @endforeach

                            <div class="control-group">
                                <label for="id_kategori" class="control-label">Kategori Obat</label>
                                <div class="controls">
                                    <select name="id_kategori" id="id_kategori" class="span6">
                                        @foreach ($kategori as $kat)
                                        <option value={{ $kat->id_kategori }}>{{ $kat->nama }}</option>    
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="id_golongan" class="control-label">Golongan Obat</label>
                                <div class="controls">
                                    <select name="id_golongan" id="id_golongan" class="span6">
                                        @foreach ($golongan as $gol)
                                        <option value={{ $gol->id }}>{{ $gol->golongan }}</option>    
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="harga_modal" class="control-label">Harga Modal</label>
                                <div class="controls">
                                    <input type="number" class="span6" name="harga_modal" id="harga_modal" onchange="keuntungan()" value="{{ $barang->harga_beli }}" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="harga_grosir" class="control-label">Harga Jual Grosir</label>
                                <div class="controls">
                                    <input type="number" class="span2" name="harga_grosir" id="harga_grosir" value="{{ $barang->harga_grosir }}" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="harga_langganan" class="control-label">Harga Jual Langganan</label>
                                <div class="controls">
                                    <input type="number" class="span2" name="harga_langganan" id="harga_langganan" value="{{ $barang->harga_langganan }}" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="harga_umum" class="control-label">Harga Jual Umum</label>
                                <div class="controls">
                                    <input type="number" class="span6" name="harga_umum" id="harga_umum" value="{{ $barang->harga_umum }}" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="stok_minimal" class="control-label">Stok Minimal</label>
                                <div class="controls">
                                    <input type="number" class="span3" name="stok_minimal" id="stok_minimal" required value="{{ $barang->stok_minimal }}">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="expire" class="control-label">Expire Date</label>
                                <div class="controls">
                                    <input type="date" class="span6" id="expire" name="expire" id="expire" value="{{ $barang->expire }}">
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

<script>
    function keuntungan() {
        var grosir = document.getElementById("persen_grosir").value;
        var langganan = document.getElementById("persen_langganan").value;
        var umum = document.getElementById("persen_umum").value;

        var harga_modal = document.getElementById("harga_modal").value;

        var untung_grosir = harga_modal * grosir / 100;
        var untung_langganan = harga_modal * langganan / 100;
        var untung_umum = harga_modal * umum / 100;

        document.getElementById("harga_grosir").value = (parseInt(harga_modal)+parseInt(untung_grosir));
        document.getElementById("harga_langganan").value = (parseInt(harga_modal)+parseInt(untung_langganan));
        document.getElementById("harga_umum").value = (parseInt(harga_modal)+parseInt(untung_umum));
    }

    function goBack() {
        window.history.back();
    }
</script>