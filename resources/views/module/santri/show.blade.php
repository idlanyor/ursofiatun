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
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" disabled name="nama" id="showNama"
                            placeholder="Nama Santri">
                        <label for="showNama">Nama Santri</label>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" disabled name="orang_tua" id="showOrangTua"
                                    placeholder="Orang Tua">
                                <label for="showOrangTua">Orang Tua</label>
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
                    <div class="form-floating mb-3">
                        <textarea name="alamat" id="showAlamat" cols="30" rows="10" class="form-control" disabled></textarea>
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
                        document.getElementById('showNama').value = data.nama;
                        document.getElementById('showTempatLahir').value = data
                            .tempat_lahir;
                        document.getElementById('showTanggalLahir').value = data
                            .tanggal_lahir;
                        document.getElementById('showOrangTua').value = data.orang_tua;
                        document.getElementById('showTelepon').value = data.telepon ||
                            ''; // nilai null menjadi string kosong
                        document.getElementById('showAlamat').value = data.alamat ||
                            ''; // nilai null menjadi string kosong
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
