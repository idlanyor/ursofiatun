<html>

<head>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            text-align: center;
            padding: 8px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Untuk keterangan di bawah */
        .keterangan span {
            padding: 4px;
            margin-right: 10px;
            border-radius: 4px;
            font-weight: bold;
        }


    </style>
</head>

<body>
    <div class="title">DATA ABSENSI SANTRI TPQ AL FALAH</div>
    <p style="text-align: center;">Bulan {{ $bulan }}</p>
    <p style="text-align: center;">Tahun {{ $tahun }}</p>
    <p style="text-align: left;">Kelas : {{ $kelas }}</p>
    <table>
        <thead>
            <tr class="header-row">
                <th rowspan="2">Nama Santri</th>
                <th colspan="31">Tanggal</th>
                <th rowspan="2">H</th>
                <th rowspan="2">S</th>
                <th rowspan="2">I</th>
                <th rowspan="2">A</th>
            </tr>
            <tr>
                @for ($i = 1; $i <= 31; $i++)
                    <th>{{ $i }}</th>
                @endfor
            </tr>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensi as $data)
                <tr>
                    <td>{{ $data['nama'] }}</td>
                    {{-- for ($i = 1; $i <= $jumlahHari; $i++) {
                        $row["tgl_$i"] = $absensiData->get($i)?->status ?? '-';
                    } --}}
                    @for ($i = 1; $i <= $jumlahHari; $i++)
                        <td>{{ $data["tgl_$i"] }}</td> <!-- Class based on value -->
                    @endfor
                    <td>{{ $data['hadir'] }}</td>
                    <td>{{ $data['sakit'] }}</td>
                    <td>{{ $data['izin'] }}</td>
                    <td>{{ $data['alpha'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Keterangan dengan warna sesuai -->
    <p class="keterangan">
        <span class="H">H : Hadir</span>
        <span class="S">S : Sakit</span>
        <span class="I">I : Izin</span>
        <span class="A">A : Alpha/Tanpa Keterangan</span>
    </p>
</body>

</html>
