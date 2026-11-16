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
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
                <div class="" id="form-display">
                    <div class="">
                        <div class="d-sm-flex align-items-center mb-4">
                            @if(auth()->user()->can('operator_sekolah'))
                                <button class="btn btn-success me-2 mt-3" type="button"
                                        data-target=".bd-example-modal-xl" data-bs-toggle="modal"
                                        data-bs-target=".form">
                                    <i class="fa fa-plus me-2"></i> Tambah Kategori
                                </button>
                                <button class="btn btn-primary me-2 mt-3" type="button"
                                        data-target=".bd-example-modal-lg" data-bs-toggle="modal"
                                        data-bs-target=".form1">
                                    <i class="fa fa-plus me-2"></i> Tambah Sub Kategori
                                </button>
                                <button class="btn btn-info me-2 mt-3" type="button" data-target=".bd-example-modal-xl"
                                        data-bs-toggle="modal" data-bs-target=".form2">
                                    <i class="fa fa-plus me-2"></i> Tambah Parameter
                                </button>
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
                                    <th class="py-3">KATEGORI</th>
                                    <th class="py-3">KERUSAKAN TOTAL ( % )</th>
                                    <th class="py-3">KESIMPULAN SARPRAS SEKOLAH</th>
                                    <th class="py-3 rounded-end"> SARPRAS SEKOLAH</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $no = 1;
                                $jumlah = 0;
                                $segment = \Illuminate\Support\Facades\Request::segment(3);

                            @endphp
                            @foreach($data as $tampil)

                                @php

                                @endphp
                                <tr class="border-bottom">
                                    <td class="ps-3 fw-bold text-secondary">
                                        {{ $no++ }}
                                    </td>
                                    <td class="fw-bold text-dark">
                                        {{ $tampil->nama }}
                                    </td>
                                    @php
                                        $total = $tampil->kondisi_buruks / $tampil->jumlahSapras * 100;
                                    @endphp
                                    <td
                                    style="background-color:
                                    @php

                                        if($total >= 0 && $total <= 30){
                                            echo 'green';
                                        }elseif($total >= 31 && $total <= 70){
                                            echo 'orange';
                                        }elseif($total >= 71 && $total <= 101){
                                            echo 'red';
                                        }
                                        @endphp
                                    ; color: white" class="text-center fw-bold rounded">


                                        @php
                                            echo round($total, 2).'%';
                                        @endphp

                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('pdfdetailsarpras',$segment)}}" target="_blank"
                                           class="btn btn-sm btn-outline-secondary mb-0"><i class="fas fa-file-pdf me-1"></i> Download File</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('pdfprofilesarpras',$segment)}}" target="_blank"
                                           class="btn btn-sm btn-outline-secondary mb-0"><i class="fas fa-file-pdf me-1"></i>Download File</a>
                                    </td>
                                </tr>
                            @endforeach
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
            $('#modalInput').on('hidden.bs.modal', function () {
                $('.invalid').hide();
            });
            @endif

            @if ($errors->edit->any())
            $('#modalEdit').modal('toggle');
            $('#modalEdit').on('hidden.bs.modal', function () {
                $('.invalid').hide();
            });
            @endif

            $('.edit').click(function () {
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
