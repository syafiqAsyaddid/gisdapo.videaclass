<div class="modal fade bd-example-modal-l form2" id="modalInput" tabindex="-1" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Tambah Parameter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="{{route('parameters')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-25">
                            <label for="parameter">Parameter</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="parameter" value="{{ old('parameter') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('parameter'))
                        <div class="invalid">{{ $errors->input->first('parameter') }}</div>
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
                        <th scope="col">Parameter</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($parameter as $subkategori)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$subkategori->parameter}}</td>
                            <td>
                                <a href="{{route('deleteparameters',$subkategori->id)}}" class="btn btn-danger">Hapus</a>
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
