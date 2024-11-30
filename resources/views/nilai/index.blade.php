@extends('template.scaffold')

@section('title', 'Daftar Nilai Santri')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Nilai Santri</h6>
        <a href="{{ route('nilai.create') }}" class="btn btn-sm btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Nilai
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Santri</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Ulangan 1</th>
                        <th>Ulangan 2</th>
                        <th>Ulangan 3</th>
                        <th>Rata-rata</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nilai as $key => $n)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $n->santri->nama }}</td>
                        <td>{{ $n->kelas->nama_kelas }}</td>
                        <td>{{ $n->mapel->nama_mata_pelajaran }}</td>
                        <td>{{ $n->ulangan_1 }}</td>
                        <td>{{ $n->ulangan_2 }}</td>
                        <td>{{ $n->ulangan_3 }}</td>
                        <td>
                            @php
                                $nilai_ada = 0;
                                $total = 0;
                                if($n->ulangan_1) { $total += $n->ulangan_1; $nilai_ada++; }
                                if($n->ulangan_2) { $total += $n->ulangan_2; $nilai_ada++; }
                                if($n->ulangan_3) { $total += $n->ulangan_3; $nilai_ada++; }
                                echo $nilai_ada > 0 ? number_format($total/$nilai_ada, 2) : '-';
                            @endphp
                        </td>
                        <td>
                            <a href="{{ route('nilai.edit', $n->id_nilai) }}" class="btn btn-sm btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('nilai.destroy', $n->id_nilai) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
