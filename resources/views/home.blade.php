@extends('layout')

@section('title', 'Ads home')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    @error('not_allowed')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror

    @forelse($ads as $ad)
    <div class="card" style="margin-bottom: 15px">
        <div class="card-body">
            <h5 class="card-title"><a href="/showAd/{{ $ad->id }}">{{ $ad->title }}</a></h5>
            <p class="card-text">{{ $ad->description }}</p>

            @can('update', $ad)
                <a href="{{ route('ad.create', ['id' => $ad->id]) }}" class="btn btn-primary">Edit</a>
            @endcan
            @can('delete', $ad)
                <a href="/delete/{{ $ad->id }}" class="btn btn-primary">Delete</a>
            @endcan
        </div>
        <div class="card-footer text-muted">
            {{ $ad->created_at->diffForHumans() }} by {{ $ad->user->username }}
        </div>
    </div>
    @empty
        <p>No ads</p>
    @endforelse

    <div class="row">
        <div class="col">
            @if($ads->currentPage() !== 1)
                <a href="{{ $ads->previousPageUrl() }}" class="btn btn-primary">Prev Page</a>
            @endif
        </div>
        <div class="col text-right">
            @if($ads->currentPage() !== $ads->lastPage())
                <a href="{{ $ads->nextPageUrl() }}" class="btn btn-primary">Next Page</a>
            @endif
        </div>
    </div>

@endsection
