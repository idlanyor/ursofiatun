@extends('template.scaffold')
@section('title', 'Data Absensi')
@section('style')
    <style>
        .table td,
        .table th {
            white-space: nowrap;
            text-align: center;
        }

        .table td input[type="text"] {
            width: 30px;
            padding: 2px;
            text-align: center;
            border: 1px solid #ced4da;
            background-color: green;
            color: white;
            border-radius: 4px;
        }

        .table-responsive {
            overflow-x: auto;
        }
    </style>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Data Absensi</h5>
                <div class="dropdown">
                    <select class="form-select" id="pilih-bulan">
                        {{-- @foreach ($absensiKelas as $d)
                            <li><a class="dropdown-item" href="#">{{ $d->bulan }}</a></li>
                        @endforeach --}}
                    </select>
                </div>
            </div>
            <div class="card-body">
                <form id="absensiForm">
                    @csrf
                    <div id="tableContainer" class="table-responsive">
                        <!-- Tabel akan diisi oleh JavaScript -->
                    </div>
                    <div class="mt-3 float-end">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-floppy-disk"></i>
                            </span>
                            <span class="text">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const idAbsen = {{ Js::from($idAbsen) }};
        const absensiKelas = {{ Js::from($absensiKelas) }};
        const santri = {{ Js::from($santri) }};
        console.log(absensiKelas)
        // Console
        document.addEventListener('DOMContentLoaded', async () => {
                const pilihBulan = document.getElementById('pilih-bulan');
                const tableContainer = document.getElementById('tableContainer');
                const absensiForm = document.getElementById('absensiForm');


                // // Mengisi pilihan bulan
                absensiKelas.forEach((e) => {
                    const option = document.createElement('option');
                    option.value = e.bulan;
                    option.textContent = e.bulan.toUpperCase();
                    pilihBulan.appendChild(option);
                });

                // Fungsi untuk memuat data absensi
                async function loadAbsensiData(bulan) {
                    try {

                        let tableHTML = `
                        <table id="dataAbsensiTable" class="table align-middle table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Santri</th>
                                    ${Array.from({length: 31}, (_, i) => `<th>${i + 1}</th>`).join('')}
                        </tr> </thead>
                    <tbody class = "table-group-divider" >
                    `;

santri.forEach(ds => {
    tableHTML += ` <tr>
                        <td class = "text-left" > ${
                            ds.nama
                        } </td> <input type = "hidden" name = "santri_id"
                         value = "${ds.id_santri}" >
                        `;
                        for (let i = 1; i <= 31; i++) {
                            // const attendanceValue = absensiSantri.find(a => a.santri_id === ds.id_santri)?.[i] || 'I';
                            tableHTML += `
                                <td>
                                    <input type="text"
                                        name="absensi[${i}]"
                                        list="jenis_absen" value="H" maxlength="1"
                                        onfocus="this.value=''" oninput="changeBgInput(this, this.value)">
                                </td>
                            `;
                        }

    tableHTML += `</tr>`;
                    });

                tableHTML += `
                        </tbody>
                        </table>
                        <datalist id="jenis_absen">
                            <option value="H">
                            <option value="S">
                            <option value="I">
                            <option value="A">
                        </datalist>
                    `;

                tableContainer.innerHTML = tableHTML;
            } catch (error) {
                console.error('Error loading absensi data:', error);
            }
        }

        // Memuat data awal
        loadAbsensiData(pilihBulan.value);

        // Event listener untuk perubahan bulan
        pilihBulan.addEventListener('change', () => loadAbsensiData(pilihBulan.value));

        // Event listener untuk pengiriman form
        absensiForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        try {
            const formData = new FormData(absensiForm);
            await axios.post('{{ route('absensi.store') }}', formData);
            alert('Data absensi berhasil disimpan');
        } catch (error) {
            console.error('Error saving absensi data:', error);
            alert('Terjadi kesalahan saat menyimpan data absensi');
        }
        });
        });
    </script>
@endpush
@push('style')
    <script>
        function changeBgInput(el, val) {
            switch (val) {
                case 'H':
                    el.style.backgroundColor = 'green';
                    el.style.color = 'white'; // Text color for H
                    break;
                case 'S':
                    el.style.backgroundColor = 'yellow';
                    el.style.color = 'black'; // Text color for S (yellow bg, so black text)
                    break;
                case 'I':
                    el.style.backgroundColor = 'blue';
                    el.style.color = 'white'; // Text color for I
                    break;
                case 'A':
                    el.style.backgroundColor = 'red';
                    el.style.color = 'white'; // Text color for A
                    break;
                default:
                    el.style.backgroundColor = '';
                    el.style.color = ''; // Reset text color
                    break;
            }
        }
    </script>
@endpush
