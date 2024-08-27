<div
    class="modal fade"
    id="editKegiatanModal"
    tabindex="-1"
    aria-labelledby="editKegiatanModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <form
            id="editKegiatanForm"
            method="POST"
        >
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5
                        class="modal-title"
                        id="editKegiatanModalLabel"
                    >Edit Kegiatan</h5>
                    <button
                        type="button"
                        class="btn-close tombol-close"
                        data-bs-dismiss="modal"
                        aria-label="Tutup"
                    ></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="namaKegiatanEdit"
                                    name="nama_kegiatan"
                                >
                                <label for="namaKegiatanEdit">Nama Kegiatan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="penanggungJawabEdit"
                                    name="penanggung_jawab"
                                    required
                                >
                                <label for="penanggungJawabEdit">Penanggung Jawab</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input
                                    type="date"
                                    class="form-control"
                                    id="tanggalPelaksanaanEdit"
                                    name="tanggal_pelaksanaan"
                                    required
                                >
                                <label for="tanggalPelaksanaanEdit">Tanggal Pelaksanaan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select
                                    class="form-control"
                                    id="tahunAjaranEdit"
                                    name="id_tahun_ajaran"
                                    required
                                >
                                    @foreach ($kegiatan as $k)
                                        <option value="{{ $k->tahunAjaran->id }}">{{ $k->tahunAjaran->tahun_mulai }} -
                                            {{ $k->tahunAjaran->tahun_akhir }}</option>
                                    @endforeach
                                </select>
                                <label for="tahunAjaranEdit">Tahun Ajaran</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <select
                                    class="form-control"
                                    id="periodeEdit"
                                    name="periode"
                                    required
                                >
                                    <option value="Mingguan">Mingguan</option>
                                    <option value="Bulanan">Bulanan</option>
                                    <option value="Tahunan">Tahunan</option>
                                </select>
                                <label for="periodeEdit">Periode</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >Simpan</button>
                </div>
            </div>
        </form>

    </div>
</div>
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let editKegiatanBtns = document.querySelectorAll('.btn-edit-kegiatan');
            let editKegiatanModal = new bootstrap.Modal(document.getElementById(
                'editKegiatanModal'), {
                keyboard: false
            });
            let tombolClose = document.querySelector('.tombol-close')
            tombolClose.addEventListener('click', function(e) {
                e.preventDefault();
                editKegiatanModal.hide();
            })
            editKegiatanBtns.forEach(button => {
                button.addEventListener('click', function() {
                    editKegiatanModal.show();
                    let id = this.getAttribute('data-id');
                    let editKegiatanForm = document.getElementById('editKegiatanForm');
                    editKegiatanForm.setAttribute('action', `/kegiatan/${id}`);
                    axios.get(`/kegiatan/${id}`).then(response => {
                            var data = response.data;
                            document.getElementById('namaKegiatanEdit').value = data
                                .nama_kegiatan;
                            document.getElementById('penanggungJawabEdit').value = data
                                .penanggung_jawab;
                            document.getElementById('tahunAjaranEdit').value = data
                                .id_tahun_ajaran;
                            document.getElementById('tanggalPelaksanaanEdit').value = data
                                .tanggal_pelaksanaan;
                            document.getElementById('periodeEdit').value = data.periode;
                        })
                        .catch(error => {
                            console.error('Terjadi kesalahan saat mengambil data kegiatan:',
                                error);
                            alert('Terjadi kesalahan saat mengambil data kegiatan.');
                        });
                    editKegiatanForm.addEventListener('submit', function(event) {
                        event.preventDefault();
                        var formData = new FormData(editKegiatanForm);

                        axios.post(editKegiatanForm.action, formData)
                            .then(response => {
                                console.log(response.data)
                                toastr.success(response.data.message);
                                editKegiatanModal.hide();
                                window.location.reload();
                            })
                            .catch(error => {
                                console.log(error)
                                alert(
                                    'Terjadi kesalahan saat memperbarui data kegiatan.');
                            });
                    });
                });
            });
        })
    </script>
@endpush
