@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Aduh,requestnya kebanyakan.Coba lagi nanti ya'))
