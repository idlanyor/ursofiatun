<div class="modal fade" id="editKegiatanModal" tabindex="-1" aria-labelledby="editKegiatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editKegiatanForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKegiatanModalLabel">Edit Kegiatan</h5>
                    <button type="button" class="btn-close tombol-close" data-bs-dismiss="modal"
                        aria-label="Tutup"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control form-control-sm" id="namaKegiatanEdit"
                                    name="nama_kegiatan">
                                <label for="namaKegiatanEdit">Nama Kegiatan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control form-control-sm" id="penanggungJawabEdit"
                                    name="penanggung_jawab" required>
                                <label for="penanggungJawabEdit">Penanggung Jawab</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <input type="date" class="form-control form-control-sm" id="tanggalPelaksanaanEdit"
                                    name="tanggal_pelaksanaan" required>
                                <label for="tanggalPelaksanaanEdit">Tanggal Pelaksanaan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <select class="form-control form-control-sm" id="tahunAjaranEdit" name="id_tahun_ajaran"
                                    required>
                                    @foreach ($kegiatan as $k)
                                        <option value="{{ $k->tahunAjaran->id_tahun_ajaran }}">
                                            {{ $k->tahunAjaran->tahun_mulai }} -
                                            {{ $k->tahunAjaran->tahun_akhir }}</option>
                                    @endforeach
                                </select>
                                <label for="tahunAjaranEdit">Tahun Ajaran</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3 form-floating">
                                <div id="editPeriode"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
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
                            // console.log(data.periode)
                            document.getElementById('namaKegiatanEdit').value = data
                                .nama_kegiatan;
                            document.getElementById('penanggungJawabEdit').value = data
                                .penanggung_jawab;
                            document.getElementById('tahunAjaranEdit').value = data
                                .id_tahun_ajaran;
                            document.getElementById('tanggalPelaksanaanEdit').value = data
                                .tanggal_pelaksanaan.split(' ')[0];
                            // document.getElementById('periodeEdit').value = data.periode;
                            let periodeEdit = document.getElementById('editPeriode');
                            periodeEdit.innerHTML = `<select class="form-control form-control-sm" name="periode" required>
                    <option value="Mingguan" ${data.periode === 'Mingguan' ? 'selected' : ''}> Mingguan</option>
                    <option value="Bulanan" ${data.periode === 'Bulanan' ? 'selected' : ''}> Bulanan</option>
                    <option value="Tahunan" ${data.periode === 'Tahunan' ? 'selected' : ''}> Tahunan</option>
                </select>`;
                        })
                        .catch(error => {
                            console.log(error)
                            console.error('Terjadi kesalahan saat mengambil data kegiatan:',
                                error);
                            alert('Terjadi kesalahan saat mengambil data kegiatan.');
                        });
                    editKegiatanForm.addEventListener('submit', function(event) {
                        event.preventDefault();
                        var formData = new FormData(editKegiatanForm);

                        axios.post(editKegiatanForm.action, formData)
                            .then(async (response) => {
                                console.log(response.data)
                                toastr.success(response.data.message);
                                editKegiatanModal.hide();
                                window.location.reload()
                            })
                            .catch(error => {
                                console.log(error)
                                alert(
                                    'Terjadi kesalahan saat memperbarui data kegiatan.'
                                );
                            });
                    });
                });
            });
        })
    </script>
@endpush
