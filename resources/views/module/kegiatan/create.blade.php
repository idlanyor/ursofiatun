<div
    class="modal fade"
    id="createKegiatanModal"
    tabindex="-1"
    aria-labelledby="createKegiatanModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5
                    class="modal-title"
                    id="createKegiatanModalLabel"
                >Tambah Kegiatan</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form id="createKegiatanForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="nama_kegiatan"
                                    name="nama_kegiatan"
                                    placeholder="Masukkan Nama Kegiatan"
                                    required
                                >
                                <label for="nama_kegiatan">Nama Kegiatan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="penanggung_jawab"
                                    name="penanggung_jawab"
                                    placeholder="Masukkan Penanggung Jawab"
                                    required
                                >
                                <label for="penanggung_jawab">Penanggung Jawab</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select
                                    class="form-control"
                                    id="periode"
                                    name="periode"
                                >
                                    <option value="Mingguan">Mingguan</option>
                                    <option value="Bulanan">Bulanan</option>
                                    <option value="Tahunan">Tahunan</option>
                                </select>
                                <label for="periode">Periode</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input
                                    type="date"
                                    class="form-control"
                                    id="tanggal_pelaksanaan"
                                    name="tanggal_pelaksanaan"
                                    required
                                >
                                <label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <select
                                    class="form-control"
                                    id="id_tahun_ajaran"
                                    name="id_tahun_ajaran"
                                    required
                                >
                                    @foreach ($kegiatan as $k)
                                        <option value="{{ $k->tahunAjaran->id }}">{{ $k->tahunAjaran->tahun_mulai }} -
                                            {{ $k->tahunAjaran->tahun_akhir }}</option>
                                    @endforeach
                                </select>
                                <label for="id_tahun_ajaran">Tahun Ajaran</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >Close</button>
                <button
                    type="button"
                    class="btn btn-primary"
                    id="saveKegiatanBtn"
                >Simpan</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('saveKegiatanBtn').addEventListener('click', function() {
                const form = document.getElementById('createKegiatanForm');
                const formData = new FormData(form);
                axios.post('/kegiatan', formData)
                    .then(response => {
                        if (response.data.status) {
                            toastr.success(response.data.message);
                            location.reload();
                        } else {
                            toastr.error(response.data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error creating data:', error);
                        toastr.error('Terjadi kesalahan saat menambah kegiatan.');
                    });
            });
        });
    </script>
@endpush
