@extends('template.scaffold')
@section('title', 'Data Santri')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Data Santri</h5>
                <a href="{{ route('santri.create') }}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-user-plus"></i>
                    </span>
                    <span class="text">Tambah Data Santri</span>
                </a>

            </div>
            <div class="card-body">
                <div class="table-responsive-xl">
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 5%;">No</th>
                                <th>Nama</th>
                                <th>Tempat/Tgl Lahir</th>
                                <th>JK</th>
                                <th>Alamat</th>
                                <th>Orang Tua</th>
                                <th>Telepon</th>
                                <th style="width: 150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <tr>
                                <td scope="row">1</td>
                                <td>Jakia Sri Rahmawati</td>
                                <td>Sukabumi,12 Mei 2007</td>
                                <td>Perempuan</td>
                                <td>Sukabumi Kota Gg. 2 No 123</td>
                                <td>Suryaningrat</td>
                                <td>0898987675548</td>
                                <td>
                                    <a class="btn btn-warning btn-sm px-2" href="#" role="button"><i
                                            class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="fas fa-eye"
                                            aria-hidden="true"></i></button>
                                    <button class="btn btn-danger btn-sm px-2" type="button"><i class="fas fa-trash"
                                            aria-hidden="true"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
    @include('module.santri.edit')
@endsection
