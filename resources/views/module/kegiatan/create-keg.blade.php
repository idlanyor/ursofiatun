<div class="col-md-12">
    <div class="mb-5 card">
        <form
            method="POST"
            action="{{ route('kegiatan.store') }}"
        >
            <div class="card-header">
                Tambah Kegiatan
            </div>
            @csrf
            <input type="hidden" name="id_tahun_ajaran" value="{{ $id_tahun_ajaran }}">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 form-floating">
                            <input
                                type="text"
                                class="form-control"
                                id="floatingInputnamaKegiatan"
                                required
                            >
                            <label for="floatingInput">Nama Kegiatan</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input
                                type="text"
                                class="form-control"
                                id="penanggungJawabC"
                                required
                            >
                            <label for="penanggungJawabC">Penanggung jawab</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 form-floating">
                            <input
                                type="text"
                                class="form-control"
                                id="floatingInput"
                                name="tanggal_pelaksanaan"
                                required
                            >
                            <label for="floatingInput">Tanggal Pelaksanaan</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input
                                list="floatingSelect"
                                class="form-control"
                                id="floatingInput"
                                name="periode"
                                required
                            >
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
                <button
                    type="submit"
                    class="float-right btn btn-sm btn-primary"
                >Simpan</button>
            </div>
        </form>
    </div>
</div>
