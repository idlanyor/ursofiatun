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
                <h5>Data Absensi {{ $absensiKelasBulan->bulan }} </h5>
                <div class="dropdown">
                    <select class="form-select" id="pilih-bulan">
                        @foreach ($bulanList as $bulan)
                            <option value="{{ $bulan }}" {{ $absensiKelasBulan->bulan == $bulan ? 'selected' : '' }}>
                                {{ strtoupper($bulan) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body">
                <form id="absensiForm">
                    @csrf
                    <div id="tableContainer" class="table-responsive">
                        <input type="hidden" name="absensi_kelas_id" value="{{ $absensiKelasBulan->id }}">
                        <table id="dataAbsensiTable" class="table table-sm align-middle table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Santri</th>
                                    @foreach($tanggalAbsensi as $tanggal)
                                        <th>{{ $tanggal }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($santriList as $santri)
                                    <tr>
                                        <td class="text-left">{{ $santri->nama }}</td>
                                        @foreach($tanggalAbsensi as $tanggal)
                                            <td>
                                                @php
                                                    $absensi = $absensiData->where('santri_id', $santri->id)
                                                                         ->where('tanggal', $tanggal)
                                                                         ->first();
                                                    $nilai = $absensi ? $absensi->status : 'H';
                                                @endphp
                                                <input type="text"
                                                    name="absensi[{{ $santri->id }}][{{ $tanggal }}]"
                                                    list="jenis_absen"
                                                    value="{{ $nilai }}"
                                                    maxlength="1"
                                                    style="background-color: {{ $nilai == 'H' ? 'green' : ($nilai == 'S' ? 'yellow' : ($nilai == 'I' ? 'blue' : ($nilai == 'A' ? 'red' : ''))) }};
                                                           color: {{ in_array($nilai, ['H','I','A']) ? 'white' : 'black' }}"
                                                    onfocus="this.value=''"
                                                    oninput="changeBgInput(this, this.value)">
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <datalist id="jenis_absen">
                            <option value="H">
                            <option value="S">
                            <option value="I">
                            <option value="A">
                        </datalist>
                    </div>
                    <div class="mt-3 float-end">
                        <button type="submit" class="btn btn-sm btn-primary btn-icon-split">
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
        document.addEventListener('DOMContentLoaded', () => {
            const pilihBulan = document.getElementById('pilih-bulan');
            const absensiForm = document.getElementById('absensiForm');

            pilihBulan.addEventListener('change', () => {
                window.location.href = `{{ route('absensi.show', $absensiKelasBulan->kelas_id) }}?bulan=${pilihBulan.value}`;
            });

            absensiForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                try {
                    const formData = new FormData(absensiForm);
                    await axios.post('{{ route('absensi.store') }}', formData);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data absensi berhasil disimpan'
                    }).then(() => {
                        window.location.reload();
                    });
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat menyimpan data absensi'
                    });
                }
            });
        });
    </script>
@endpush

@push('style')
    <script>
        function changeBgInput(el, val) {
            val = val.toUpperCase();
            switch (val) {
                case 'H':
                    el.style.backgroundColor = 'green';
                    el.style.color = 'white';
                    break;
                case 'S':
                    el.style.backgroundColor = 'yellow';
                    el.style.color = 'black';
                    break;
                case 'I':
                    el.style.backgroundColor = 'blue';
                    el.style.color = 'white';
                    break;
                case 'A':
                    el.style.backgroundColor = 'red';
                    el.style.color = 'white';
                    break;
                default:
                    el.style.backgroundColor = '';
                    el.style.color = '';
                    break;
            }
            el.value = val;
        }
    </script>
@endpush
