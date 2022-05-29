@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="card ">
            <div class="card-header text-center">Edit Article</div>
            <div class="card-body">
                <form action="/article/{{ $article->id }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="judul" value="{{ old('judul',$article->title) }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="kategori" aria-label="Default select example" required> 
                                @foreach ($categories as $item)
                                    @if (old('kategori',$article->category_id)==$item->id)
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option> 
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option> 
                                    @endif
                                    
                                @endforeach
            
                              </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"> Gambar Lama</label>
                        <div class="col-sm-10">
                            <img src="{{ asset('storage/'.$article->image) }} " width="200px" alt="">
                            <input type="hidden" name="oldImage" value="{{ $article->image }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Gambar baru</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="gambar" id="inputGroupFile01">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Konten</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="konten" id="exampleFormControlTextarea1" rows="3" >{{ old('konten',$article->content) }}</textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end pt-2"><a href="/article" class="btn btn-warning mx-2 " >Kembali</a><button class="btn btn-primary" type="submit">Simpan</button></div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection