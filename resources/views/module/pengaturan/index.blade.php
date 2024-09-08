@extends('template.scaffold')
@section('title', 'Pengaturan Sistem')
@section('content')
    <div class="row">
        <div class="col-md-6">
            @include('module.pengaturan.tahunajaran.create')
        </div>
        <div class="col-md-6">
            @include('module.pengaturan.tahunajaran.index')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('module.pengaturan.pengguna.index')
        </div>
    </div>
@endsection
