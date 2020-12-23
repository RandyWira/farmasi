@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="span12">
            <form action="#" method="POST" class="form-horizontal">
                @csrf
                <div class="row">
                    <div class="span12">
                        <div class="widget">
                            <div class="widget-content">
                                <div class="span6">
                                    <div class="widget">
                                        <div class="widget-content">
                                            <div class="control-group">
                                                <label for="nota_jual" class="red lighten-4">No. Nota</label>
                                                <input type="text" name="nota_jual" id="nota_jual" placeholder="No. NOTA" class="span6" value="{{ $no_nota }}" readonly>
                                            </div>
                                            <div class="control-group">
                                                <label for="tanggal" class="red lighten-4">Tanggal</label>
                                                <input type="date" name="tanggal" id="tanggal" class="span6">
                                            </div>
                                            <div class="control-group">
                                                <label for="pembeli"  class="red lighten-4">Nama Pembeli</label>
                                                <input type="text" name="pembeli" id="pembeli" placeholder="Nama Pembeli" class="span6" required>
                                            </div>
                                            <div class="control-group">
                                                <label for="lokasi_id" class="red lighten-4">Lokasi Stok</label>
                                                <select name="id_letak" id="id_letak" class="span3">
                                                    @foreach ($letak as $letak)
                                                    <option value={{ $letak->id_letak }}>{{ $letak->letak }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span5">
                                    <div class="widget">
                                        <div class="widget-content">
                                            <div class="control-group">
                                                <label for="" class="red lighten-4">Total HPP</label>
                                                <input type="number" name="total_hpp" id="total_hpp" class="span1 total_hpp" readonly>
                                            </div>
                                            <div class="control-group">
                                                <label for="" class="red lighten-4">Emblase + Tuslah</label>
                                                <input type="number" name="emblase_tuslah" class="span1 emblase_tuslah" placeholder="Tagihan" readonly>
                                            </div>
                                            <div class="control-group">
                                                <label for="" class="red lighten-4">Tagihan + PPN</label>
                                                <input type="number" name="tagihan" class="span1 tagihan" placeholder="Tagihan" readonly>
                                            </div>
                                            <div class="control-group">
                                                <label for="bayar" class="red lighten-4">Dibayarkan</label>
                                                <input type="number" name="bayar" id="bayar" class="span6" required>
                                            </div>
                                            <div class="control-group">
                                                <label for="kembalian" class="red lighten-4">Kembalian</label>
                                                <input type="number" name="kembalian" id="kembalian" class="span6" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="span12">
                        <div class="widget">
                            <div class="widget-content">
                                <table class="responsive-table" style="width:100%">
                                    {{-- <thead>
                                        <tr>
                                            <th>Barang</th>
                                            <th class="hidden">ID</th>
                                            <th>Qty</th>
                                            <th>Harga Beli</th>
                                            <th>Harga per item</th>
                                            <th>Sub Total</th>
                                            <th>Diskon</th>
                                            <th>HPP</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead> --}}
                                    <tbody id="list-form">
                                        <tr class="baris-data">
                                            <td>
                                                <label for="" class="teal lighten-3">Nama Barang</label>
                                                <input type="text" name="jual[0][nama]" class="span6 caribarang" autocomplete="off" list="list-data" placeholder="Nama Obat">
                                            </td>
                                            <td class="hidden">
                                                <input type="text" placeholder="ID Obat" class="span1 id-barang" name="jual[0][id]">
                                            </td>
                                            <td>
                                                <label for="" class="teal lighten-3">Qty</label>
                                                <input type="number" name="jual[0][qty]" class="span1 qty" placeholder="Qty">
                                            </td>
                                            <td>
                                                <label for="" class="teal lighten-3">Harga Beli (Rp)</label>
                                                <input type="number" name="jual[0][harga_beli]" class="span1 harga_beli" placeholder="Harga Beli">
                                            </td>
                                            <td>
                                                <label for="" class="teal lighten-3">Harga Jual (Rp)</label>
                                                <input type="number" name="jual[0][harga_umum]" class="span1 harga_umum" placeholder="Harga_umum" readonly>
                                            </td>
                                            <td>
                                                <label for="" class="teal lighten-3">Sub-Total (Rp)</label>
                                                <input type="number" name="jual[0][subtotal]" class="span1 subtotal" placeholder="Subtotal" readonly>
                                            </td>
                                            <td>
                                                <label for="" class="teal lighten-3">Diskon (Rp)</label>
                                                <input type="number" name="jual[0][diskon]" class="span1 diskon" placeholder="Diskon">
                                            </td>
                                            <td>
                                                <label for="" class="teal lighten-3">HPP (Rp)</label>
                                                <input type="number" name="jual[0][hpp]" class="span1 hpp" placeholder="hpp" readonly>
                                            </td>
                                            <td>
                                                <label for="" class="teal lighten-3">Total (Rp)</label>
                                                <input type="number" name="jual[0][total]" class="span1 total" placeholder="Total" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tr>
                                        <td colspan="2">
                                            <label for="" class="teal lighten-3">Total (Tanpa PPN)</label>
                                            <input type="number" name="total_keseluruhan" class="span1 total-keseluruhan" placeholder="Jumlah Total (Tanpa PPN)" readonly>
                                        </td>
                                        <td>
                                            <label for="" class="teal lighten-3">PPN (%)</label>
                                            <input type="number" name="ppn" class="span1 ppn" placeholder="PPN" value="{{ $ppn->ppn }}" readonly>
                                        </td>
                                        <td>
                                            <label for="" class="teal lighten-3">Harga PPN</label>
                                            <input type="number" name="harga_ppn" class="span1 harga-ppn" placeholder="Harga PPN" readonly>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td colspan="2">
                                            <label for="" class="red lighten-4">Tagihan + PPN</label>
                                            <input type="number" name="tagihan" class="span1 tagihan" placeholder="Tagihan" readonly>
                                        </td>
                                    </tr> --}}
                                    <tr>
                                        <td colspan="8" style="text-align: right">
                                            <button type="button" id="tambah-input" class="btn btn-primary">+</button>
                                            <button type="submit" class="btn">Simpan</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <datalist id="list-data">
                @foreach ($barang as $i)
                    <option class="datalist-barang" value="{{$i->nama}}">{{$i->nama}}</option>  
                @endforeach
            </datalist>   
        </div>    
    </div>


    <script>
        var list = $('#list-form')
        var jual = 0
        $('#tambah-input').click(function(){
          ++jual
          list.append('<tr class="baris-data"> \
                            <td> \
                                <input type="text" name="jual['+jual+'][nama]" class="span6 caribarang" autocomplete="off" list="list-data" placeholder="Nama Obat"> \
                            </td> \
                            <td class="hidden"> \
                                <input type="text" placeholder="ID Obat" class="span1 id-barang" name="jual['+jual+'][id]"> \
                            </td> \
                            <td> \
                                <input type="number" name="jual['+jual+'][qty]" class="span1 qty" placeholder="Qty"> \
                            </td> \
                            <td> \
                                <input type="number" name="jual['+jual+'][harga_beli]" class="span1 harga_beli" placeholder="Harga Beli"> \
                            </td> \
                            <td> \
                                <input type="number" name="jual['+jual+'][harga_umum]" class="span1 harga_umum" placeholder="Harga" readonly> \
                            </td> \
                            <td> \
                                <input type="number" name="jual['+jual+'][subtotal]" class="span1 subtotal" placeholder="Subtotal" readonly> \
                            </td> \
                            <td> \
                                <input type="number" name="jual['+jual+'][diskon]" class="span1 diskon" placeholder="Diskon"> \
                            </td> \
                            <td> \
                                <input type="number" name="jual['+jual+'][hpp]" class="span1 hpp" placeholder="hpp" readonly> \
                            </td> \
                            <td> \
                                <input type="number" name="jual['+jual+'][total]" class="span1 total" placeholder="Total" readonly> \
                            </td> \
                        </tr> \
                    ')  
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
            var harga_umum = baris_barang.find('.harga_umum');
            var subtotal = baris_barang.find('.subtotal');
            var harga_beli = baris_barang.find('.harga_beli');
            var hpp = baris_barang.find('.hpp');

            hpp.val(parseInt(qty)*parseInt(harga_beli.val()))
            subtotal.val(parseInt(qty)*parseInt(harga_umum.val()))
        })

        $(document).on('keyup','.qty', function(){
            var qty = $(this).val();
            var baris_barang = $(this).parents('.baris-data');
            var diskon = baris_barang.find('.diskon');
            var harga_umum = baris_barang.find('.harga_umum');
            var subtotal = baris_barang.find('.subtotal');
            var total = baris_barang.find('.total');
            var harga_beli = baris_barang.find('.harga_beli');
            var hpp = baris_barang.find('.hpp');

            hpp.val(parseInt(qty)*parseInt(harga_beli.val()))
            subtotal.val(parseInt(qty)*parseInt(harga_umum.val()))
            total.val(subtotal.val())-(parseInt(diskon.val()))
        })

        $(document).on('change', '.diskon', function(){
            var diskon = $(this).val();
            var baris_barang = $(this).parents('.baris-data');
            var subtotal = baris_barang.find('.subtotal');
            var total = baris_barang.find('.total');

            total.val(subtotal.val()-diskon)
            total_hpp()
            mencari_total()
            // laba()
        })

        $(document).on('keyup', '.diskon', function(){
            var diskon = $(this).val();
            var baris_barang = $(this).parents('.baris-data');
            var subtotal = baris_barang.find('.subtotal');
            var total = baris_barang.find('.total');

            total.val(subtotal.val()-diskon)
            total_hpp()
            mencari_total()
            // laba()
        })


        $(document).on('change', '.total', function(){
            // var total = $(this).val();
            var baris_b = $(this).parents('.baris-data')
            // $.each(baris_b, function(index, obj){
            //     console.log(baris_b.find('.total'))
            // })
            console.log(baris_b.find('.total').val())
        })

        // $(document).on('keyup', '.total', function(){
        //     // var total = $(this).val();
        //     var baris_b = $(this).parents('.baris-data')
        //     // $.each(baris_b, function(index, obj){
        //     //     console.log(total)
        //     // })
        //     console.log(baris_b.find('.total').val())
        // })
        function mencari_total(){
            var angka = 0;
            var ppn = $('.ppn').val()
            var input_harga_ppn = $('.harga-ppn')
            var input_tagihan = $('.tagihan')
            $('.baris-data').each(function(){
                var cari_total = $(this).find('.total').val();
                angka += parseInt(cari_total);
            })
            // console.log(angka);
            $('.total-keseluruhan').val(angka)
            var harga_ppn = angka * ppn / 100
            var tagihan = harga_ppn + angka

            input_harga_ppn.val(harga_ppn)
            input_tagihan.val(tagihan) 
            // console.log(tagihan)
        } 

        function total_hpp() {
            var nilai = 0;
            var total_hpp = $('.total_hpp')
            $('.baris-data').each(function(){
                var cari_total_hpp = $(this).find('.hpp').val();
                nilai += parseInt(cari_total_hpp)
            })
            // console.log(nilai)
            total_hpp.val(nilai)

        }

        // $(document).on('change','#bayar',function(){
        //     var total = parseInt($('#bayar').val())-parseInt($('.tagihan').val());
        //     $('#kembalian').val(total);
        // })

        $(document).on('keyup','#bayar',function(){
            var total = parseInt($('#bayar').val())-parseInt($('.tagihan').val());
            $('#kembalian').val(total);
        })

        // function laba() {
        //     var laba = $('.laba')
        //     var total_keseluruhan = $(this).find('.total_keseluruhan');
        //     var total_hpp = $(this).find('.total_hpp');
        //     // $('.baris-data').each(function(){
        //     //     var total_keseluruhan = $(this).find('.total_keseluruhan').val();
        //     //     var total_hpp = $(this).find('.total_hpp').val();
        //     // })
        //     // nilai = total_keseluruhan.val()- total_hpp.val()
        //     laba.val(parseInt(total_keseluruhan.val())-parseInt(total_hpp.val()))
        // }

    </script>
@endsection


