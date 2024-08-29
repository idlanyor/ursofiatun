@extends('template.scaffold')
@section('title', 'Data Kegiatan')
@section('content')
    @include('module.kegiatan.create-keg')
    @include('module.kegiatan.index')
@endsection
