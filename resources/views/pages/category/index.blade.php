@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card p-3">
            <a href="/category/create" class="btn btn-primary col-12 col-md-3 col-lg-2 mt-2 mb-2">Tambah Kategori</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($category as $key=>$item)
                        <tr>
                            <th scope="row">{{ $key + 1 }} </th>
                            <td>{{ $item->name }}</td>
                            <td>
                                <form action="/category/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('delete')
                                    <a href="/category/{{ $item->id }}/detail" class="btn btn-info">Edit</a>
                                    <button type="submit" class="btn btn-danger delete-confirm "
                                        data-name="{{ $item->name }}">Hapus</button>
                                </form>
                            </td>
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
@push('sctipts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.delete-confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Apakah anda akan menghapus kategori ${name}?`,
                    text: "Anda tidak akan bisa mengembalikan kategori ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result) {
                        form.submit();
                    }
                });
        });
    </script>
@endpush
