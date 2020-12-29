@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
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
            <div class="card">
                <div class="card-content">

                    <?php if($cari == 'filter'):?>
                            <h2>List Retur Pembelian {{$carijudul}} Dari {{$data['dari']}} Ke {{$data['ke']}}</h2>
                        <?php else:?>
                            <h2>List Retur Pembelian {{$carijudul}}</h2>
                        <?php endif;?>
                        <br>

                    <div class="control-group">
                                    
                            <div class="controls">
                              <div class="btn-group">
                              <a class="btn btn-primary" href="#"><i style="font-size: 15px" class="icon-calendar icon-white"></i> Filter Pencarian</a>
                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                              <ul class="dropdown-menu">
                            <li><a href="{{route('retur-pembelian')}}?cari=semua"><i class="i"></i> Semua</a></li>
                            <li><a href="{{route('retur-pembelian')}}?cari=hariini"><i class="i"></i> Hari Ini</a></li>
                                <li><a href="{{route('retur-pembelian')}}?cari=bulanini"><i class="i"></i> Bulan Ini</a></li>
                                <li><a href="{{route('retur-pembelian')}}?cari=bulanlalu"><i class="i"></i> Bulan Lalu</a></li>
                                <li><a href="{{route('retur-pembelian')}}?cari=tahunini"><i class="i"></i> Tahun Ini</a></li>
                                <li><a href="#" class="tombolfilter"><i class="i"></i> Filter Tanggal</a></li>
                              </ul>
                            </div>
                              </div>    <!-- /controls -->          
                        </div>
                        <div class="row filtercari">
                            <form action="{{route('retur-pembelian')}}" action="get">
                                <input type="hidden" name="cari" value="filter">
                            <div class="span4">
                                <div class="control-group">                                         
                                    <label class="control-label" for="firstname">Dari Tanggal</label>
                                    <div class="controls">
                                        <input type="date" style="height: 15px;font-size: 14px" class="span6" placeholder="Dari Tanggal" name="dari">
                                    </div> <!-- /controls -->               
                                </div> <!-- /control-group -->
                            </div>
                            <div class="span4">
                                <div class="control-group">                                         
                                    <label class="control-label" for="firstname">Ke Tanggal</label>
                                    <div class="controls">
                                        <input type="date" style="height: 15px;font-size: 14px" class="span6" placeholder="Dari Tanggal" name="ke">
                                    </div> <!-- /controls -->               
                                </div> <!-- /control-group -->
                            </div>
                            <div class="span2">
                                <button type="button" class="btn btn-sm btn-default tutup">Tutup</button>
                                <button type="submit" class="btn btn-sm btn-warning">Cari</button>
                            </div>
                            </form>
                        </div>
                    <table id="example" class="responsive-table centered">
                        <thead class="teal lighten-3">
                            <tr>
                                <th>No. Faktur</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>PPN</th>
                                <th>Tagihan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0;?>
                            @foreach ($list_data as $beli)
                            <?php $total += $beli->tagihan_beli ?>
                            <tr class="baris-data">
                                <td><a href="{{ route('pembelian.detail', $beli->no_faktur) }}"> {{ $beli->no_faktur }}</a></td>
                                <td>{{ $beli->created_at->isoFormat('D MMMM Y') }}</td>
                                <td>@currency($beli->total_beli)</td>
                                <td>@currency($beli->ppn_beli)</td>
                                <td >
                                    <input type="hidden" class="tagihan" name="" value="{{$beli->tagihan_beli}}">
                                    @currency($beli->tagihan_beli)</td>
                                <td >
                                    <a href="{{ route('retur-pembelian-destroy', $beli->no_faktur) }}" class="icon-trash"> Retur</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $('.filtercari').hide();
    $(document).ready(function(){
        $('.tombolfilter').click(function(){
            $('.filtercari').show();
        })
        $('.tutup').click(function(){
            $('.filtercari').hide();
        })
    })


</script>    

@endsection