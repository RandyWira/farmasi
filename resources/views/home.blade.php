@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col span3">
        <div class="card">
            <div class="widget-header"> <i class="icon-list-alt"></i>
                <h3>Total Barang</h3>
            </div>
            <div class="widget-content">
                <div class="widget big-stats-container">
                    <div class="widget-content">
                        <div id="big_stats" class="cf">
                            <div class="stat"> <i class="icon-tags"></i> <span class="value">{{ $total_barang }}</span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End of span3 -->

    <div class="col span3">
        <div class="card">
            <div class="widget-header"> <i class="icon-list-alt"></i>
                <h3>Total Barang</h3>
            </div>
            <div class="widget-content">
                <div class="widget big-stats-container">
                    <div class="widget-content">
                        <div id="big_stats" class="cf">
                            <div class="stat"> <i class="icon-tags"></i> <span class="value"></span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End of span3 -->

    <div class="col span6">
        <div class="card">
            <div class="widget-header"> <i class="icon-list-alt"></i>
                <h3>Laba Hari Ini</h3>
            </div>
            <div class="widget-content">
                <div class="widget big-stats-container">
                    <div class="widget-content">
                        <div id="big_stats" class="cf">
                            <div class="stat"> <i class="icon-money"></i> <span class="value">@currency($laba)</span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End of span3 -->
</div><!-- End of Row -->

<div class="row">
    <div class="col span10">
        <div class="card">
            <div class="widget-header">
                <i class="icon-time"></i>
                <h3>Expire Barang Tahun Ini</h3>
            </div>
            <div class="widget-content">
                <table class="responsive-table">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Tanggal Expire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang_expd as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->expire }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $barang_expd->links() }}
            </div>
        </div>
    </div>
</div>
@endsection