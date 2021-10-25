<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .table {
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
            /* margin: 0 auto; */
        }

        .table td,
        .table th {
            padding: 8px;
        }

        .table th {
            padding-top: 12px;
            padding-bottom: 12px;
        }

        .text-center {
            text-align: center
        }

        .new-page {
            page-break-before: always;
        }

        .container {
            padding-top: 5px;
        }

        .bio {
            padding-left: 25px;
        }

        .bio th {
            width: 130px;
            text-align: left;
        }

        .table th {
            min-width: 200px;
            text-align: left;
        }
    </style>


</head>

<body>
    @php
    $count = ["ok", "o"];
    @endphp
    @foreach ($count as $item)
    <div class="container">
        <h1 class="text-center">Gaji Dosen</h1>
        <table class="bio">
            <tr>
                <th>NIP</th>
                <td>Yogi Wiguna</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>Yogi Wiguna</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>Yogi Wiguna</td>
            </tr>
        </table>
        <hr>
        <table class="table">
            <tr>
                <th>Gaji Pokok </th>
                <td>R, 19000000</td>
            </tr>
        </table>
    </div>
    <div class="new-page"></div>
    @endforeach
</body>

</html>