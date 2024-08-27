<div
    class="modal fade"
    id="createkegiatanT"
    tabindex="-1"
    aria-labelledby="createkegiatanTLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5
                    class="modal-title"
                    id="createkegiatanTLabel"
                >Tambah Kegiatan Tahunan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createKegiatanTahunanForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="namaKegiatanT"
                                    placeholder="Masukkan Nama Kegiatan"
                                    required
                                >
                                <label for="namaKegiatanT">Nama Kegiatan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="penanggungJawabT"
                                    placeholder="Masukkan Penanggung Jawab"
                                    required
                                >
                                <label for="penanggungJawabT">Penanggung Jawab</label>
                            </div>
                        </div>
                    </div>
                    <!-- Additional fields here -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveKegiatanTahunanBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('saveKegiatanTahunanBtn').addEventListener('click', function() {
                const form = document.getElementById('createKegiatanTahunanForm');
                const formData = new FormData(form);
                axios.post('/kegiatan/tahunan', formData)
                    .then(response => {
                        if (response.data.status) {
                            toastr.success(response.data.message);
                            location.reload();
                        } else {
                            toastr.error(response.data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error creating tahunan data:', error);
                        toastr.error('Terjadi kesalahan saat menambah kegiatan tahunan.');
                    });
            });
        });
    </script>
@endpush