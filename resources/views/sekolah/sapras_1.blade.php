<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : ''">
    <main class="" style="margin-top: 7px; ">
        <div class="card">
            <div class="card-body">
                <h2 align="center">DATA SAPRAS</h2>
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
                <h5 align="center">{{ $ruang->ruangan }}</h5>
                <div class="" id="form-display">
                    <div class="">
                        <div class="input">
                            @if(auth()->user()->can('operator_sekolah'))
                                {{-- <form method="post" action="sapras/import" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group" style="float: left; width: 400px;">
                                        <input required type="file" class="form-control" id="inputGroupFile04" required
                                            aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="excel">
                                        <button class="btn btn-outline-secondary" type="submit"
                                            id="inputGroupFileAddon04">Submit</button>
                                    </div>
                                </form> --}}
                                <button type="button" style="float: right;" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form" class="btn btn-success fa fa-plus"></button>
                                @include('form.input-sapras')
                            @endif
                            <a href="../ruangan" type="button" style="float: right;" class="btn btn-warning fa fa-chevron-left"></a>
                            {{-- <input style="float: left; margin-bottom:8px;" type="text" placeholder="Cari Data..."
                            id="search"> --}}
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="table table-hover align-middle table-borderless" id="table">
                            <thead class="bg-light text-secondary">
                                <tr class="text-center">
                                    @foreach($parameter as $param)
                                        <th class="py-3">{{ $param->parameter }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom">
                                    @foreach($parameter as $params)
                                        <td class="text-center">
                                           {{$params->value}}
                                        </td>
                                    @endforeach
                                    @if(auth()->user()->can('operator_sekolah'))
                                        <td class="text-center">
                                            <button type="button" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form" class="btn btn-sm btn-outline-primary mb-0" onclick="edit({{ $params->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger mb-0" onclick="hapus({{ $params->id }})">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            </tbody>
                                @include('form.edit-sapras')
                        </table>
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
                $('#sapras-edit-id').val(data[0].id);
                $('#sapras-edit-ruang').val(data[0].ruang);
                $('#sapras-edit-nama').val(data[0].nama);
                $('#sapras-edit-baik').val(data[0].kondisi_baik);
                $('#sapras-edit-sedang').val(data[0].kondisi_sedang);
                $('#sapras-edit-berat').val(data[0].kondisi_berat);
            
            });
        });

    </script>

    </body>

    </html>
</x-layout-sekolah>
