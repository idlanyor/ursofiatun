<!-- Modal show -->
<div class="modal fade" id="showSarprasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="showLabel">Detail Sarpras</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="showForm">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nama_barang" id="showNamaBarang" placeholder="Nama Barang" readonly>
                        <label for="showNamaBarang">Nama Barang</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="tanggal_pengadaan" id="showTanggalPengadaan" placeholder="Tanggal Pengadaan" readonly>
                        <label for="showTanggalPengadaan">Tanggal Pengadaan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-control" name="kondisi" id="showKondisi" disabled>
                            <option value="" disabled>Pilih Kondisi</option>
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                        </select>
                        <label for="showKondisi">Kondisi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="jumlah" id="showJumlah" placeholder="Jumlah" readonly>
                        <label for="showJumlah">Jumlah</label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var showSarprasModal = new bootstrap.Modal(document.getElementById('showSarprasModal'));

        document.querySelectorAll('.show-btn').forEach(button => {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                axios.get(`/sarpras/${id}/show`)
                    .then(response => {
                        var data = response.data;
                        document.getElementById('showNamaBarang').value = data.nama_barang || 'Tidak ada/Belum ada';
                        document.getElementById('showTanggalPengadaan').value = data.tanggal_pengadaan || 'Tidak ada/Belum ada';
                        document.getElementById('showKondisi').value = data.kondisi || 'Tidak ada/Belum ada';
                        document.getElementById('showJumlah').value = data.jumlah || 'Tidak ada/Belum ada';
                        showSarprasModal.show();
                    })
                    .catch(error => {
                        console.error('There was an error fetching the data:', error);
                        alert('Terjadi kesalahan saat mengambil data sarpras.');
                    });
            });
        });
    });
</script>
