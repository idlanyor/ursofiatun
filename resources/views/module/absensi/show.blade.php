<!-- Modal show -->
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="showLabel">Detail Santri</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="showForm">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" name="nama" id="showNama" placeholder="Nama Santri" readonly>
                        <label for="showNama">Nama Santri</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" name="tempat_lahir" id="showTempatLahir" placeholder="Tempat Lahir" readonly>
                                <label for="showTempatLahir">Tempat Lahir</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control form-control-sm" name="tanggal_lahir" id="showTanggalLahir" placeholder="Tanggal Lahir" readonly>
                                <label for="showTanggalLahir">Tanggal Lahir</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-control form-control-sm" name="jenis_kelamin" id="showJenisKelamin" disabled>
                            <option value="" disabled>Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <label for="showJenisKelamin">Jenis Kelamin</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" name="orang_tua" id="showOrangTua" placeholder="Orang Tua" readonly>
                                <label for="showOrangTua">Orang Tua</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" name="telepon" id="showTelepon" placeholder="Telepon" readonly>
                                <label for="showTelepon">Telepon</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" name="alamat" id="showAlamat" placeholder="Alamat" readonly>
                        <label for="showAlamat">Alamat</label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var showModal = new bootstrap.Modal(document.getElementById('showModal'));

        document.querySelectorAll('.show-btn').forEach(button => {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                axios.get(`/santri/${id}/edit`)
                    .then(response => {
                        var data = response.data;
                        document.getElementById('showNama').value = data.nama || 'Tidak ada/Belum ada';
                        document.getElementById('showTempatLahir').value = data.tempat_lahir || 'Tidak ada/Belum ada';
                        document.getElementById('showTanggalLahir').value = data.tanggal_lahir || 'Tidak ada/Belum ada';
                        document.getElementById('showJenisKelamin').value = data.jenis_kelamin || 'Tidak ada/Belum ada';
                        document.getElementById('showOrangTua').value = data.orang_tua || 'Tidak ada/Belum ada';
                        document.getElementById('showTelepon').value = data.telepon || 'Tidak ada/Belum ada';
                        document.getElementById('showAlamat').value = data.alamat || 'Tidak ada/Belum ada';
                        showForm.setAttribute('action', `/santri/${id}`);
                    })
                    .catch(error => {
                        console.error('There was an error fetching the data:', error);
                        alert('Terjadi kesalahan saat mengambil data santri.');
                    });
            });
        });
    });
</script>
