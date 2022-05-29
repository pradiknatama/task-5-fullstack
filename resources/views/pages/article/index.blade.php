@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="card p-3">
            <a href="/article/create" class="btn btn-primary col-12 col-md-3 col-lg-2 mt-2 mb-2">Buat Article</a>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 1%">No</th>
                            <th scope="col">Gambar</th>
                            <th scope="col" style="width: 25%">Judul</th>
                            <th scope="col" style="width: 10%">Nama Kategori</th>
                            <th scope="col" style="width: 30%">Konten</th>
                            <th scope="col" style="width: 15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($article as $key=>$item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><img src="{{ asset('storage/'.$item->image) }} " width="200px" alt=""></td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->kategori->name }}</td>
                            <td>{{ Str::limit($item->content, 60   , '...') }}</td>
                            <td>
                                <form action="/article/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('delete')
                                    <a href="/article/{{ $item->id }}/detail" class="btn btn-warning">Edit</a>
                                    <button type="submit" class="btn btn-danger delete-confirm "
                                        data-name="{{ $item->title }}">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
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
                    title: `Apakah anda akan menghapus article ${name}?`,
                    text: "Anda tidak akan bisa mengembalikan article ini!",
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