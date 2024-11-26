@extends('template.scaffold')
@section('title', 'Tambah Data Guru')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Tambah Data Guru</h5>
            </div>
            <div class="card-body">
                <form id="guruForm" action="{{ route('guru.store') }}" method="POST">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                            id="nama" placeholder="Nama Guru" value="{{ old('nama') }}">
                        <label for="nama">Nama Guru</label>
                        @error('nama')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir"
                                    value="{{ old('tempat_lahir') }}">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                @error('tempat_lahir')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir"
                                    value="{{ old('tanggal_lahir') }}">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                @error('tanggal_lahir')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 form-floating">
                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
                            id="jenis_kelamin">
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        @error('jenis_kelamin')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" id="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
                                <label for="alamat">Alamat</label>
                                @error('alamat')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                    name="telepon" id="telepon" placeholder="Telepon" value="{{ old('telepon') }}">
                                <label for="telepon">Telepon</label>
                                @error('telepon')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
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

    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('guruForm').addEventListener('submit', function(event) {
                event.preventDefault();
                var form = this;
                axios.post(form.getAttribute('action'), new FormData(form))
                    .then(function(response) {
                        // Handle success
                        toastr.success('Data berhasil disimpan');
                        // redirect ke index
                        window.location.href = '/guru/';

                    })
                    .catch(function(error) {
                        // Handle error
                        console.log(error)
                        return;
                        if (error && error.response.status === 422) {
                            var errors = error.response.data.errors;
                            form.querySelectorAll('.is-invalid').forEach(function(element) {
                                element.classList.remove('is-invalid');
                            });
                            form.querySelectorAll('.invalid-feedback').forEach(function(element) {
                                element.textContent = '';
                            });
                            Object.entries(errors).forEach(function([key, value]) {
                                var input = form.querySelector('[name="' + key + '"]');
                                input.classList.add('is-invalid');
                                input.nextElementSibling.textContent = value[0];
                            });
                        }
                    });
            });
        });
    </script>

@endsection
