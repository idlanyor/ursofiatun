@extends('template.scaffold')
@section('title', 'Data Santri')
@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card">
                <form
                    id="santriForm"
                    action="{{ route('santri.store') }}"
                    method="post"
                >
                    @csrf
                    <div class="card-header">Tambah Data Santri</div>
                    <div class="card-body">

                        <div class="form-floating mb-3">
                            <input
                                type="text"
                                class="form-control"
                                name="nama"
                                id="nama"
                                placeholder="Nama Santri"
                            >
                            <label for="nama">Nama Santri</label>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="tempat_lahir"
                                        id="tempat_lahir"
                                        placeholder="Tempat Lahir"
                                    >
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                        type="date"
                                        class="form-control"
                                        name="tanggal_lahir"
                                        id="tanggal_lahir"
                                        placeholder="Tanggal Lahir"
                                    >
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <select
                                class="form-control"
                                name="jenis_kelamin"
                                id="jenis_kelamin"
                            >
                                <option
                                    value=""
                                    disabled
                                    selected
                                >Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="orang_tua"
                                        id="orang_tua"
                                        placeholder="Orang Tua"
                                    >
                                    <label for="orang_tua">Orang Tua</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="telepon"
                                        id="telepon"
                                        placeholder="Telepon"
                                    >
                                    <label for="telepon">Telepon</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating">
                            <textarea
                                name="alamat"
                                id="alamat"
                                cols="30"
                                rows="10"
                                class="form-control"
                            ></textarea>
                            <label for="alamat">Alamat</label>
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>
                    <div class="card-footer text-muted d-flex justify-content-end mt-3">
                        <button
                            type="submit"
                            class="btn btn-success btn-icon-split"
                        >
                            <span class="icon text-white-50">
                                <i
                                    class="fa fa-save"
                                    aria-hidden="true"
                                ></i>
                            </span>
                            <span class="text">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#santriForm').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        // Handle success
                        alert('Data berhasil disimpan');
                        form[0].reset();
                    },
                    error: function(xhr) {
                        // Handle error
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            form.find('.is-invalid').removeClass('is-invalid');
                            form.find('.invalid-feedback').text('');
                            $.each(errors, function(key, value) {
                                var input = form.find('[name="' + key + '"]');
                                input.addClass('is-invalid');
                                input.next('.invalid-feedback').text(value[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>

@endsection
