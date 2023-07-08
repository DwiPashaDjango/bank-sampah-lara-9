<!DOCTYPE html>
<html>
<head>
    <title>Struk Penarikan Tunai</title>
    <style>
        * {
            font-family: monospace;
        }
        .container {
            width: 300px;
            margin: 0 auto;
            /* text-align: center; */
        }
        .header {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }
        .sub-header {
            font-size: 12px;
        }
        .sub-footer {
            font-size: 12px;
            text-align: center;
        }
        .divider {
            border-top: 1px dashed;
            margin: 5px 0;
        }
        .item {
            font-size: 12px;
            text-align: left;
        }
        .total {
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>
<body onload="window.print();">
    <div class="container">
        <div class="header">
            <p>Bank Sampah</p>
            {{-- <p>Jalan Raya No. 123</p> --}}
        </div>
        <div class="divider"></div>
        <div class="sub-header">
            @can('role', ['admin'])
                <p>Nama : {{$data->user->name}}</p>
                <p>Tanggal: {{\Carbon\Carbon::parse($data->created_at)->translatedFormat('d-F-Y')}}</p>
                <p>Waktu  : {{\Carbon\Carbon::parse($data->created_at)->translatedFormat('H:i:s')}}</p>
                <p>Petugas: {{Auth::user()->name}}</p>
            @endcan
            @can('role', ['guest'])
                <p>Tanggal: {{\Carbon\Carbon::parse($data->created_at)->translatedFormat('d-F-Y')}}</p>
                <p>Waktu  : {{\Carbon\Carbon::parse($data->created_at)->translatedFormat('H:i:s')}}</p>
            @endcan
        </div>
        <div class="divider"></div>
        <div class="item">
            <p>Jumlah Penarikan</p>
            <p>Rp {{number_format($data->amount_withdrawn)}}</p>
        </div>
        <div class="item">
            <p>Sisa Saldo</p>
            <p>Rp {{number_format($data->saldo->total_saldo)}}</p>
        </div>
        <div class="divider"></div>
        <div class="total">
            <p>Total Penarikan: Rp {{number_format($data->amount_withdrawn)}}</p>
        </div>
        <div class="divider"></div>
        <div class="sub-footer">
            <p>Terima kasih telah menggunakan Bank Sampah yang menjangkau seluruh indonesia!</p>
        </div>
    </div>
</body>
</html>
