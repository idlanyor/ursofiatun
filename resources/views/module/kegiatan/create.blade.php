<div class="modal fade" id="createKegiatanModal" tabindex="-1" aria-labelledby="createKegiatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createKegiatanModalLabel">Tambah Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="eventName" class="form-label">Nama Kegiatan</label>
                                <input type="text" class="form-control" id="eventName"
                                    placeholder="Masukkan Nama Kegiatan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="eventPerson" class="form-label">Penanggung Jawab</label>
                                <input type="text" class="form-control" id="eventPerson"
                                    placeholder="Masukkan Penanggung Jawab" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lamaKegiatan" class="form-label">Lama Kegiatan (Hari)</label>
                                <input type="number" class="form-control" id="lamaKegiatan"
                                    placeholder="Masukkan Lama Kegiatan" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="schoolYear" class="form-label">Tahun Ajaran</label>
                                <input type="text" class="form-control" id="schoolYear"
                                    placeholder="Masukkan Tahun Ajaran" required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="eventDate" class="form-label">Tanggal Pelaksanaan</label>
                                <input type="date" class="form-control" id="eventDate" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="eventEndDate" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="eventEndDate" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="eventPeriod" class="form-label">Periode</label>
                                <select class="form-control" id="eventPeriod">
                                    <option value="Mingguan">Mingguan</option>
                                    <option value="Bulanan">Bulanan</option>
                                    <option value="Tahunan">Tahunan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
