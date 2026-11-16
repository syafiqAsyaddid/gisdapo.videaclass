<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : ''">
    <main class="" style="margin-top: 7px; ">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="fw-bold mb-0">DATA PTK</h2>
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
                        <div class="d-sm-flex align-items-center mb-4">
                            @if(auth()->user()->can('operator_sekolah'))
                            <form class="flex-grow-1 me-sm-5 mt-3" method="post" action="ptk/import" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex">
                                    <div class="costum-input-file : me-2">
                                        <input required type="file" class="form-control" id="inputGroupFile04"
                                        aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="excel">
                                        <div class="costum-input-file-mask : rounded">
                                            <i class="fa fa-folder-open : text-secondary me-2"></i> Pilih berkas untuk di upload
                                        </div>
                                    </div>
                                    <button class="btn btn-info" type="submit"
                                        id="inputGroupFileAddon04">Upload</button>
                                </div>
                            </form>
                            <a class="btn btn-primary me-2 mt-3" href="ptk/format">
                                <i class="fa fa-download"></i> Format Excel
                            </a>
                            <button class="btn btn-success me-2 mt-3" type="button" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form">
                                <i class="fa fa-plus me-2"></i> Tambah Baru
                            </button>
                            @include('form.input-ptk')
                                
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="table table-hover align-middle table-borderless" id="table">
                            <thead class="bg-light text-secondary">
                                <tr>
                                    <th class="py-3 ps-3 rounded-start">No</th>
                                    <th class="py-3">Nama</th>
                                    <th class="py-3">NIP</th>
                                    <th class="py-3">Pendidikan</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3">Jabatan</th>
                                    @if(auth()->user()->can('operator_sekolah'))
                                        <th class="py-3 rounded-end text-center" colspan="2">Opsi</th>
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
                                @php $no = 1; @endphp
                                    @foreach($data as $tampil)
                                        <tr class="border-bottom">
                                            <input type="hidden" class="id" value="{{ $tampil->id }}">
                                            <td class="ps-3 fw-bold text-secondary">{{ $no++ }}</td>
                                            <td class="fw-bold text-dark">{{ $tampil->nama }}</td>
                                            <td>{{ $tampil->nip }}</td>
                                            <td>{{ $tampil->pendidikan->pendidikan }}</td>
                                            <td>{{ $tampil->status_pegawai->status }}</td>
                                            <td>{{ $tampil->jabatan }}</td>
                                            @if(auth()->user()->can('operator_sekolah'))
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-info mb-0 me-1 edit" 
                                                        data-target=".bd-example-modal-xl" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target=".form-edit" 
                                                        title="Edit">
                                                        Edit
                                                    </button>
                                                    
                                                    <a href="ptk/{{ $tampil->id }}/hapus" 
                                                        class="btn btn-sm btn-outline-danger mb-0" 
                                                        onclick="return confirm('Anda yakin ingin menghapus data ini?')" 
                                                        title="Hapus">
                                                        Hapus
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
    
                                    @endforeach
    
                                    @include('form.edit-ptk')
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- <table border="1" class="table table-bordered border-primary" style="width: 50px;">
                    <tr>
                        <th>Jumlah</th>
                        <th>Tingkat Kebutuhan</th>
                        <th>Lebih</th>
                        <th>Kurang</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table> --}}
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

            @if ($errors->file->any())
                $('#file_error').modal('toggle');
                
            @endif

            $('.edit').click(function(){
                var id = $(this).parent().siblings('.id').val();
                var data = {!! json_encode($data) !!}.filter(data=> data.id == id);

                console.log(data);
                
                $('#ptk-edit-id').val(data[0].id);
                $('#ptk-edit-nip').val(data[0].nip);
                $('#ptk-edit-nama').val(data[0].nama);
                $('#ptk-edit-tempat_lahir').val(data[0].tempat_lahir);
                $('#ptk-edit-tanggal_lahir').val(data[0].tanggal_lahir);
                $('#ptk-edit-alamat').val(data[0].alamat);
                $('#ptk-edit-telepon').val(data[0].telepon);
                $('#ptk-edit-email').val(data[0].email);
                $("#ptk-edit-status_pegawai_id").val(data[0].status_pegawai_id).change();
                $("#ptk-edit-pendidikan_id").val(data[0].pendidikan_id).change();
                $("#ptk-edit-jabatan").val(data[0].jabatan);
            });
        });

    </script>

    </body>

    </html>
</x-layout-sekolah>
