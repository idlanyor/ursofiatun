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

        /* Warna latar dan teks sesuai dengan fungsimu */
        .S {
            background-color: yellow;
            color: black;
        }

        .I {
            background-color: blue;
            color: white;
        }

        .A {
            background-color: red;
            color: white;
        }

        /* Untuk keterangan di bawah */
        .keterangan span {
            padding: 4px;
            margin-right: 10px;
            border-radius: 4px;
            font-weight: bold;
        }


        .keterangan .S {
            background-color: yellow;
            color: black;
        }

        .keterangan .I {
            background-color: blue;
            color: white;
        }

        .keterangan .A {
            background-color: red;
            color: white;
        }
    </style>
</head>

<body>
    <div class="title">DATA ABSENSI SANTRI TPQ AL FALAH</div>
    <p style="text-align: center;">BULAN {{ $bulan }}</p>
    <p style="text-align: center;">TAHUN AJARAN {{ $tahun_ajaran }}</p>
    <p style="text-align: left;">Kelas : XI Akuntansi</p>
    <table>
        <thead>
            <tr class="header-row">
                <th rowspan="2">Nama Santri</th>
                <th colspan="31">Tanggal</th>
            </tr>
            <tr>
                @for ($i = 1; $i <= 31; $i++)
                    <th>{{ $i }}</th>
                @endfor
            </tr>
            </tr>
        </thead>
        <tbody>
            @foreach ($santri as $data)
                <tr>
                    <td>{{ $data['nama'] }}</td>
                    @foreach ($data['absensi'] as $absen)
                        <td class="{{ $absen }}">{{ $absen }}</td> <!-- Class based on value -->
                    @endforeach
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
