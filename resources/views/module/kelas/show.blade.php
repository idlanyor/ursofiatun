<!-- Modal Edit -->
<div class="modal fade" id="showModalKelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="showLabel">Detail Kelas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="showForm">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" name="nama_kelas" id="showNamaKelas"
                            placeholder="Nama Kelas">
                        <label for="showNamaKelas">Nama Kelas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select disabled class="form-control" name="id_tahun_ajaran" id="showTahunAjaran" required>
                            <option value="" disabled>Pilih Tahun Ajaran</option>
                            @foreach ($tahunAjaran as $tahun)
                                <option value="{{ $tahun->id }}">{{ $tahun->tahun_mulai }} - {{ $tahun->tahun_akhir }}</option>
                            @endforeach
                        </select>
                        <label for="showTahunAjaran">Tahun Ajaran</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var showForm = document.getElementById('showForm');
        var showModalKelas = new bootstrap.Modal(document.getElementById('showModalKelas'));

        document.querySelectorAll('.show-btn').forEach(button => {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                axios.get(`/kelas/${id}/edit`)
                    .then(response => {
                        var data = response.data;
                        document.getElementById('showNamaKelas').value = data.kelas.nama_kelas;
                        document.getElementById('showTahunAjaran').value = data.kelas.id_tahun_ajaran;
                        showForm.setAttribute('action', `/kelas/${id}`);
                    })
                    .catch(error => {
                        console.error('There was an error fetching the data:', error);
                        toastr.error('Terjadi kesalahan saat mengambil data kelas.');
                    });
            });
        });

    });
</script>
