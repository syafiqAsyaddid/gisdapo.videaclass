<x-layout-form>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Input Kategori</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="ruangan/create" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-25">
                            <label for="ruangan">Kategori</label>
                            <a href="{{route('addunit')}}" type="button" style="float:right;" class="btn btn-primary" >
                                Tambah Kategori
                                </a>
                        </div>
                        <div class="col-75">
{{--                            <input type="text" name="ruangan" value="{{ old('ruangan') }}">--}}
                            <select name="ruangan" id="ruangan" >
                                <option value="">Pilih</option>
                                @foreach($units as $unit)
                                    <option value="{{$unit->nama_units}}">{{$unit->nama_units}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    @if ($errors->input->has('ruangan'))
                        <div class="invalid">{{ $errors->input->first('ruangan') }}</div>
                    @endif
                    <div class="row">
                        <input type="submit" name="submit" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-form>
