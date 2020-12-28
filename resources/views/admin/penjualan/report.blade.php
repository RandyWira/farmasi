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
                    <div class="tabable">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#hariini" data-toggle="tab">Penjualan Hari Ini</a>
                            </li>
                            <li>
                                <a href="#per-tanggal" data-toggle="tab">Filter per Tanggal</a>
                            </li>
                            <li>
                                <a href="#all-data" data-toggle="tab">Seluruh Transaksi Penjualan</a>
                            </li>
                        </ul>

                        <br>

                        <div class="tab-content">
                            <div class="tab-pane active" id="hariini">
                                <table class="responsive-table centered">
                                    <thead class="teal lighten-3">
                                        <tr>
                                            <th>No. Nota</th>
                                            <th>Tanggal</th>
                                            <th>Total</th>
                                            <th>PPN</th>
                                            <th>HPP</th>
                                            <th>Tagihan</th>
                                            <th>Laba</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $laba_hariini = 0; ?>
                                        @foreach ($penjualan_hariini as $hariini)
                                        <?php $laba_hariini += $hariini->tagihan_jual - $hariini->hpp; ?>
                                        <tr>
                                            <td><a href="{{ route('penjualan.detail', $hariini->nota_jual) }}"> {{ $hariini->nota_jual }}</a></td>
                                            <td>{{ $hariini->created_at->isoFormat('D MMMM Y') }}</td>
                                            <td>@currency($hariini->total_jual)</td>
                                            <td>@currency($hariini->ppn_jual)</td>
                                            <td>@currency($hariini->hpp)</td>
                                            <td>@currency($hariini->tagihan_jual)</td>
                                            <td>@currency($hariini->tagihan_jual - $hariini->hpp)</td>
                                            <td>
                                                <a href="{{ route('penjualan.cetak_nota', $hariini->nota_jual) }}" target="_blank" class="icon-print"> Cetak Nota</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="6" style="text-align: right; font-weight:bold">Untung Bersih</td>
                                            <td style="font-weight:bold">@currency($laba_hariini)</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="all-data">
                                <table class="responsive-table centered">
                                    <thead class="teal lighten-3">
                                        <tr>
                                            <th>No. Nota</th>
                                            <th>Tanggal</th>
                                            <th>Total</th>
                                            <th>PPN</th>
                                            <th>HPP</th>
                                            <th>Tagihan</th>
                                            <th>Laba</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $laba = 0;
                                        ?>
                                        @foreach ($report_jual as $jual)
                                        
                                        <tr>
                                            <td><a href="{{ route('penjualan.detail', $jual->nota_jual) }}"> {{ $jual->nota_jual }}</a></td>
                                            <td>{{ $jual->created_at->isoFormat('D MMMM Y') }}</td>
                                            <td>@currency($jual->total_jual)</td>
                                            <td>@currency($jual->ppn_jual)</td>
                                            <td>@currency($jual->hpp)</td>
                                            <td>@currency($jual->tagihan_jual)</td>
                                            <td>@currency($jual->tagihan_jual - $jual->hpp)</td>
                                            <td>
                                                <a href="{{ route('penjualan.cetak_nota', $jual->nota_jual) }}" target="_blank" class="icon-print"> Cetak Nota</a>
                                            </td>
                                            <?php $laba += $jual->tagihan_jual - $jual->hpp ?>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="6" style="text-align: right; font-weight:bold">Untung Bersih</td>
                                            <td style="font-weight:bold">@currency($laba)</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="per-tanggal">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection