<div class="col-md-12">
    <div class="mb-5 card">
        <form method="POST" action="{{ route('kegiatan.create') }}">
            <div class="card-header">
                Tambah Kegiatan
            </div>
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" id="floatingInputnamaKegiatan">
                            <label for="floatingInput">Nama Kegiatan</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="penanggungJawabC">
                            <label for="penanggungJawabC">Penanggung jawab</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 form-floating">
                            <input type="email" class="form-control" id="floatingInput"
                                placeholder="name@example.com">
                            <label for="floatingInput">Tanggal Pelaksanaan</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input list="floatingSelect" class="form-control" id="floatingInput">
                            <label for="floatingInput">Periode</label>
                            <datalist id="floatingSelect">
                                <option value="Tahunan">Tahunan</option>
                                <option value="Bulanan">Bulanan</option>
                                <option value="Mingguan">Mingguan</option>
                            </datalist>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="float-right btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

</div>
