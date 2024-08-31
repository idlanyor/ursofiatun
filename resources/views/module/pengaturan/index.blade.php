@extends('template.scaffold')
@section('title', 'Pengaturan Sistem')
@section('content')
    <div class="col-md-12">
        @include('module.pengaturan.tahunajaran.create')
    </div>
    <div class="col-md-12">
        @include('module.pengaturan.tahunajaran.index')
    </div>
@endsection
