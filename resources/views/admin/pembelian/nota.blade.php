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

    <h1 style="background-color: darkgrey"><u>Detail Pembelian </u></h1>
    <table >
        <thead>
            <tr style="background: #A9A9A9">
                <th>No Faktur</th>
                <th>Tanggal</th>
                <th>Nama Supplier</th>
            </tr>
        </thead>
        <tbody align="center">
            <tr>
                <td>{{$pembelian->no_faktur}}</td>
                <td>{{$pembelian->created_at}}</td>
                <td>{{$nama_supplier->nama}}</td>
            </tr>
        </tbody>
    </table>
    <hr>
    <table border="1">
        <thead>
            <tr style="background: #A9A9A9">
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Harga Beli</th>
                <th>Diskon</th>
                <th>Nilai Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $diskon = 0;
            $grand_total =0;
            $subtotal = 0;
            ?>
            @foreach($detail_beli as $i)
            <?php 
            $diskon += $i->diskon;
            $grand_total += $i->total;
            // $subtotal = $
            ?>
            <tr>
                <td>{{$i->nama}}</td>
                <td>{{$i->jml_beli}}</td>
                <td>@currency($i->harga)</td>
                <td>{{$i->diskon}}</td>
                <td>@currency($i->total)</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot style="text-align: right;font-weight:bold">
            <tr>
                <td colspan="4">Diskon</td>
                <td>Grand Total</td>
            </tr>
            <tr>
                <td colspan="4">
                    @currency($diskon)
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
            <td>@currency($pembelian->ppn_beli)</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Total Pembelian Obat :</td>
            <td style="background-color: #48C9B0"></td>
            <td style="background-color: #48C9B0">@currency($pembelian->tagihan_beli)</td>
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
<!-- <script>
    window.print();
</script> -->
</html>