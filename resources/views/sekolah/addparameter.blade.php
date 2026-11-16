<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : ''">
    <style>
        td {
            padding: 5px;
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <main class="" style="margin-top: 7px; ">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <button class="btn btn-success me-2 my-3" style="float: right"  type="button" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form">
                        <i class="fa fa-plus me-2"></i>
                    </button>
{{--                    a href --}}

                </div>
                <h2 align="center">DATA PARAMETER</h2>


                                @include('form.input-units')
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

                        <div class="d-sm-flex align-items-center mb-4">
                            @if(auth()->user()->can('operator_sekolah'))

                            @endif
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table border="1" class="table table-bordered" style="border-collapse: collapse; margin-top: 5px;"
                               id="table">
                            <tr align="center" class="table-primary">
                                <th >NO</th>
                                <th>Nama Parameter</th>
                                <th>Nilai</th>
                                @if(auth()->user()->can('operator_sekolah'))
                                    <th  colspan="3">OPSI</th>
                                @else
                                    <th rowspan="2">OPSI</th>
                                @endif
                            </tr>

                            @if($parametersekolah->isEmpty())
                                <tr align="center">
                                    <td colspan="7">KOSONG</td>
                                </tr>
                            @else
                                @php
                                    $no = 1;
                                    $jumlah = 0;
                                @endphp
                                @foreach($parametersekolah as $value)
                                    <tr>
                                        <td>
                                            {{ $no++ }}
                                        </td>
                                        <td>
                                            {{$value->parameters->parameter}}
                                        </td>
                                        <td>
                                            {{$value->nilai}}
                                        </td>
                                        <td>
{{--                                            button mosDAL--}}
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{$value->id}}" ><i class="fa fa-edit"></i></button>
                                            <a href="{{route('deleteparametersekolah',$value->id)}}"
                                               onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        </td>

{{--                                        modal delete--}}
                                        <div class="modal fade bd-example-modal-l form-sub" id="deleteModal{{$value->id}}" tabindex="-1" aria-labelledby="myLargeModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Parameter</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <form action="{{route('editparametersekolah',$value->id)}}" method="post">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-25">
                                                                        <label for="parameter">Parameter</label>
                                                                    </div>
                                                                    <div class="col-75">
                                                                        <select name="parameter" id="parameter" class="form-control">
                                                                            <option value="">Pilih Parameter</option>
                                                                            @foreach($parameter as $subkategori)
                                                                                <option value="{{$subkategori->id}}"
                                                                                @if($value->parameter_id == $subkategori->id)
                                                                                    selected
                                                                                @endif
                                                                                >{{$subkategori->parameter}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-25">
                                                                        <label for="nilai">Nilai</label>
                                                                    </div>
                                                                    <div class="col-75">
                                                                        <input type="text" id="nilai" name="nilai" placeholder="Nilai" class="form-control" value="{{$value->nilai}}">
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



                                            </div>
                                        </div>

                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>




    {{--    datatable--}}
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

    <script>
                    $('.table2').DataTable();

    </script>
{{--    <script>--}}
{{--        $(document).ready(function () {--}}

{{--            @if ($errors->input->any())--}}
{{--            $('#modalInput').modal('toggle');--}}
{{--            $('#modalInput').on('hidden.bs.modal', function(){--}}
{{--                $('.invalid').hide();--}}
{{--            });--}}
{{--            @endif--}}

{{--            @if ($errors->edit->any())--}}
{{--            $('#modalEdit').modal('toggle');--}}
{{--            $('#modalEdit').on('hidden.bs.modal', function(){--}}
{{--                $('.invalid').hide();--}}
{{--            });--}}
{{--            @endif--}}

{{--            $('.edit').click(function(){--}}
{{--                var id = $(this).parent().siblings('.id').val();--}}
{{--                var data = {!! json_encode($data) !!}.filter(data=> data.id == id);--}}

{{--                $('#ruangan-edit-id').val(data[0].id);--}}
{{--                $('#ruangan-edit-ruangan').val(data[0].ruangan);--}}

{{--            });--}}
{{--        });--}}


{{--    </script>--}}

    </body>

    </html>
</x-layout-sekolah>
