<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #E2EFDA;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .text-left {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Absensi</h2>
        <h3>Kelas {{ $kelas }} - {{ $bulan }} {{ $tahun }}</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Santri</th>
                <th>Hadir</th>
                <th>Sakit</th>
                <th>Izin</th>
                <th>Alpha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="text-left">{{ $data['nama'] }}</td>
                <td>{{ $data['hadir'] }}</td>
                <td>{{ $data['sakit'] }}</td>
                <td>{{ $data['izin'] }}</td>
                <td>{{ $data['alpha'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> 
