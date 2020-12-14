@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    {{-- <form action="{{route ('opname.store')}}" method="POST">
                        @csrf
                    <input type="hidden" value="0" id="total">    
                    <div class="row">
                        <div class="span6">
                            <div id="list-input">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="input1" name="angka[0][testing]">
                                    <input type="text" class="form-control" placeholder="inputan1" name="angka[0][testing2]">
                                </div>
                            </div>    
                            <div class="form-group">
                                <button type="button" id="tambah-input" class="btn btn-primary">+</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>           
                    </div>                 
                </form> --}}
                    <form action="{{ route('opname.store') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="control-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="span8" name="tanggal" id="tanggal">
                        </div>
                        <div class="control-group">
                            <label for="id_letak">Lokasi Opname</label>
                            <select name="id_letak" id="id_letak" class="span6">
                                @foreach ($letak as $letak)
                                <option value={{ $letak->id_letak }}>{{ $letak->letak }}</option>
                                @endforeach
                            </select>
                        </div>
                        <table class="responsive-table centered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Real</th>
                                    <th class="hidden">Kode Barang</th>
                                    <th>Barang</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Selisih</th>
                                    <th>Lebih</th>
                                    <th>Nominal Selisih</th>
                                    <th>Nominal Lebih</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id=list-form class="body350">
                                <tr>
                                    <td>
                                        <input type="number" placeholder="Stok Real" class="span1" name="angka[0][real]">
                                    </td>
                                    <td class="hidden">
                                        {{-- {{ $barang->id }} --}}
                                        <input type="number" placeholder="ID Obat" class="span1" name="angka[0][id]">
                                    </td>
                                    <td>
                                        {{-- {{ $barang->nama }} --}}
                                        {{-- <input type="text" placeholder="Nama Obat" class="span1" name="angka[0][nama]"> --}}
                                        <input name="angka[0][nama]" type="text" autocomplete="off" list="list-data" class="span1 caribarang" placeholder="Nama Obat">
                                        
                                    </td>
                                    <td>
                                        {{-- @currency($barang->harga_beli) --}}
                                        <input type="number" placeholder="Harga Beli" class="span1 hb" name="angka[0][harga_beli]">
                                    </td>
                                    <td>
                                        {{-- {{ $barang->stok_minimal }} --}}
                                        <input type="number" placeholder="Stok" class="span1" name="angka[0][stok]">
                                    </td>
                                    <td>
                                        <input type="text" class="span1" name="angka[0][selisih]" placeholder="Selisih">
                                    </td>
                                    <td>
                                        <input type="text" class="span1" name="angka[0][lebih]" placeholder="Lebih">
                                    </td>
                                    <td>
                                        <input type="text" class="span1" name="angka[0][nominal_selisih]" placeholder="nominal_selisih">
                                    </td>
                                    <td>
                                        <input type="text" class="span1" name="angka[0][nominal_lebih]" placeholder="nominal_lebih">
                                    </td>
                                    <td>
                                        <button type="button" id="tambah-input" class="btn btn-primary">+</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">Simpan</button>
                            </div>
                        </div>
                    </form>
                    <datalist id="list-data">
                        @foreach ($barang as $i)
                            <option value="{{$i->nama}}">{{$i->nama}}</option>  
                        @endforeach
                    </datalist>
                </div>
            </div>
        </div>
    </div>

<script>
// var list = $('#list-input')
// var angka = 0

// $('#tambah-input').click(function(){
//     list.append("<div class='baris-input'><input type='text' class='form-control' name='angka["+angka+"][testing]' placeholder='input"+angka+"'><input type='text' class='form-control' name='angka["+angka+"][testing2]' placeholder='inputan"+angka+"'><button class='hapus-cok btn-default'>remove</button></div>")
// })
    var list = $('#list-form')
    var angka = 0
    $('#tambah-input').click(function(){
        ++angka
        list.append(" <tr>\
            <td><input type='number' placeholder='Stok Real' class='span1' name='angka["+angka+"][real]'></td> \
            <td class='hidden'><input type='number' placeholder='ID Obat' class='span1' name='angka["+angka+"][id]'></td> \
            <td><input name='angka["+angka+"][nama]' type='text' autocomplete='off' list='list-data' class='typeahead span1 caribarang' id='caribarang' placeholder='Nama Obat'> </td>\
            <td><input type='number' placeholder='Harga Beli' class='span1 hb' name='angka["+angka+"][harga_beli]'></td> \
            <td><input type='number' placeholder='Stok' class='span1' name='angka["+angka+"][stok]'></td> \
            <td><input type='text' class='span1' name='angka["+angka+"][selisih]' placeholder='Selisih'></td> \
            <td><input type='text' class='span1' name='angka["+angka+"][lebih]' placeholder='Lebih'></td> \
            <td><input type='text' class='span1' name='angka["+angka+"][nominal_selisih]' placeholder='nominal_selisih'></td> \
            <td><input type='text' class='span1' name='angka["+angka+"][nominal_lebih]' placeholder='nominal_lebih'></td> \
            <td>&nbsp;</td> \
            </tr> \
        ")
    })
    // $('.caribarang').keyup(function(){
    //         $.ajax({
    //             url:"{{ route ('cari') }}",
    //             dataType:'JSON',
    //             type:'GET',
    //             data:"&cari="+$(this).val(),
    //             success:function(data){
    //                 $.each(data, function(index, obj){
    //                     alert(obj.nama)
    //                 })
    //             },
    //             error:function(thrownError,ajaxOption,xhr){
    //                 alert('error cok ')
    //             }
    //         })
    //     })
    // $('#list-form').on('keyup','.caribarang',function(){
    //     $barang = $(this).val()
    //     console.log($barang)
    // })

    $('#list-form').on('keyup','.caribarang',function(){
        var barang = $(this).val()
        $.ajax({
            url:"{{ route ('cari') }}",
            dataType:'JSON',
            type:'GET',
            data:"&cari="+barang,
            success:function(data){
                $.each(data, function(index, obj){
                    // alert(obj.nama)
                    console.log(obj.name)
                    $(this).
                })
            },
            error:function(thrownError,ajaxOption,xhr){
                alert('error cok ')
            }
        })
    })

</script>
@endsection