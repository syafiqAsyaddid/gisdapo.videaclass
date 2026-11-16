<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : ''">
    <style>
        td {
            padding: 5px;
            text-align: center;
        }
    </style>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <main class="" style="margin-top: 7px; ">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="fw-bold mb-0">DATA SARPRAS</h2>
                </div>

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
                        <div class="input mb-3 d-flex flex-wrap justify-content-end align-items-center gap-2">
                            @if(auth()->user()->can('operator_sekolah'))
                                <button class="btn btn-success" type="button" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form">
                                    <i class="fa fa-plus me-1"></i> Tambah Kategori
                                </button>
                                <button class="btn btn-primary" type="button" data-target=".bd-example-modal-lg" data-bs-toggle="modal" data-bs-target=".form1">
                                    <i class="fa fa-plus me-1"></i> Tambah Sub Kategori
                                </button>
                                <button class="btn btn-info" type="button" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form2">
                                    <i class="fa fa-plus me-1"></i> Tambah Parameter
                                </button>
                                <a href="{{route('pdfsarpras',auth()->user()->sekolah_id)}}" class="btn btn-danger" > <i class="fas fa-file-pdf me-1"></i> Surat Sarpras</a>
                                
                                @include('form.input-ruangan')
                                @include('form.input-subkategori')
                                @include('form.input-parameter')
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="table table-hover align-middle table-borderless" id="table">
                            <thead class="bg-light text-secondary">
                                <tr class="text-center">
                                    <th class="py-3 ps-3 rounded-start">NO</th>
                                    <th class="py-3" width="40%">KATEGORI</th>
                                    <th class="py-3">JUMLAH SUB KATEGORI </th>
                                    @if(auth()->user()->can('operator_sekolah'))
                                        <th class="py-3 rounded-end" colspan="3">OPSI</th>
                                    @else
                                        <th class="py-3 rounded-end">OPSI</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
    
                            @if($data->isEmpty())
                                <tr align="center">
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fa fa-folder-open fa-3x mb-3"></i>
                                        <p>BELUM ADA DATA</p>
                                    </td>
                                </tr>
                            @else
                                @php 
                                    $no = 1; 
                                    $jumlah = 0;
                                @endphp
                                    @foreach($data as $tampil)
                                        <tr class="border-bottom">
                                            <input type="hidden" class="id" value="{{ $tampil->id }}">
                                            <td class="ps-3 fw-bold text-secondary">{{ $no++ }}</td>
                                            <td class="fw-bold text-dark">{{ $tampil->ruangan }}</td>
                                            <td class="text-center">{{ $tampil->sapras_count }}</td>
                                            @if(auth()->user()->can('operator_sekolah'))
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-info mb-0 edit text-white" 
                                                        data-target=".bd-example-modal-xl" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target=".form-edit"
                                                        title="Edit">
                                                        Edit
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    <a href="ruangan/{{ $tampil->id }}/hapus"
                                                        class="btn btn-sm btn-danger mb-0"
                                                        onclick="return confirm('Anda yakin ingin menghapus data ini?')"
                                                        title="Hapus">
                                                        Hapus
                                                    </a>
                                                </td>
                                            @endif
                                                <td class="text-center">
                                                    <a href="{{ $tampil->id }}/sapras" class="btn btn-sm btn-primary mb-0" title="Detail">
                                                        Detail
                                                    </a>
                                                </td>
                                        </tr>
    
                                    @endforeach
                                    @include('form.edit-ruangan')
    
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>




{{--    datatable--}}
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.table2').DataTable({
                'language': {
                    'url': 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json'
                }
            });

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
