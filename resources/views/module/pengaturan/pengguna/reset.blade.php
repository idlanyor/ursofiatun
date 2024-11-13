<!-- Modal show -->
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="showLabel">Detail Tahun Ajaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="showForm">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" disabled name="tahun_mulai" id="showTahunMulai"
                            placeholder="Tahun Mulai">
                        <label for="showTahunMulai">Tahun Mulai</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" disabled name="tahun_akhir" id="showTahunAkhir"
                            placeholder="Tahun Akhir">
                        <label for="showTahunAkhir">Tahun Akhir</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" disabled name="status" id="showStatus"
                            placeholder="Status">
                        <label for="showStatus">Status</label>
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
                axios.get(`/tahunajaran/${id}/edit`)
                    .then(response => {
                        var data = response.data;
                        document.getElementById('showTahunMulai').value = data.tahun_mulai;
                        document.getElementById('showTahunAkhir').value = data.tahun_akhir;
                        document.getElementById('showStatus').value = data.status;
                        showForm.setAttribute('action', `/tahunajaran/${id}`);
                    })
                    .catch(error => {
                        console.error('There was an error fetching the data:', error);
                        alert('Terjadi kesalahan saat mengambil data tahun ajaran.');
                    });
            });
        });
    });
</script>