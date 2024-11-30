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
                <h5>Data Absensi {{ request()->query('bulan') }} </h5>
                <div class="dropdown">
                    <select class="form-select" id="pilih-bulan">
                        @foreach ($absensiKelas as $d)
                            <option value="{{ $d->bulan }}">{{ strtoupper($d->bulan) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body">
                <form id="absensiForm">
                    @csrf
                    <div id="tableContainer" class="table-responsive">
                        <input type="hidden" name="absensi_kelas_id" value="{{ $absensiKelasBulan->id_absensi_kelas }}">
                        <table id="dataAbsensiTable" class="table table-sm align-middle table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Santri</th>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <th>{{ $i }}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($santri as $s)
                                    <tr>
                                        <td class="text-left">{{ $s->nama }}</td>
                                        <input type="hidden" name="santri_id" value="{{ $s->id_santri }}">
                                        @for ($i = 1; $i <= 31; $i++)
                                            <td>
                                                <input type="text"
                                                    name="absensi[{{ $s->id_santri }}][{{ $i }}]"
                                                    list="jenis_absen"
                                                    value="{{ $absensiSantri->where('santri_id', $s->id_santri)->first()->{$i} ?? 'H' }}"
                                                    maxlength="1" onfocus="this.value=''"
                                                    oninput="changeBgInput(this, this.value)">
                                            </td>
                                        @endfor
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
            // const bulanTitle = document.getElementById('bulanTitle');
            const absensiForm = document.getElementById('absensiForm');

            // Set initial bulan title
            // bulanTitle.textContent = pilihBulan.value;

            // Event listener untuk perubahan bulan
            pilihBulan.addEventListener('change', () => {
                window.location.href = `{{ route('absensi.show', $idAbsen) }}?bulan=${pilihBulan.value}`;
            });

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
        }
    </script>
@endpush
