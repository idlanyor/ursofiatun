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
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="namaKegiatanT"
                                    placeholder="Masukkan Nama Kegiatan" required>
                                <label for="namaKegiatanT">Nama Kegiatan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="penanggungJawabT"
                                    placeholder="Masukkan Penanggung Jawab" required>
                                <label for="penanggungJawabT">Penanggung Jawab</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="tanggalPelaksanaanT"
                                    name="tanggal_pelaksanaan" required>
                                <label for="tanggalPelaksanaanT">Tanggal Pelaksanaan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-control" id="tahunAjaranT" name="id_tahun_ajaran" required>
                                    @foreach ($kegiatan as $k)
                                        <option value="{{ $k->tahunAjaran->id }}">{{ $k->tahunAjaran->tahun_mulai }} -
                                            {{ $k->tahunAjaran->tahun_akhir }}</option>
                                    @endforeach
                                </select>
                                <label for="tahunAjaranT">Tahun Ajaran</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveKegiatanBtn">Simpan</button>
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
                        console.error('Error creating  data:', error);
                        toastr.error('Terjadi kesalahan saat menambah kegiatan .');
                    });
            });
        });
    </script>
@endpush
