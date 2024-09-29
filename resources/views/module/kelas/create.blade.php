@extends('template.scaffold')
@section('title', 'Tambah Data Kelas')
@section('content')

    <div class="col-md-12">
        <div class="card">
            <form id="kelasForm" action="{{ route('kelas.store') }}" method="post">
                @csrf
                <div class="card-header">Tambah Data Kelas</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="nama_kelas" id="nama_kelas"
                                    placeholder="Nama Kelas" required>
                                <label for="nama_kelas">Nama Kelas</label>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="id_tahun_ajaran" id="id_tahun_ajaran" required>
                                    <option value="" disabled selected>Pilih Tahun Ajaran</option>
                                    @foreach ($tahunAjaran as $tahun)
                                        <option value="{{ $tahun->id_tahun_ajaran }}">{{ $tahun->tahun_mulai }} -
                                            {{ $tahun->tahun_akhir }}</option>
                                    @endforeach
                                </select>
                                <label for="id_tahun_ajaran">Tahun Ajaran</label>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa fa-save" aria-hidden="true"></i>
                        </span>
                        <span class="text">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#kelasForm').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);
                axios({
                        method: form.attr('method'),
                        url: form.attr('action'),
                        data: form.serialize(),
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    })
                    .then(function(response) {
                        // Handle success
                        console.log(response.data);
                        toastr.success('Data berhasil disimpan');
                        form[0].reset();
                        window.location.href = "{{ route('kelas.index') }}";
                    })
                    .catch(function(error) {
                        // Handle error
                        if (error.response.status === 422) {
                            var errors = error.response.data.errors;
                            form.find('.is-invalid').removeClass('is-invalid');
                            form.find('.invalid-feedback').text('');
                            $.each(errors, function(key, value) {
                                var input = form.find('[name="' + key + '"]');
                                input.addClass('is-invalid');
                                input.next('.invalid-feedback').text(value[0]);
                            });
                        }
                    });
            });
        });
    </script>

@endsection
