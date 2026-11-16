<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : ''">
    <style>
        td {
            padding: 5px;
            text-align: center;
        }
    </style>
    <main class="" style="margin-top: 7px; ">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h2 class="fw-bold mb-1">DATA UNIT</h2>
                    <h5 class="text-secondary fw-normal">{{ $ruang->ruangan }}</h5>
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
                        <div class="input mb-3 d-flex justify-content-end align-items-center">
                            <a href="../ruangan" type="button" class="btn btn-warning me-2">
                                <i class="fas fa-chevron-left me-1"></i> Kembali
                            </a>
                            @if(auth()->user()->can('operator_sekolah'))
                                <button type="button" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form" class="btn btn-success">
                                    <i class="fa fa-plus me-1"></i> Tambah
                                </button>
                                @include('form.input-sapras')
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="table table-hover align-middle table-borderless" id="table">
                            <thead class="bg-light text-secondary">
                                <tr class="text-center">
                                    <th class="py-3 ps-3 rounded-start">NO</th>
                                    <th class="py-3">UNIT</th>
                                    <th class="py-3">JUMLAH ASSET</th>
                                    <th class="py-3">Rusak Ringan</th>
                                    <th class="py-3">Rusak Sedang</th>
                                    <th class="py-3">Rusak Berat</th>
                                    @if(auth()->user()->can('operator_sekolah'))
                                        <th class="py-3 rounded-end" colspan="4">OPSI</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
    
                            @if($data->isEmpty())
                                <tr align="center">
                                    <td colspan="10" class="text-center py-5 text-muted">
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
                                            <td class="fw-bold text-dark text-center">{{ $tampil->nama }}
                                            </td>
                                            <td class="text-center">
                                                {{ $tampil->jumlahSapras }}
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    if ($tampil->jumlahSapras > 0) {
                                                        $total = $tampil->kondisis / $tampil->jumlahSapras * 100;
                                                        echo $tampil->kondisis  .'  |  '. round($total, 2).'%';
                                                    } else {
                                                        echo '0  |  0%';
                                                    }
                                                @endphp
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    if ($tampil->jumlahSapras > 0) {
                                                        $total = $tampil->kondisi_sedangs / $tampil->jumlahSapras * 100;
                                                        echo $tampil->kondisi_sedangs  .'  |  '. round($total, 2).'%';
                                                    } else {
                                                        echo '0  |  0%';
                                                    }
                                                @endphp
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    if ($tampil->jumlahSapras > 0) {
                                                        $total = $tampil->kondisi_buruks / $tampil->jumlahSapras * 100;
                                                        echo $tampil->kondisi_buruks  .'  |  '. round($total, 2).'%';
                                                    } else {
                                                        echo '0  |  0%';
                                                    }
                                                @endphp
                                            </td>
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
                                                    <a href="{{route('hapussapras',$tampil->id)}}" 
                                                        class="btn btn-sm btn-danger mb-0" 
                                                        onclick="return confirm('Anda yakin ingin menghapus data ini?')" 
                                                        title="Hapus">
                                                        Hapus
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ url('sekolah/'. $ruang->sekolah_id .'/sapras/'. $tampil->id .'/detail') }}" 
                                                        class="btn btn-sm btn-primary mb-0" 
                                                        title="Detail">
                                                        Detail
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
{{--                                @include('form.input-dataparameter')--}}


{{--                                    modal --}}
                                <div class="modal fade bd-example-modal-l form" id="tampil{{$tampil->id}}" tabindex="-1" aria-labelledby="myLargeModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        tes
                                    </div>
                                </div>



                            @endforeach
{{--                                <tr align="center">--}}
{{--                                    <td colspan="2">Total</td>--}}
{{--                                    <td>{{ $data->sum('kondisi_baik') }}</td>--}}
{{--                                    <td>{{ $jumlah }}</td>--}}
{{--                                    <td colspan="2"></td>--}}
{{--                                </tr>--}}
                                @include('form.edit-sapras')
                            @endif
                    </table>
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
                $('#sapras-edit-ruangan-id').val(data[0].ruangan_id);
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
