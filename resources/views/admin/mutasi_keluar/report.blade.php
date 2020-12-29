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
                            <h2>Laporan Mutasi Keluar {{$carijudul}} Dari {{$data['dari']}} Ke {{$data['ke']}}</h2>
                        <?php else:?>
                            <h2>Laporan Mutasi Keluar {{$carijudul}}</h2>
                        <?php endif;?>
                        <br>

                    <div class="control-group">
                                    
                            <div class="controls">
                              <div class="btn-group">
                              <a class="btn btn-primary" href="#"><i style="font-size: 15px" class="icon-calendar icon-white"></i> Filter Pencarian</a>
                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                              <ul class="dropdown-menu">
                            <li><a href="{{route('report-mutasi-keluar')}}?cari=semua"><i class="i"></i> Semua</a></li>
                            <li><a href="{{route('report-mutasi-keluar')}}?cari=hariini"><i class="i"></i> Hari Ini</a></li>
                                <li><a href="{{route('report-mutasi-keluar')}}?cari=bulanini"><i class="i"></i> Bulan Ini</a></li>
                                <li><a href="{{route('report-mutasi-keluar')}}?cari=bulanlalu"><i class="i"></i> Bulan Lalu</a></li>
                                <li><a href="{{route('report-mutasi-keluar')}}?cari=tahunini"><i class="i"></i> Tahun Ini</a></li>
                                <li><a href="#" class="tombolfilter"><i class="i"></i> Filter Tanggal</a></li>
                              </ul>
                            </div>
                              </div>    <!-- /controls -->          
                        </div>
                        <div class="row filtercari">
                            <form action="{{route('report-mutasi-keluar')}}" action="get">
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
                                <th>No. Mutasi</th>
                                <th>Tanggal</th>
                                <th>Ke</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report_mutasi_keluar as $beli)
                            <tr>
                                <td><a href="{{ route('mutasi_keluar.detail', $beli->no_mutasi) }}"> {{ $beli->no_mutasi }}</a></td>
                                <td>{{ $beli->tanggal}}</td>
                                <td>{{ $beli->ke}}</td>
                                <td>
                                    <a href="{{ route('mutasi_keluar.cetak_nota', $beli->no_mutasi) }}" target="_blank" class="icon-print"> Cetak Data</a>
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
    $(document).ready(function($) {
        $('.tombolfilter').click(function() {
            $('.filtercari').show();
        });
        $('.tutup').click(function() {
            $('.filtercari').hide();
        });
    });
</script>

@endsection