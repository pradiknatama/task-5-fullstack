@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-body">
                        <h1 class="mb-3">{{$article->title}}</h1>
                <p class="card-text"><small class="text-muted"> by {{ $article->user->name }} {{ $article->created_at->diffForHumans() }}</small></p>
                <div class="text-center">
                    <img src="{{ asset('storage/'.$article->image)}}" class="img-fluid" alt="">
                </div>
                <article class="my-3 fs-3" style="text-align: justify">{{ $article->content }}</article>
                <a href="/home" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection