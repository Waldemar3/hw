@extends('layout')

@section('content')
    <div class="card" style="margin-bottom: 15px">
        <div class="card-body">
            <h5 class="card-title"><a href="#">{{ $ad->title }}</a></h5>
            <p class="card-text">{{ $ad->description }}</p>

            @can('update', $ad)
                <a href="#" class="btn btn-primary">Edit</a>
            @endcan
            @can('delete', $ad)
                <a href="/delete/{{ $ad->id }}" class="btn btn-primary">Delete</a>
            @endcan
        </div>
        <div class="card-footer text-muted">
            {{ $ad->created_at->diffForHumans() }} by {{ $ad->user->username }}
        </div>
    </div>
@endsection
