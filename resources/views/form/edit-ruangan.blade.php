<x-layout-form-edit>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Ruangan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="ruangan/update" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" id="ruangan-edit-id" value="{{ old('id') }}">
                    <div class="row">
                        <div class="col-25">
                            <label for="ruangan">Ruang</label>
                        </div>
                        <div class="col-75">
                            <select name="ruangan" id="ruangan-edit-ruangan">
                                @foreach($units as $unit)
                                    <option value="{{$unit->nama_units}}">{{$unit->nama_units}}</option>
                                @endforeach
                            </select>
{{--                            <input type="text" name="ruangan" id="ruangan-edit-ruangan" value="{{ old('ruangan') }}">--}}
                        </div>
                    </div>
                    @if ($errors->edit->has('ruangan'))
                        <div class="invalid">{{ $errors->edit->first('ruangan') }}</div>
                    @endif
                    <div class="row">
                        <input type="submit" name="submit" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-form>
