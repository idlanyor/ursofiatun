<!-- Modal show -->
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="showLabel">Detail Nilai</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="showForm">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="ulangan_1" id="showUlangan1" placeholder="Ulangan 1" readonly>
                        <label for="showUlangan1">Ulangan 1</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="ulangan_2" id="showUlangan2" placeholder="Ulangan 2" readonly>
                        <label for="showUlangan2">Ulangan 2</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="ulangan_3" id="showUlangan3" placeholder="Ulangan 3" readonly>
                        <label for="showUlangan3">Ulangan 3</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-control" name="mapel_id" id="showMapel" disabled>
                            <option value="" disabled>Pilih Mata Pelajaran</option>
                            @foreach($mapel as $mapel)
                                <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                            @endforeach
                        </select>
                        <label for="showMapel">Mata Pelajaran</label>
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
                axios.get(`/nilai/${id}/edit`)
                    .then(response => {
                        var data = response.data;
                        document.getElementById('showUlangan1').value = data.ulangan_1 || 'Tidak ada/Belum ada';
                        document.getElementById('showUlangan2').value = data.ulangan_2 || 'Tidak ada/Belum ada';
                        document.getElementById('showUlangan3').value = data.ulangan_3 || 'Tidak ada/Belum ada';
                        document.getElementById('showMapel').value = data.mapel_id || 'Tidak ada/Belum ada';
                        showForm.setAttribute('action', `/nilai/${id}`);
                    })
                    .catch(error => {
                        console.error('There was an error fetching the data:', error);
                        alert('Terjadi kesalahan saat mengambil data nilai.');
                    });
            });
        });
    });
</script>
