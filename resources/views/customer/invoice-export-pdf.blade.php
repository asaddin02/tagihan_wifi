<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export PDF</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style>
        .paper {
            width: 100%;
        }

        .header {
            padding: 5px;
        }

        h1 {
            color: grey;
            text-align: center;
        }

        h1::before,
        h1::after {
            content: "";
            background-color: grey;
            display: block;
            width: 100%;
            height: 2px;
            margin: 5px 0;
        }

        .customer {
            padding: 5px;
        }

        .key,
        .value {
            color: grey;
            font-weight: bold;
            padding: 0 10px;
        }

        main {
            padding: 15px;
        }

        .invoice {
            text-align: center;
        }

        .invoice-value {
            border: 1px solid grey;
        }
    </style>
</head>

<body>
    <div class="paper">
        <header class="header">
            <h1>Struk Tagihan</h1>
            <div class="customer">
                <table>
                    <tbody>
                        <tr>
                            <td class="key">Nama</td>
                            <td class="value">: {{ $data->installation->user->name }}</td>
                        </tr>
                        <tr>
                            <td class="key">Telepon</td>
                            <td class="value">: {{ $data->installation->user->no_telepon }}</td>
                        </tr>
                        <tr>
                            <td class="key">Email</td>
                            <td class="value">: {{ $data->installation->user->email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </header>
        <main>
            <table class="invoice">
                <thead>
                    <tr>
                        <th class="key invoice-value">Instalasi Id</th>
                        <th class="key invoice-value">Bulan</th>
                        <th class="key invoice-value">Tahun</th>
                        <th class="key invoice-value">Total Tagihan</th>
                        <th class="key invoice-value">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="value invoice-value">{{ $data->installation_id }}</td>
                        <td class="value invoice-value">{{ $data->bulan }}</td>
                        <td class="value invoice-value">{{ $data->tahun }}</td>
                        <td class="value invoice-value">{{ $data->total_tagihan }}</td>
                        <td class="value invoice-value" style="color: green;">{{ $data->status_tagihan }}</td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>
</body>

</html>
