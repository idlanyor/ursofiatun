@extends('template.scaffold')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>Pilih Kelas untuk Absensi</h5>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($kelasList as $kelas)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $kelas->nama_kelas }}</h5>
                            <p class="card-text">Jumlah Santri: {{ $kelas->santri_count }}</p>
                            <a href="{{ route('absensi.harian', ['id_kelas' => $kelas->id_kelas]) }}"
                               class="btn btn-sm btn-primary">Isi Absensi</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
