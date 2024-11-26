<div class="modal fade" id="createKegiatanModal" tabindex="-1" aria-labelledby="createkegiatanTLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createkegiatanTLabel">Tambah Kegiatan </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createKegiatanForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" name="nama_kegiatan" id="namaKegiatanT"
                                    placeholder="Masukkan Nama Kegiatan" required>
                                <label for="namaKegiatanT">Nama Kegiatan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <input type="text" name="penanggung_jawab" class="form-control" id="penanggungJawabT"
                                    placeholder="Masukkan Penanggung Jawab" required>
                                <label for="penanggungJawabT">Penanggung Jawab</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <input type="date" class="form-control" id="tanggalPelaksanaanT"
                                    name="tanggal_pelaksanaan" required>
                                <label for="tanggalPelaksanaanT">Tanggal Pelaksanaan</label>
                            </div>
                        </div>
                        <input type="hidden" name="id_tahun_ajaran" value="{{ $id_tahun_ajaran }}">
                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <select class="form-control" id="periodeEdit" name="periode" required>
                                    <option value="Mingguan">Mingguan</option>
                                    <option value="Bulanan">Bulanan</option>
                                    <option value="Tahunan">Tahunan</option>
                                </select>
                                <label for="periodeEdit">Periode</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="saveKegiatanBtn">Simpan</button>
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
                        toastr.success(response.data.message);
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error creating  data:', error);
                        toastr.error('Terjadi kesalahan saat menambah kegiatan .');
                    });
            });
        });
    </script>
@endpush
