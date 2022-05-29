@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse ($article as $item)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('storage/'.$item->image) }}" style="height: 200px; width:auto;object-fit: contain" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div>
            @empty
                
            @endforelse
        </div>
    </div>
</div>
@endsection
