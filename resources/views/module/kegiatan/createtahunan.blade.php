<div class="modal fade" id="createkegiatanT" tabindex="-1" aria-labelledby="createkegiatanTLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createkegiatanTLabel">Tambah Kegiatan</h5>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="namaKegiatanT" class="form-label">Nama Kegiatan</label>
                                <input type="text" class="form-control" id="namaKegiatanT"
                                    placeholder="Masukkan Nama Kegiatan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="penanggungJawabT" class="form-label">Penanggung Jawab</label>
                                <input type="text" class="form-control" id="penanggungJawabT"
                                    placeholder="Masukkan Penanggung Jawab" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lamaKegiatanT" class="form-label">Lama Kegiatan (Hari)</label>
                                <input type="number" class="form-control" id="lamaKegiatanT"
                                    placeholder="Masukkan Lama Kegiatan" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tahunAjaranT" class="form-label">Tahun Ajaran</label>
                                <input type="text" class="form-control" id="tahunAjaranT"
                                    placeholder="Masukkan Tahun Ajaran" required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tglMulai" class="form-label">Tanggal Pelaksanaan</label>
                                <input type="date" class="form-control" id="tglMulai" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tglSelesai" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="tglSelesai" disabled>
                            </div>
                        </div>
                        <input type="hidden" name="periode" value="Tahunan">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
