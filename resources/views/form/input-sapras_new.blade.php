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
                            <label for="nama">Nama Parameter</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="nama">
                        </div>
                    </div>
                    @if ($errors->input->has('nama'))
                        <div class="invalid">{{ $errors->edit->first('nama') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="nilai">Nilai Kerusakan</label>
                        </div>
                        <div class="col-75">
                            <input type="number" name="nilai" id="nilai">
                        </div>
                    </div>
                    @if ($errors->input->has('nilai'))
                        <div class="invalid">{{ $errors->input->first('nilai') }}</div>
                    @endif
{{--                    input file--}}

                    <div class="row">
                        <input type="submit" name="submit" value="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-form>
