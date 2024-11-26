@extends('template.scaffold')
@section('title', 'Data Mata Pelajaran')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Data Mata Pelajaran</h5>
                </div>
                <div class="card-body">
                    <form id="mapelForm" action="{{ route('matapelajaran.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" name="kode_mapel" id="kode_mapel"
                                placeholder="Kode Mata Pelajaran">
                            <label for="kode_mapel">Kode Mata Pelajaran</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" name="nama_mapel" id="nama_mapel"
                                placeholder="Nama Mata Pelajaran">
                            <label for="nama_mapel">Nama Mata Pelajaran</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <select class="form-control" name="guru_id" id="guru_id">
                                <option value="" disabled selected>Pilih Guru</option>
                                @foreach ($guru as $guru)
                                    <option value="{{ $guru->id_guru }}">{{ $guru->nama }}</option>
                                @endforeach
                            </select>
                            <label for="guru_id">Guru</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <select class="form-control" name="kelas_id" id="kelas_id">
                                <option value="" disabled selected>Pilih Kelas</option>
                                @foreach ($kelas as $kelas)
                                    <option value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                            <label for="kelas_id">Kelas</label>
                        </div>
                        <div class="mt-3 card-footer text-muted d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fa fa-save" aria-hidden="true"></i>
                                </span>
                                <span class="text">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#mapelForm').on('submit', function(event) {
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
                        window.location.href = "{{ route('matapelajaran.index') }}";
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
@endpush
