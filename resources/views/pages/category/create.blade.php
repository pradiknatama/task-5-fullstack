@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="card ">
            <div class="card-header text-center">Kategori Baru</div>
            <div class="card-body">
                <div class=" row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="category" >
                    </div>
                </div>
                <div class="d-flex justify-content-end pt-2"><a href="/category" class="btn btn-warning mx-2 " >Kembali</a><button class="btn btn-primary" type="submit">Simpan</button></div>
                
            </div>
        </div>
    </div>
@endsection