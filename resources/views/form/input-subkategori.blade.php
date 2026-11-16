<div class="modal fade bd-example-modal-l form1" id="modalInput" tabindex="-1" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Tambah Sub Kategori</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="{{route('subkategori')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-25">
                            <label for="nama_sub">Sub Kategori</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nama_sub" value="{{ old('nama_sub') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('nama_sub'))
                        <div class="invalid">{{ $errors->input->first('nama_sub') }}</div>
                    @endif
                    <div class="row">
                        <input type="submit" name="submit" value="Simpan">
                    </div>
                </form>
            </div>
            <div class="container">
{{--                table--}}
                <table class="table2 table-striped">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Sub Kategori</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sub as $subkategori)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$subkategori->nama_sub}}</td>
                            <td>
                                <a href="{{route('deletesubkategori',$subkategori->id)}}" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>
