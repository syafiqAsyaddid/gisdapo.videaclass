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
                <div class="d-flex align-items-center mb-4">
                    <h2 class="fw-bold mb-0">DATA ASSET</h2>
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
                <h5 class="text-secondary fw-normal mb-3">{{ $sapras->nama }}</h5>
                <div class="" id="form-display">
                    <div class="">
                        <div class="input mb-3 d-flex justify-content-end align-items-center">
                            @if(auth()->user()->can('operator_sekolah'))

{{--                                kembali --}}
                            @php
//                            segment 1
                            $segment1 = Request::segment(2);
                            @endphp
                                <a href="{{url('sekolah/'.$segment1.'/sapras' )}}" type="button" class="btn btn-warning me-2" title="Kembali">
                                    <i class="fas fa-chevron-left me-1"></i> Kembali
                                </a>
                                <button type="button" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form" class="btn btn-success" title="Tambah">
                                    <i class="fas fa-plus me-1"></i> Tambah
                                </button>
                                @include('form.input-detailsapras')
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive mb-4">
                        <table class="table table-hover align-middle table-borderless" id="table">
                            <thead class="bg-light text-secondary">
                                <tr class="text-center">
                                    <th class="py-3 ps-3 rounded-start">NO</th>
                                    <th class="py-3">Nama Asset</th>
                                    <th class="py-3">Jumlah</th>
                                    <th class="py-3">Rusak Ringan</th>
                                    <th class="py-3">Rusak Sedang</th>
                                    <th class="py-3">Rusak Berat</th>

                                    @if(auth()->user()->can('operator_sekolah'))
                                        <th class="py-3 rounded-end">OPSI</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @if($data->isEmpty())
                                <tr align="center">
                                    <td colspan="9" class="text-center py-5 text-muted">
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
                                            <td class="ps-3 fw-bold text-secondary">
                                                {{ $no++ }}
                                            </td>
                                            <td class="fw-bold text-dark">
                                                {{ $tampil->namadetail }}
                                            </td>
                                            <td class="text-center">
                                                {{ $tampil->jumlah }}
                                            </td>
                                            <td class="text-center">
                                                @php
                                                $total = $tampil->kondisi / $tampil->jumlah * 100;
                                               echo $tampil->kondisi  .'  |  '. round($total, 2).'%';
                                                @endphp
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $total = $tampil->kondisi_sedang / $tampil->jumlah * 100;
                                                   echo $tampil->kondisi_sedang  .'  |  '.round($total, 2).'%';
                                                @endphp
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $total = $tampil->kondisi_buruk / $tampil->jumlah * 100;
                                                   echo $tampil->kondisi_buruk  .'  |  '.round($total, 2).'%';
                                                @endphp                                                            
                                            </td>
                                            @if(auth()->user()->can('operator_sekolah'))
                                                <td class="text-center">
                                                    <a href="{{ route('destroydetail', $tampil->id) }}"
                                                       onclick="return confirm('Apakah anda yakin ingin Hapus data ini?')"
                                                       class="btn btn-sm btn-danger mb-0" title="Hapus">
                                                        Hapus
                                                    </a>

                                                </td>
                                            @endif

                                        </tr>

                                    @endforeach


                        @endif
                            </tbody>
                        </table>
                    </div>
                </div>
{{--
{{--                </div>--}}
            </div>
        </div>
    </main>




    <script>

    </script>
    </body>

    </html>
</x-layout-sekolah>
