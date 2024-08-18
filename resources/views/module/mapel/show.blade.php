<!-- Modal show -->
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="showLabel">Detail Mata Pelajaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="showForm">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" disabled name="kode_mapel" id="showKodeMapel"
                            placeholder="Kode Mata Pelajaran">
                        <label for="showKodeMapel">Kode Mata Pelajaran</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" disabled name="nama_mapel" id="showNamaMapel"
                            placeholder="Nama Mata Pelajaran">
                        <label for="showNamaMapel">Nama Mata Pelajaran</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select disabled class="form-control" name="guru_id" id="showGuruId" required>
                            <option value="" disabled>Pilih Guru</option>
                            @foreach($guru as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                            @endforeach
                        </select>
                        <label for="showGuruId">Guru</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select disabled class="form-control" name="kelas_id" id="showKelasId" required>
                            <option value="" disabled>Pilih Kelas</option>
                            @foreach($kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                            @endforeach
                        </select>
                        <label for="showKelasId">Kelas</label>
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
                axios.get(`/matapelajaran/${id}/edit`)
                    .then(response => {
                        var data = response.data;
                        document.getElementById('showKodeMapel').value = data.kode_mapel;
                        document.getElementById('showNamaMapel').value = data.nama_mapel;
                        document.getElementById('showGuruId').value = data.guru_id;
                        document.getElementById('showKelasId').value = data.kelas_id;
                        showModal.show();
                    })
                    .catch(error => {
                        console.error('There was an error fetching the data:', error);
                        alert('Terjadi kesalahan saat mengambil data mata pelajaran.');
                    });
            });
        });
    });
</script>
