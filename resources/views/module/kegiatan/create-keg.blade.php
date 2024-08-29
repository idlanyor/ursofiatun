<div class="col-md-12">
    <div class="card mb-5">
        <div class="card-header">
            Tambah Kegiatan
        </div>
        <form action="">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input
                                type="text"
                                class="form-control"
                                id="floatingInput"
                            >
                            <label for="floatingInput">Nama Kegiatan</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input
                                type="password"
                                class="form-control"
                                id="floatingPassword"
                            >
                            <label for="floatingPassword">Penanggung jawab</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input
                                type="email"
                                class="form-control"
                                id="floatingInput"
                                placeholder="name@example.com"
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
        </form>

    </div>

</div>
