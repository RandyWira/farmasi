@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="span12">
            <form action="#" method="post" class="form-horizontal">
                @csrf
                <div class="row">
                    <div class="span12">
                        <div class="card">
                            <div class="widget-header">
                                <i class="icon-signin"></i>
                                <h3>Mutasi Keluar Obat</h3>
                            </div>
                            <div class="widget-content">
                                <div class="span4">
                                    <div class="widget">
                                        <div class="widget-content">
                                            <div class="control-group">
                                                <label for="no_mutasi" class="red lighten-4">No. Mutasi</label>
                                                <input type="text" name="no_mutasi" id="no_mutasi" value="{{ $no_mutasi }}" readonly>
                                            </div>
                                            <div class="control-group">
                                                <label for="tanggal" class="red lighten-4">Tanggal</label>
                                                <input class="set-today" type="date" name=tanggal id="tanggal">
                                                <script type="text/javascript">
                                                    window.onload= function() {
                                                        document.querySelector('.set-today').value=(new Date()).toISOString().substr(0,10);
                                                    }
                                                </script>
                                            </div>
                                            <div class="control-group">
                                                <label for="dari" class="red lighten-4">Ke</label>
                                                <input type="text" name="dari" id="dari" required>
                                            </div>
                                            <div class="control-group">
                                                <label for="lokasi_id" class="red lighten-4">Lokasi Stok</label>
                                                <select name="id_letak" id="id_letak" class="span3">
                                                    @foreach ($letak as $letak)
                                                    <option value={{ $letak->id_letak }}>{{ $letak->letak }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="control-group">
                                                <label for="" class="red lighten-4">Total HPP</label>
                                                <input type="number" name="total_hpp" id="total_hpp" class="span1 total_hpp" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span7">
                                    <div class="widget">
                                        <div class="widget-content">
                                            <table class="responsive-table">
                                                <tbody id="list-form">
                                                    <tr class="baris-data">
                                                        <td>
                                                            <label for="nama" class="teal lighten-3">Nama Barang</label>
                                                            <input type="text" name="mutasi_masuk[0][nama]" class="span6 caribarang" autocomplete="off" list="list-data" placeholder="Nama Obat">
                                                        </td>
                                                        <td class="hidden">
                                                            <input type="text" placeholder="ID Obat" class="span1 id-barang" name="mutasi_masuk[0][id]">
                                                        </td>
                                                        <td>
                                                            <label for="" class="teal lighten-3">Qty</label>
                                                            <input type="number" name="mutasi_masuk[0][qty]" class="span1 qty" placeholder="Qty">
                                                        </td>
                                                        <td>
                                                            <label for="" class="teal lighten-3">Harga Beli (Rp)</label>
                                                            <input type="number" name="mutasi_masuk[0][harga_beli]" class="span1 harga_beli" placeholder="Harga Beli">
                                                        </td>
                                                        <td>
                                                            <label for="" class="teal lighten-3">Sub-Total (Rp)</label>
                                                            <input type="number" name="mutasi_masuk[0][subtotal]" class="span1 subtotal" placeholder="Subtotal" readonly>
                                                        </td>
                                                        
                                                    </tr>
                                                </tbody>
                                                    <tr>
                                                        <td colspan="4" style="text-align: right">
                                                            <button type="button" id="tambah-input" class="btn btn-primary">+</button>
                                                            <button type="submit" class="btn">Simpan</button>
                                                        </td>
                                                    </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <input type="hidden" name="" id="datalist-total" value="{{$total_barang}}">
            <datalist id="list-data">
                @foreach ($barang as $i)
                    <option class="datalist-barang" value="{{$i->nama}}">{{$i->nama}}</option>  
                @endforeach
            </datalist>
        </div>
    </div>

    <script>
        $('#datalist-total').val($('#datalist-total').val()-2);
        if($('#datalist-total').val() <= 0){
            $('#tambah-input').prop('disabled', true)
        }else{
            $('#tambah-input').removeAttr('disabled')
        }
        var list = $('#list-form')
        var mutasi_masuk = 0
        $('#tambah-input').click(function(){
            ++mutasi_masuk
            list.append('<tr class="baris-data"> \
                            <td> \
                                <label for="nama" class="teal lighten-3">Nama Barang</label> \
                                <input type="text" name="mutasi_masuk['+mutasi_masuk+'][nama]" class="span6 caribarang" autocomplete="off" list="list-data" placeholder="Nama Obat"> \
                            </td> \
                            <td class="hidden"> \
                                <input type="text" placeholder="ID Obat" class="span1 id-barang" name="mutasi_masuk['+mutasi_masuk+'][id]"> \
                            </td> \
                            <td> \
                                <label for="" class="teal lighten-3">Qty</label> \
                                <input type="number" name="mutasi_masuk['+mutasi_masuk+'][qty]" class="span1 qty" placeholder="Qty"> \
                            </td> \
                            <td> \
                                <label for="" class="teal lighten-3">Harga Beli (Rp)</label> \
                                <input type="number" name="mutasi_masuk['+mutasi_masuk+'][harga_beli]" class="span1 harga_beli" placeholder="Harga Beli"> \
                            </td> \
                            <td> \
                                <label for="" class="teal lighten-3">Sub-Total (Rp)</label> \
                                <input type="number" name="mutasi_masuk['+mutasi_masuk+'][subtotal]" class="span1 subtotal" placeholder="Subtotal" readonly> \
                            </td> \
                            <td width="5%">\
                                                            <a href="#" title="" class="hapus-input"><i class="icon-trash"></i></a>\
                                                        </td>\
                        </tr>')
        })

        $(document).on('keyup', '.caribarang', function(){
            var barang = $(this).val()
            var baris_b = $(this).parents('.baris-data')

            $.ajax({
                url:"{{ route ('cari') }}",
                dataType:'JSON',
                type:'GET',
                data:"&cari="+barang,
                success:function(data){
                    $.each(data, function(index, obj){
                        // alert(obj.nama)
                        // console.log(obj.nama)
                        if(baris_b.find('.caribarang').val() == ''){
                            $('#list-data option[value="'+barang+'"]').removeAttr('disabled');
                        }else{
                            $('#list-data option[value="'+barang+'"]').prop('disabled',true);
                        }
                        baris_b.find('.harga_umum').val(obj.harga_umum)
                        baris_b.find('.id-barang').val(obj.id)
                        baris_b.find('.harga_beli').val(obj.harga_beli)
                        baris_b.find('.stok').val(obj.stok_akhir)
                    })
                },
                error:function(thrownError,ajaxOption,xhr){
                    // alert('error cok ')
                }
            })
        })
    $(document).on('change','.qty', function(){
            var qty = $(this).val();
            var baris_barang = $(this).parents('.baris-data');
            var subtotal = baris_barang.find('.subtotal');
            var harga_beli = baris_barang.find('.harga_beli');

            subtotal.val(parseInt(qty)*parseInt(harga_beli.val()))
            total_hpp()
        })

    $(document).on('keyup','.qty', function(){
            var qty = $(this).val();
            var baris_barang = $(this).parents('.baris-data');
            var subtotal = baris_barang.find('.subtotal');
            var harga_beli = baris_barang.find('.harga_beli');

            subtotal.val(parseInt(qty)*parseInt(harga_beli.val()))
            total_hpp()
        })

    $(document).on('click','.hapus-input',function(){
        $(this).parents('.baris-data').remove()
        total_hpp()
        $('#datalist-total').val(parseInt($('#datalist-total').val())+2);
        if($('#datalist-total').val() <= 0){
            $('#tambah-input').prop('disabled', true)
        }else{
            $('#tambah-input').removeAttr('disabled')
        }
    })

    function total_hpp() {
            var nilai = 0;
            var total_hpp = $('.total_hpp')
            $('.baris-data').each(function(){
                var cari_total_hpp = $(this).find('.subtotal').val();
                nilai += parseInt(cari_total_hpp)
            })
            // console.log(nilai)
            total_hpp.val(nilai)
        }
    </script>
@endsection