@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card ">
            <div class="card-header text-center">Arcticle Baru</div>
            <div class="card-body">
                <form action="/article/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class=" row mb-3">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="judul">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="kategori" aria-label="Default select example" required> 
                                @forelse ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option> 
                                @empty
                                    <option disabled>Mohon buat kategori terlebih dahulu</option>
                                @endforelse
                              </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="gambar" id="inputGroupFile01">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Konten</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="konten" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end pt-2"><a href="/article"
                            class="btn btn-warning mx-2 ">Kembali</a><button class="btn btn-primary"
                            type="submit">Simpan</button></div>

                </form>
            </div>
        </div>
    </div>
@endsection
