<x-layout-form>

    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Input {{$sapras->nama}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="{{route('savedetailsapras')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_sarpras" value="{{ $sapras->id }}">
                    <div class="row">
                        <div class="col-25">
                            <label for="namadetail">Nama Asset</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="namadetail" required>
                        </div>
                    </div>
                    @if ($errors->has('namadetail'))
                        <div class="invalid">{{ $errors->first('namadetail') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="nama">Jumlah Asset</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="jumlah"required id="jumlah">
                        </div>
                    </div>
                    @if ($errors->has('jumlah'))
                        <div class="invalid">{{ $errors->first('jumlah') }}</div>
                    @endif

                    <div class="row">
                        <div class="col-25">
                            <label for="nama">Jumlah Rusak Ringan <span id="pers_baik"></span></label>
                        </div>
                        <div class="col-75">
                            <input type="number" name="kondisi"required id="baik"  value="{{old('kondisi')}}">
                        </div>
                    </div>
                    @if ($errors->has('kondisi'))
                        <div class="invalid">{{ $errors->first('kondisi') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="nama">Jumlah Rusak Sedang <span id="pers_sedang"></span></label>
                        </div>
                        <div class="col-75">
                            <input type="number" name="kondisi_sedang"required id="kondisi_sedang" value="{{old('kondisi_sedang')}}">
                        </div>
                    </div>
                    @if ($errors->has('kondisi_sedang'))
                        <div class="invalid">{{ $errors->first('kondisi_sedang') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label for="nama">Jumlah Rusak Berat <span id="pers_buruk"></span></label>
                        </div>
                        <div class="col-75">
                            <input type="number" name="kondisi_buruk"required id="kondisi_buruk" value="{{old('kondisi_buruk')}}">
                        </div>
                    </div>
                    @if ($errors->has('kondisi_buruk'))
                        <div class="invalid">{{ $errors->first('kondisi_buruk') }}</div>
                    @endif

{{--                    button hitung--}}


                    <div class="row">
                        <input type="submit" name="submit" value="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout-form>

<script>
    $(document).ready(function(){
        $('#baik').change(function(){
            var total = parseInt($('#baik').val()) + parseInt($('#kondisi_sedang').val()) + parseInt($('#kondisi_buruk').val());
            if(total < $('#baik').val()){
                alert('jumlah tidak boleh melebihi jumlah asset');
                $('#baik').val('');
            }
            var baik = $('#baik').val();
            var jumlah = $('#jumlah').val();
            var pers = Math.round(baik/jumlah*100);
            // var kurang = jumlah-baik;
          $('#pers_baik').html('('+pers+'% dari jumlah asset)');
          // $('#jumlah').val(kurang)
        });
        $('#kondisi_sedang').change(function(){
            var total = parseInt($('#baik').val()) + parseInt($('#kondisi_sedang').val()) + parseInt($('#kondisi_buruk').val());
            if(total < $('#kondisi_sedang').val()){
                alert('jumlah tidak boleh melebihi jumlah asset');
                $('#kondisi_sedang').val('');
            }
            var jumlah = $('#jumlah').val();
            var sedang = $('#kondisi_sedang').val();
            var pers = Math.round(sedang/jumlah*100);
            $('#pers_sedang').html('('+pers+'% dari jumlah asset)');
        });
        $('#kondisi_buruk').change(function(){
            var total = parseInt($('#baik').val()) + parseInt($('#kondisi_sedang').val()) + parseInt($('#kondisi_buruk').val());
            if(total < $('#kondisi_buruk').val()){
                alert('jumlah tidak boleh melebihi jumlah asset');
                $('#kondisi_buruk').val('');
            }
            var jumlah = $('#jumlah').val();
            var buruk = $('#kondisi_buruk').val();
            var pers = Math.round(buruk/jumlah*100);
            $('#pers_buruk').html('('+pers+'% dari jumlah asset)');
        });
    });
</script>