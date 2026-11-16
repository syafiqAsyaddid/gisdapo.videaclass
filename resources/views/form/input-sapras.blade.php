<x-layout-form>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Input Sarpras</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="../sapras/create" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ruangan_id" value="{{ $ruang->id }}">
                    <div class="row">
                        <div class="col-25">
                            <label for="sub_kategori">Sub Kategori</label>
                        </div>
                        <div class="col-75">
                            <select name="sub_kategori" id="sub_kategori" >
                                <option value="">Pilih</option>
                                @foreach($sub as $subunit)
                                    <option value="{{$subunit->id}}">{{$subunit->nama_sub}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($errors->input->has('sub_kategori'))
                        <div class="invalid">{{ $errors->edit->first('sub_kategori') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="nama">Nama Unit</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nama">
                        </div>
                    </div>
                    @if ($errors->input->has('nama'))
                        <div class="invalid">{{ $errors->edit->first('nama') }}</div>
                    @endif
{{--                    <div class="row">--}}
{{--                        <div class="col-25">--}}
{{--                            <label for="kondisi_baik">Jumlah Kondisi Baik ( % )</label>--}}
{{--                        </div>--}}
{{--                        <div class="col-75">--}}
{{--                            <input type="number" name="kondisi_baik" id="kondisi_baik">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @if ($errors->input->has('kondisi_baik'))--}}
{{--                        <div class="invalid">{{ $errors->input->first('kondisi_baik') }}</div>--}}
{{--                    @endif--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-25">--}}
{{--                            <label for="kondisi_sedang">Jumlah Rusak Sedang</label>--}}
{{--                        </div>--}}
{{--                        <div class="col-75">--}}
{{--                            <input type="number" name="kondisi_sedang" id="kondisi_sedang">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @if ($errors->input->has('kondisi_sedang'))--}}
{{--                        <div class="invalid">{{ $errors->input->first('kondisi_sedang') }}</div>--}}
{{--                    @endif--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-25">--}}
{{--                            <label for="kondisi_berat">Jumlah Rusak Berat</label>--}}
{{--                        </div>--}}
{{--                        <div class="col-75">--}}
{{--                            <input type="number" name="kondisi_berat" id="kondisi_berat">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @if ($errors->input->has('kondisi_berat'))--}}
{{--                        <div class="invalid">{{ $errors->input->first('kondisi_berat') }}</div>--}}
{{--                    @endif--}}
                    <div class="row">
                        <div class="col-25">
                            <label for="foto">Foto</label>
                        </div>
                        <div class="col-75">
                            <input type="file" name="foto" >
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" name="submit" value="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-form>
