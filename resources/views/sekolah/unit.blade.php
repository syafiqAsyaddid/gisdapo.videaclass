<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : ''">
    <main class="" style="margin-top: 7px; ">
        <div class="card">
            <div class="card-body">
                <h2 align="center">DATA UNIT</h2>
                @if ($errors->file->any())
                        <div class="modal" id="file_error" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Error</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    <ul>
                                        @foreach ($errors->file->all() as $error)
                                            <li align="left">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>

                    @endif
                <div class="" id="form-display">
                    <div class="">
                            @if(auth()->user()->can('operator_sekolah'))
                                <form action="{{route('simpanunit')}}" method="post">
                                    @csrf
                                   <div class="row">
                                       <div class="col-md-12 col-lg-6 col-sm-12">
                                           <label for="unit">Nama Unit</label>
                                           <input type="text" class="form-control" name="nama_units" id="unit" placeholder="Masukkan Unit">
                                       </div>

{{--                                       button--}}
                                       <div class="col-md-12 col-lg-6 col-sm-12">
                                           <button type="submit" class="btn btn-primary btn-lg"  id="btn-submit" style="margin-top: 30px">Submit</button>
                                       </div>

                                   </div>
                                </form>
                                <!-- <button type="button" style="float: right;" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form" class="btn btn-success fa fa-plus"></button> -->

                            @endif
                            {{-- <input style="float: left; margin-bottom:8px;" type="text" placeholder="Cari Data..."
                            id="search"> --}}
                    </div>
                    <div class="table-responsive">
                        <table border="1" class="table table-bordered" style="border-collapse: collapse; margin-top: 5px;"
                            id="table">
                            <tr align="center" class="table-primary">
                                <th >NO</th>
                                <th >UNIT</th>
                                <th >AKSI</th>
                            </tr>

                            @foreach ($units as $unit)
                                <tr>
                                    <td align="center">{{$loop->iteration}}</td>
                                    <td align="center">{{$unit->nama_units}}</td>
                                    <td align="center">
                                        @if(auth()->user()->can('operator_sekolah'))
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editunit{{$unit->id}}" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <a href="{{route('hapusunit', $unit->id)}}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
{{--                                modal editunit--}}

                                <!-- Modal -->
                                <div class="modal fade" id="editunit{{$unit->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah Unit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('updateunit', $unit->id)}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12 col-sm-12">
                                                            <label for="unit">Nama Unit</label>
                                                            <input type="text" class="form-control" name="nama_units" id="unit" placeholder="Masukkan Unit" value="{{$unit->nama_units}}">
                                                        </div>

                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="../ruangan" type="button" class="btn btn-warning me-2">
                                <i class="fas fa-chevron-left me-1"></i> Kembali
                            </a>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </table>
                    </div>
                </div>
{{--                button kembali--}}
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <a href="{{url('sekolah/ruangan')}}" class="btn btn-primary btn-lg" style="margin-top: 10px">Kembali</a>
                    </div>
                </div>
            </div>

        </div>
    </main>




    <script>
        $(document).ready(function () {

            @if ($errors->input->any())
                $('#modalInput').modal('toggle');
                $('#modalInput').on('hidden.bs.modal', function(){
                    $('.invalid').hide();
                });
            @endif

            @if ($errors->edit->any())
                $('#modalEdit').modal('toggle');
                $('#modalEdit').on('hidden.bs.modal', function(){
                    $('.invalid').hide();
                });
            @endif

            $('.edit').click(function(){
                var id = $(this).parent().siblings('.id').val();
                var data = {!! json_encode($data) !!}.filter(data=> data.id == id);

                $('#ruangan-edit-id').val(data[0].id);
                $('#ruangan-edit-ruangan').val(data[0].ruangan);

            });
        });

    </script>

    </body>

    </html>
</x-layout-sekolah>
