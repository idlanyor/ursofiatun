@extends('template.scaffold')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Input Nilai Kelas {{ $kelas->nama_kelas }}</h5>
            <div class="d-flex gap-2">
                <select id="mapel" class="form-select">
                    <option value="">Pilih Mata Pelajaran</option>
                    @foreach($mapelList as $mapel)
                        <option value="{{ $mapel->id_mata_pelajaran }}"
                            {{ $mapel_id == $mapel->id_mata_pelajaran ? 'selected' : '' }}>
                            {{ $mapel->nama_mapel }}
                        </option>
                    @endforeach
                </select>
                <button class="btn btn-sm btn-primary" onclick="loadNilai()">Tampilkan</button>
            </div>
        </div>
        <div class="card-body">
            @if($mapel_id)
            <form id="formNilai">
                @csrf
                <input type="hidden" name="kelas_id" value="{{ $kelas->id_kelas }}">
                <input type="hidden" name="mapel_id" value="{{ $mapel_id }}">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="25%">Nama Santri</th>
                                <th width="20%">Ulangan 1</th>
                                <th width="20%">Ulangan 2</th>
                                <th width="20%">Ulangan 3</th>
                                <th width="10%">Rata-rata</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($santriList as $index => $santri)
                            @php
                                $nilai = $nilaiData->where('santri_id', $santri->id_santri)->first();
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $santri->nama }}</td>
                                <td>
                                    <input type="number" class="form-control nilai-input"
                                           name="nilai[{{ $santri->id_santri }}][ulangan_1]"
                                           value="{{ $nilai?->ulangan_1 }}"
                                           min="0" max="100"
                                           data-row="{{ $index }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control nilai-input"
                                           name="nilai[{{ $santri->id_santri }}][ulangan_2]"
                                           value="{{ $nilai?->ulangan_2 }}"
                                           min="0" max="100"
                                           data-row="{{ $index }}">
                                </td>
                                <td>
                                    <input type="number" class="form-control nilai-input"
                                           name="nilai[{{ $santri->id_santri }}][ulangan_3]"
                                           value="{{ $nilai?->ulangan_3 }}"
                                           min="0" max="100"
                                           data-row="{{ $index }}">
                                </td>
                                <td>
                                    <span id="rata-{{ $index }}">-</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-sm btn-primary">Simpan Nilai</button>
                </div>
            </form>
            @else
            <div class="alert alert-info">
                Silakan pilih mata pelajaran terlebih dahulu
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formNilai');

    if (form) {
        // Hitung rata-rata saat halaman dimuat
        document.querySelectorAll('tr').forEach(row => {
            hitungRataRata(row);
        });

        // Hitung rata-rata saat nilai diubah
        document.querySelectorAll('.nilai-input').forEach(input => {
            input.addEventListener('input', function() {
                const row = this.closest('tr');
                hitungRataRata(row);
            });
        });

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            try {
                const response = await axios.post('{{ route('nilai.store') }}', new FormData(form));

                if (response.data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.data.message
                    });
                } else {
                    throw new Error(response.data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: error.response?.data?.message || 'Terjadi kesalahan saat menyimpan nilai'
                });
            }
        });
    }
});

function loadNilai() {
    const mapel = document.getElementById('mapel').value;
    if (!mapel) {
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian',
            text: 'Silakan pilih mata pelajaran terlebih dahulu'
        });
        return;
    }
    window.location.href = "{{ route('nilai.input', ['id_kelas' => $kelas->id_kelas]) }}?mapel_id=" + mapel;
}

function hitungRataRata(row) {
    const inputs = row.querySelectorAll('.nilai-input');
    const rataSpan = row.querySelector('span[id^="rata-"]');

    if (inputs.length && rataSpan) {
        let total = 0;
        let count = 0;

        inputs.forEach(input => {
            if (input.value) {
                total += parseFloat(input.value);
                count++;
            }
        });

        if (count > 0) {
            rataSpan.textContent = (total / count).toFixed(2);
        } else {
            rataSpan.textContent = '-';
        }
    }
}
</script>
@endpush
