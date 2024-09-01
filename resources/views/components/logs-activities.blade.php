@extends('template.scaffold')
@section('title', 'Log Aktivitas')
@section('content')
    <div class="card">
        <div class="card-header">
            Log Aktivitas
        </div>
        <div class="card-body overflow-auto" style="max-height: 500px;">
            <div class="row">
                <div class="col-lg-12">

                    @foreach ($logs as $log)
                        <div class="media card text-dark p-3 mb-3 rounded">
                            <img
                                class="mr-3 rounded-circle"
                                src="{{ asset('img/undraw_profile.svg') }}"
                                alt="User Avatar"
                                style="width: 40px;"
                            >
                            <div class="media-body ">
                                <h5 class="mt-0">{{ $log->user->nama }} — <small
                                        class="text-primary">{{ $log->route }}</small></h5>
                                <p>{{ $log->action }}</p>
                                <small class="text-primary">{{ $log->ip_address }} |
                                    {{ $log->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
