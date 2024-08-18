<!-- Modal show -->
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="showLabel">Detail Guru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="showForm">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" disabled name="nama" id="showNama"
                            placeholder="Nama Guru">
                        <label for="showNama">Nama Guru</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" disabled name="tempat_lahir"
                                    id="showTempatLahir" placeholder="Tempat Lahir">
                                <label for="showTempatLahir">Tempat Lahir</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" disabled name="tanggal_lahir"
                                    id="showTanggalLahir" placeholder="Tanggal Lahir">
                                <label for="showTanggalLahir">Tanggal Lahir</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <select disabled class="form-control" name="jenis_kelamin" id="showJenisKelamin" required>
                            <option value="" disabled>Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <label for="showJenisKelamin">Jenis Kelamin</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" disabled name="alamat" id="showAlamat"
                                    placeholder="Alamat">
                                <label for="showAlamat">Alamat</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" disabled name="telepon" id="showTelepon"
                                    placeholder="Telepon">
                                <label for="showTelepon">Telepon</label>
                            </div>
                        </div>
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
                axios.get(`/guru/${id}/edit`)
                    .then(response => {
                        var data = response.data;
                        document.getElementById('showNama').value = data.nama;
                        document.getElementById('showTempatLahir').value = data
                            .tempat_lahir;
                        document.getElementById('showTanggalLahir').value = data
                            .tanggal_lahir;
                        document.getElementById('showJenisKelamin').value = data
                            .jenis_kelamin;
                        document.getElementById('showAlamat').value = data.alamat ||
                            ''; // nilai null menjadi string kosong
                        document.getElementById('showTelepon').value = data.telepon ||
                            ''; // nilai null menjadi string kosong
                    })
                    .catch(error => {
                        console.error('There was an error fetching the data:', error);
                        alert('Terjadi kesalahan saat mengambil data guru.');
                    });
            });
        });
    });
</script>
