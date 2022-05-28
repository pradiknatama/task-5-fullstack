@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card p-3">
            <div class="col-3">
                <a href="/category/create" class="btn btn-primary mt-2 mb-2">Tambah Kategori</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($category as $item)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="" class="btn btn-info">Edit</a>
                                <a href="" class="btn btn-danger">Hapus</a></td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">DATA MASIH KOSONG</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
