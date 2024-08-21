@extends('template.scaffold')
@section('title', 'Tambah Data Tahun Ajaran')
@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card">
                <form
                    id="tahunAjaranForm"
                    action="{{ route('tahunajaran.store') }}"
                    method="post"
                >
                    @csrf
                    <div class="card-header">Tambah Data Tahun Ajaran</div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="tahun_mulai"
                                        id="tahun_mulai"
                                        placeholder="Tahun Mulai"
                                    >
                                    <label for="tahun_mulai">Tahun Mulai</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="tahun_akhir"
                                    id="tahun_akhir"
                                    placeholder="Tahun Akhir"
                                >
                                <label for="tahun_akhir">Tahun Akhir</label>
                                <div class="invalid-feedback"></div>
                            </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <select
                                class="form-select"
                                name="status"
                                id="status"
                            >
                                <option value="">Pilih Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
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
            $('#tahunAjaranForm').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        // Handle success
                        toastr.success('Data berhasil disimpan');
                        form[0].reset();
                        window.location.href = "{{ route('tahunajaran.index') }}";
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