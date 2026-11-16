<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : ''">
    <main class="" style="margin-top: 7px; ">
        <div class="card">
            <div class="card-body">
                <h2 align="center">DATA MAPEL PRODUKTIF</h2>
                <div class="" id="form-display">
                    <div class="">
                        <div class="input">
                            @if(auth()->user()->can('operator_sekolah'))
                                <!-- <button type="button" style="float: right;" href="input-ptk.php"
                                    class="btn btn-success fa fa-plus" data-target=".bd-example-modal-xl"
                                    data-bs-toggle="modal" data-bs-target=".form"></button> -->
                                <button class="btn btn-success me-2 my-3" style="float: right;" type="button" data-target=".bd-example-modal-xl" data-bs-toggle="modal" data-bs-target=".form">
                                    <i class="fa fa-plus me-2"></i> Tambah Baru
                                </button>
                                @include('form.input-keahlian')
                                {{-- <form method="post" action="keahlian/import" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group" style="float: left; width: 400px;">
                                        <input required type="file" class="form-control" id="inputGroupFile04" required
                                            aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="excel">
                                        <button class="btn btn-outline-secondary" type="submit"
                                            id="inputGroupFileAddon04">Submit</button>
                                    </div>
                                </form> --}}
                            @endif
                            {{-- <input style="float: left; margin-bottom:8px;" type="text" placeholder="Cari Data..."
                            id="search"> --}}
                        </div>
                    </div>
                    <div class="w-100 table-responsive">
                        <table border="1" class="table table-bordered" style="border-collapse: collapse; margin-top: 5px;"
                            id="table">
                            <tr align="center" class="table-primary">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Jurusan</th>
                                <th rowspan="2">Kompetensi Keahlian</th>
                                <th rowspan="2" nowrap>Jumlah Guru</th>
                                <th rowspan="2">Total Jam Ajar</th>
                                <th colspan="3">Tingkat Kebutuhan</th>
                                @if(auth()->user()->can('operator_sekolah'))
                                    <th rowspan="2" colspan="2">Opsi</th>
                                @endif
                            </tr>
                            <tr align="center" class="table-primary">
                                <th>Quota</th>
                                <th>Lebih</th>
                                <th>Kurang</th>
                            </tr>
                            @if($jam->isEmpty())
                                <tr align="center">
                                    <td colspan="8">KOSONG</td>
                                </tr>
                            @else
                                @php
                                    $no =1;
                                    $total_guru = 0;
                                    $total_quota = 0;
                                    $total_lebih = 0;
                                    $total_kurang = 0;
                                @endphp
                                @foreach($jam as $tampil)
                                    <tr>
                                        <input type="hidden" class="id" value="{{ $tampil->id }}">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $tampil->mapel->jurusan? $tampil->mapel->jurusan->nama_jurusan:"" }}</td>
                                        <td>{{ $tampil->mapel->nama_mapel }}</td>
                                        <td>{{ $guru = $tampil->mapel->guru->count() }}</td>
                                        <td>{{ $tampil->total_jam }}</td>
                                        <td>{{ $quota = $tampil->tingkat_kebutuhan? $tampil->tingkat_kebutuhan->quota:0 }}</td>
                                        <td>{{ $lebih = $tampil->tingkat_kebutuhan? $tampil->tingkat_kebutuhan->lebih:0 }}</td>
                                        <td>{{ $kurang = $tampil->tingkat_kebutuhan? $tampil->tingkat_kebutuhan->kurang:0 }}</td>
                                        @if(auth()->user()->can('operator_sekolah'))
                                            <td align="center">
                                                <button class="btn btn-warning edit"
                                                    data-target=".bd-example-modal-xl" data-bs-toggle="modal"
                                                    data-bs-target=".form-edit">
                                                    <i class="fa fa-pencil : me-1"></i> Edit
                                                </button>
                                            </td>
                                            <td align="center">
                                                <a href="keahlian/{{ $tampil->id }}/hapus"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash : me-1"></i> Hapus
                                                </a>
                                            </td>
                                        @endif
                                        @php 
                                            $total_guru += $guru;
                                            $total_lebih += $lebih;
                                            $total_kurang += $kurang;
                                            $total_quota += $quota;
                                        @endphp
                                    </tr>
    
                                @endforeach
                                @if(auth()->user()->can('operator_sekolah'))
                                    @include('form.edit-keahlian')
                                @endif
                                <tr>
                                    <td colspan="3" align="center">Total</td>
                                    <td>{{ $total_guru }}</td>
                                    <td></td>
                                    <td>{{ $total_quota }}</td>
                                    <td>{{ $total_lebih }}</td>
                                    <td>{{ $total_kurang }}</td>
                                    
                                    <td colspan="2"></td>
                                </tr>
                            @endif
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

            $('.edit').click(function () {
                var id = $(this).parent().siblings('.id').val();
                var data = {!! json_encode($data) !!}.filter(data => data.id == id);

                console.log(data);

                $('#keahlian-edit-id').val(data[0].id);
                $('#keahlian-edit-nama').val(data[0].mapel.nama_mapel);
                $('#keahlian-edit-jurusan').val(data[0].mapel.jurusan.nama_jurusan).change();
                $('#keahlian-edit-jurusan-id').val(data[0].mapel.jurusan.id).change();
                $('#keahlian-edit-x').val(data[0].jam_kelas_x);
                $('#keahlian-edit-xi').val(data[0].jam_kelas_xi);
                $('#keahlian-edit-xii').val(data[0].jam_kelas_xii);
                $('#keahlian-edit-xiii').val(data[0].jam_kelas_xiii);

            });
        });

    </script>
    </body>

    </html>
</x-layout-sekolah>
