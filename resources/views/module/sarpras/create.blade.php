@extends('template.scaffold')
@section('title', 'Tambah Data Sarpras')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Tambah Sarana dan Prasarana</h5>
            </div>
            <form id="sarprasForm" action="{{ route('sarpras.store') }}" method="POST">
                <div class="card-body">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang"
                            placeholder="Nama Barang" required>
                        <label for="nama_barang">Nama Barang</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="date" class="form-control" name="tanggal_pengadaan" id="tanggal_pengadaan"
                            placeholder="Tanggal Pengadaan" required>
                        <label for="tanggal_pengadaan">Tanggal Pengadaan</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <select class="form-control" name="kondisi" id="kondisi" required>
                                    <option value="" disabled selected>Kondisi Barang</option>
                                    <option value="baik">Baik</option>
                                    <option value="rusak">Rusak</option>
                                </select>
                                <label for="kondisi">Kondisi Barang</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" name="jumlah" id="jumlah"
                                    placeholder="Jumlah">
                                <label for="jumlah">Jumlah</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 card-footer text-muted d-flex justify-content-end">
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
            $('#sarprasForm').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        // Handle success
                        // alert('Data berhasil disimpan');
                        toastr.success('Data sarpras berhasil disimpan')
                        form[0].reset();
                        window.location.href = "{{ route('sarpras.index') }}";
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
