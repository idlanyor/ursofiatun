@extends('template.scaffold')
@section('title', 'Data Absensi')
@section('style')
    <style>
        .table td,
        .table th {
            white-space: nowrap;
        }
    </style>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Data Absensi per Kelas</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataAbsensiTable" class="table align-middle table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kelas</th>
                                <th>Jumlah Siswa</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">

                            @if ($kelas->count())
                                @foreach ($kelas as $index => $d)
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm show-btn"
                                                data-bs-toggle="modal" data-bs-target="#showModal"
                                                data-id="{{ $d->id }}">
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $d->id }}">
                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                        <td>{{ $d->nama_kelas }}</td>
                                        <td>{{ $jumlahSantriPerKelas[$d->id_kelas] ?? 0 }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Tidak Ada Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // inisialisasi datatable versi 2.1.4
            $('#dataAbsensiTable').DataTable({
                dom: 'ftp',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.5/i18n/id.json"
                }
            });

            // $('#dataAbsensiTable').DataTable({
            //     dom: 'Bfrtip',
            //     buttons: [
            //         'copy', 'csv', 'excel', 'pdf', 'print'
            //     ],
            //     "language": {
            //         "url": "https://cdn.datatables.net/plug-ins/1.13.5/i18n/id.json"
            //     }
            // });
        })
    </script>
    @include('module.absensi.edit')
    @include('module.absensi.destroy')
    @include('module.absensi.show')
@endsection
