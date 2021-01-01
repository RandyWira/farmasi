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
                    <i class="icon-pencil"></i>
                    <h3>Input Data Barang</h3>
                </div>
                <div class="widget-content">
                    <form action="{{ route('barang.store') }}" method="POST" id="inputbarang" class="form-horizontal">
                        @csrf
                        <fieldset>
                            <div class="control-group">
                                <div class="controls">
                                    <input type="hidden" class="span6" name="id_letak" value="1">
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="nama" class="control-label">Nama Obat</label>
                                <div class="controls">
                                    <input type="text" class="span6" name="nama" id="nama" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="harga_modal" class="control-label">Harga Modal</label>
                                <div class="controls">
                                    <input type="number" class="span6 harga_modal" name="harga_modal"  required>
                                </div>
                            </div>
                        <div class="form-wajib">
                            <div class="control-group">
                                <label for="id_jenis" class="control-label">Jenis Obat</label>
                                <div class="controls">
                                    <select name="id_jenis" class="span6 id_jenis">
                                        @foreach ($jenis as $jenis)
                                        <option value={{ $jenis->id_jenis }}>{{ $jenis->nama }}</option>    
                                        @endforeach
                                    </select>
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
                                <label for="harga_grosir" class="control-label">Harga Jual Grosir</label>
                                <div class="controls">
                                    <input type="number" class="span2 harga_grosir" name="harga_grosir" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="harga_langganan" class="control-label">Harga Jual Langganan</label>
                                <div class="controls">
                                    <input type="number" class="span2 harga_langganan" name="harga_langganan" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="harga_umum" class="control-label">Harga Jual Umum</label>
                                <div class="controls">
                                    <input type="number" class="span6 harga_umum" name="harga_umum" id="" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="stok_minimal" class="control-label">Stok Minimal</label>
                                <div class="controls">
                                    <input type="number" class="span3" name="stok_minimal" id="stok_minimal" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="expire" class="control-label">Expire Date</label>
                                <div class="controls">
                                    <input type="date" class="span6" id="expire" name="expire" id="expire">
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-info">
                                    Simpan
                                </button>
                                <button class="btn">Batal</button>
                            </div>
                        </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var grosir = 0;
    var langganan = 0;
    var umum = 0;
    $('.form-wajib').hide()

    // $(document).ready(function(){
    //   var id_jenis = $('.id_jenis').val()
    //     console.log(id_jenis)
    //     $.ajax({
    //         url : "{{route('cari-jenis')}}",
    //         type : 'GET',
    //         dataType : 'JSON',
    //         data: '&cari='+id_jenis,
    //         success : function(data){
    //             hitung(parseInt(data.h_grosir),parseInt(data.h_langganan),parseInt(data.h_umum))
    //             grosir = parseInt(data.h_grosir);
    //             langganan = parseInt(data.h_langganan);
    //             umum = parseInt(data.h_umum);
    //         },
    //         error:function(throwthrownError,ajaxOption,xhr){
    //             // 
    //         }
    //     })  
    // })

    $('.id_jenis').change(function(){
        var id_jenis = $(this).val()
        console.log(id_jenis)
        $.ajax({
            url : "{{route('cari-jenis')}}",
            type : 'GET',
            dataType : 'JSON',
            data: '&cari='+id_jenis,
            success : function(data){
                hitung(parseInt(data.h_grosir),parseInt(data.h_langganan),parseInt(data.h_umum))
                grosir = parseInt(data.h_grosir);
                langganan = parseInt(data.h_langganan);
                umum = parseInt(data.h_umum);
            },
            error:function(throwthrownError,ajaxOption,xhr){
                // 
            }
        })
    })

    $(document).on('keyup', '.harga_modal', function(){
        if($('.harga_modal').val() == '' || $('.harga_modal').val() == 0){
            $('.form-wajib').hide()
        }else{
            $('.form-wajib').show()
            hitung(grosir,langganan,umum)
        }       
    })
    $(document).on('change', '.harga_modal', function(){
        if($('.harga_modal').val() == '' || $('.harga_modal').val() == 0){
            $('.form-wajib').hide()
        }else{
            $('.form-wajib').show()
            hitung(grosir,langganan,umum)
        }       
    })


    
    function hitung(grosir,langganan,umum){
        var harga_modal = $('.harga_modal').val();

        var untung_grosir = harga_modal * grosir / 100;
        var untung_langganan = harga_modal * langganan / 100;
        var untung_umum = harga_modal * umum / 100;

        $('.harga_grosir').val(parseInt(harga_modal)+parseInt(untung_grosir));
        $('.harga_langganan').val(parseInt(harga_modal)+parseInt(untung_langganan));
        $('.harga_umum').val(parseInt(harga_modal)+parseInt(untung_umum));

    }
</script>
<!-- 
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
</script> -->
<script>

</script>
@endsection