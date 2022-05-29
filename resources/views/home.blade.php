@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Semua article</h1>
    <div class="row justify-content-center">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse ($article as $item)
                <div class="col">
                    <div class="card h-100">
                        <div class="position-absolute  px-3 py-2 text-white" style="background-color: rgba(0, 0, 0, 0.7)">{{ $item->kategori->name }}</div>
                        <img src="{{ asset('storage/'.$item->image) }}" style="height: 200px; width:auto;object-fit: contain" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text"><small class="text-muted"> by {{ $item->user->name }} {{ $item->created_at->diffForHumans() }}</small></p>
                            <p class="card-text">{{ Str::limit($item->content, 60   , '...') }}</p>
                            <a href="/detail/{{ $item->id }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                
            @endforelse
        </div>
    </div>
</div>
@endsection
