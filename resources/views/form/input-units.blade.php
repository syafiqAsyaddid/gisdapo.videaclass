<div class="modal fade bd-example-modal-l form" id="modalInput" tabindex="-1" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Input Parameter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{route('parametersekolah')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-25">
                                <label for="nama_sub">Parameter</label>
{{--                                parameter--}}
                                <input type="hidden" value="{{$id}}" name="id">

                            </div>
                            <div class="col-75">
                                <select name="nama_sub" id="nama_sub">
                                    <option value="0">Pilih Parameter</option>
                                    @foreach($parameter as $subkategori)
                                        <option value="{{$subkategori->id}}">{{$subkategori->parameter}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if ($errors->input->has('parameter'))
                            <div class="invalid">{{ $errors->input->first('parameter') }}</div>
                        @endif
                        <div class="row">
                            <div class="col-25">
                                <label for="nama_sub">Nilai</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="nilai" value="{{ old('nilai') }}">
                            </div>
                        </div>
                        @if ($errors->input->has('nilai'))
                            <div class="invalid">{{ $errors->input->first('nilai') }}</div>
                        @endif
                        <div class="row">
                            <input type="submit" name="submit" value="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
