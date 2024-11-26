@extends('template.scaffold')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Absensi Harian Kelas {{ $kelas->nama_kelas }}</h5>
            <div class="d-flex gap-2">
                <input type="date" id="tanggal" class="form-control" value="{{ $tanggal }}" max="{{ date('Y-m-d') }}">
                <button class="btn btn-sm btn-primary" onclick="loadAbsensi()">Tampilkan</button>
                <div class="dropdown">
                    <button class="btn btn-sm btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Download Laporan
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('absensi.export', [
                                'id_kelas' => $kelas->id_kelas,
                                'bulan' => date('m', strtotime($tanggal)),
                                'tahun' => date('Y', strtotime($tanggal)),
                                'format' => 'xlsx'
                            ]) }}">
                                Excel
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('absensi.export', [
                                'id_kelas' => $kelas->id_kelas,
                                'bulan' => date('m', strtotime($tanggal)),
                                'tahun' => date('Y', strtotime($tanggal)),
                                'format' => 'pdf'
                            ]) }}">
                                PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form id="formAbsensi" method="POST">
                @csrf
                <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                <input type="hidden" name="id_absensi_kelas" value="{{ $absensiKelas->id_absensi_kelas }}">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="25%">Nama Santri</th>
                                <th width="45%">Status</th>
                                <th width="25%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($santriList as $index => $santri)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $santri->nama }}</td>
                                <td>
                                    <div class="btn-group w-100" role="group">
                                        @php
                                            $status = $absensiData->where('id_santri', $santri->id_santri)->first()?->status ?? 'H';
                                        @endphp
                                        <input type="radio" class="btn-check" name="status[{{ $santri->id_santri }}]"
                                               id="hadir{{ $santri->id_santri }}" value="H"
                                               {{ $status == 'H' ? 'checked' : '' }}>
                                        <label class="btn btn-sm btn-outline-success" for="hadir{{ $santri->id_santri }}">Hadir</label>

                                        <input type="radio" class="btn-check" name="status[{{ $santri->id_santri }}]"
                                               id="sakit{{ $santri->id_santri }}" value="S"
                                               {{ $status == 'S' ? 'checked' : '' }}>
                                        <label class="btn btn-sm btn-outline-warning" for="sakit{{ $santri->id_santri }}">Sakit</label>

                                        <input type="radio" class="btn-check" name="status[{{ $santri->id_santri }}]"
                                               id="izin{{ $santri->id_santri }}" value="I"
                                               {{ $status == 'I' ? 'checked' : '' }}>
                                        <label class="btn btn-sm btn-outline-info" for="izin{{ $santri->id_santri }}">Izin</label>

                                        <input type="radio" class="btn-check" name="status[{{ $santri->id_santri }}]"
                                               id="alpha{{ $santri->id_santri }}" value="A"
                                               {{ $status == 'A' ? 'checked' : '' }}>
                                        <label class="btn btn-sm btn-outline-danger" for="alpha{{ $santri->id_santri }}">Alpha</label>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" class="form-control"
                                           name="keterangan[{{ $santri->id_santri }}]"
                                           value="{{ $absensiData->where('id_santri', $santri->id_santri)->first()?->keterangan ?? '' }}"
                                           placeholder="Tambahkan keterangan jika perlu">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-sm btn-primary">Simpan Absensi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formAbsensi');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        try {
            const formData = new FormData(form);
            const response = await axios.post('{{ route('absensi.harian.store') }}', formData);

            if (response.data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.data.message
                });
            } else {
                throw new Error(response.data.message || 'Terjadi kesalahan');
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: error.response?.data?.message || 'Terjadi kesalahan saat menyimpan data'
            });
        }
    });
});

function loadAbsensi() {
    const tanggal = document.getElementById('tanggal').value;
    window.location.href = "{{ route('absensi.harian', ['id_kelas' => $kelas->id_kelas]) }}?tanggal=" + tanggal;
}
</script>
@endpush
