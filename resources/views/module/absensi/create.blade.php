@extends('template.scaffold')
@section('title', 'Tambah Data Absensi')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Tambah Data Absensi</h5>
            </div>
            <div class="card-body">
                <form
                    id="absensiForm"
                    action="{{ route('absensi.store') }}"
                    method="POST"
                >
                    @csrf
                    <div class="form-floating mb-3">
                        <input
                            type="date"
                            class="form-control form-control-sm"
                            name="tanggal"
                            id="tanggal"
                            placeholder="Tanggal"
                            required
                        >
                        <label for="tanggal">Tanggal</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select
                            class="form-control form-control-sm"
                            name="jenis_absensi"
                            id="jenis_absensi"
                            required
                        >
                            <option
                                value=""
                                disabled
                                selected
                            >Pilih Jenis Absensi</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Izin">Izin</option>
                            <option value="Alfa">Alfa</option>
                        </select>
                        <label for="jenis_absensi">Jenis Absensi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea
                            class="form-control form-control-sm"
                            name="keterangan"
                            id="keterangan"
                            placeholder="Keterangan"
                        ></textarea>
                        <label for="keterangan">Keterangan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select
                            class="form-control form-control-sm"
                            name="santri_id"
                            id="santri_id"
                            required
                        >
                            <option
                                value=""
                                disabled
                                selected
                            >Pilih Santri</option>
                            @foreach ($dataSantri as $santri)
                                <option value="{{ $santri->id_santri }}">{{ $santri->nama }}</option>
                            @endforeach
                        </select>
                        <label for="santri_id">Santri</label>
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-end mt-3">
                        <button
                            type="submit"
                            class="btn btn-sm btn-success btn-icon-split"
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
            $('#absensiForm').on('submit', function(event) {
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
