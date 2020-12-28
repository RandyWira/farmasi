<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$judul}}</title>
    <style>
        @page { size: A4 }
        body{
            font-family: arial;
            font-size: 14px;
            -webkit-print-color-adjust:exact;
        }
        h1 {
            font-weight: bold;
            font-size: 20pt;
            text-align: center;
        }
        h2 {
            font-weight: bold;
            font-size: 15pt;
            text-align: center;
        }
        h3 {
            font-weight: bold;
            font-size: 10pt;
            text-align: center;
        }

        h4 {
            font-weight: bold;
            font-size: 7pt;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        hr {
            border:1px solid #000000;
        }

        .table th {
            padding: 8px 8px;
            border:1px solid #000000;
            text-align: center;
        }

        .table td {
            padding: 3px 3px;
            border:1px solid #000000;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>{{ $config->nama }}</h1>
    <h2>{{ $config->alamat}}</h2>
    <h3 style="background-color: darkgrey"><u>Detail Mutasi Masuk </u></h3>
    <table >
        <thead>
            <tr style="background: #A9A9A9">
                <th>No Faktur</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Pembayaran</th>
            </tr>
        </thead>
        <tbody align="center">
            <tr>
                <td>{{$penjualan->nota_jual}}</td>
                <td>{{$penjualan->created_at}}</td>
                <td>{{$penjualan->nama_pembeli}}</td>
                <td>{{$penjualan->cara_bayar}}</td>
            </tr>
        </tbody>
    </table>
    <hr>
    <table border="1">
        <thead>
            <tr style="background: #A9A9A9">
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Harga Jual</th>
                <th>Diskon</th>
                <th>PPN</th>
                <th>Nilai Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $diskon = 0;
            $grand_total =0;
            $subtotal = 0;
            ?>
            @foreach($detail_jual as $i)
            <?php 
            $diskon += $i->diskon;
            $grand_total += $i->total_jual;
            // $subtotal = $
            ?>
            <tr>
                <td>{{$i->nama}}</td>
                <td>{{$i->jml_jual}}</td>
                <td>@currency($i->harga_jual)</td>
                <td>{{$i->diskon}}</td>
                <td>{{$ppn->ppn}} %</td>
                <td>{{$i->total_jual}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot style="text-align: right;font-weight:bold">
            <tr>
                <td colspan="4">Diskon</td>
                <td>PPN</td>
                <td>Grand Total</td>
            </tr>
            <tr>
                <td colspan="4">
                    @currency($diskon)
                </td>
                <td>
                    {{$ppn->ppn}} %
                </td>
                <td>
                    @currency($grand_total)
                </td>
            </tr>
        </tfoot>
    </table>
    <hr>
    <table style="text-align:right;font-weight:bold" >
        <tr style>
            <td width="87%;">Harga PPN</td>
            <td></td>
            <td>@currency($penjualan->ppn_jual)</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Total Penjualan Obat :</td>
            <td style="background-color: #48C9B0"></td>
            <td style="background-color: #48C9B0">@currency($penjualan->tagihan_jual)</td>
        </tr>
    </table>
    <br>

    <table style="text-align: center">
        <tr >
            <td width="70%"></td>
            <td>Payakumbuh, {{$today}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Penanggung Jawab</td>
        </tr>
        <tr>
            <td></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td><u><b>{{ Auth::user()->name }}</b></u></td></tr>
    </table>
</body>
<script>
    window.print();
</script>
</html>