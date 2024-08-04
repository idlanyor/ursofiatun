@extends('template.scaffold')
@section('title', 'Data Santri')
@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card">
                <div class="card-header">Tambah Data Santri</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nama" id="nama"
                                placeholder="name@example.com">
                            <label for="nama">Nama Santri</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        placeholder="name@example.com">
                                    <label for="floatingInput">Tempat Lahir</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control p-3" id="floatingInput"
                                        placeholder="name@example.com">
                                    <label for="floatingInput">Tanggal Lahir</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput"
                                        placeholder="name@example.com">
                                    <label for="floatingInput">Orang Tua</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control p-3" id="floatingInput"
                                        placeholder="name@example.com">
                                    <label for="floatingInput">Telepon</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating">
                            <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control" ></textarea>
                            <label for="alamat">Alamat</label>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-muted d-flex justify-content-end">
                    <button type="submit" href="#" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa fa-save" aria-hidden="true"></i>
                        </span>
                        <span class="text">Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
