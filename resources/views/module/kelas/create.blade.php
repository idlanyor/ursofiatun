@extends('template.scaffold')
@section('title', 'Data Kelas')
@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card">
                <div class="card-header">Tambah Data Kelas</div>
                <div class="card-body">
                    <form action="{{ route('kelas.store') }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" placeholder="Nama Kelas" required>
                            <label for="nama_kelas">Nama Kelas</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-control" name="id_tahun_ajaran" id="id_tahun_ajaran" required>
                                <option value="" disabled selected>Pilih Tahun Ajaran</option>
                                @foreach ($tahunAjaran as $tahun)
                                    <option value="{{ $tahun->id }}">{{ $tahun->tahun_mulai }} - {{ $tahun->tahun_akhir }}</option>
                                @endforeach
                            </select>
                            <label for="id_tahun_ajaran">Tahun Ajaran</label>
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
        </div>
    </div>

@endsection
