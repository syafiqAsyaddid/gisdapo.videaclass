<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : ''" :sekolah="$sekolah ?? null">
    <main class="" style="margin-top: 7px; ">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body p-4">
                @php
                    $sekolahObj = $sekolah ?? (auth()->user()->sekolah ?? null);
                    $jenjangName = $sekolahObj->jenjang->nama_jenjang ?? '';
                    
                    $currentJenjang = strtoupper($jenjangName);
                    $jenjangKey = $currentJenjang;
                    if (str_contains($currentJenjang, 'TAMAN KANAK-KANAK') || str_contains($currentJenjang, 'TK')) $jenjangKey = 'TK';
                    elseif (str_contains($currentJenjang, 'SEKOLAH DASAR') || str_contains($currentJenjang, 'SD')) $jenjangKey = 'SD';
                    elseif (str_contains($currentJenjang, 'SEKOLAH MENENGAH PERTAMA') || str_contains($currentJenjang, 'SMP')) $jenjangKey = 'SMP';
                    elseif (str_contains($currentJenjang, 'SEKOLAH MENENGAH ATAS') || str_contains($currentJenjang, 'SMA')) $jenjangKey = 'SMA';
                    elseif (str_contains($currentJenjang, 'SEKOLAH MENENGAH KEJURUAN') || str_contains($currentJenjang, 'SMK')) $jenjangKey = 'SMK';
                    elseif (str_contains($currentJenjang, 'SEKOLAH LUAR BIASA') || str_contains($currentJenjang, 'SLB')) $jenjangKey = 'SLB';
                    elseif (str_contains($currentJenjang, 'UNIVERSITAS') || str_contains($currentJenjang, 'MII') || str_contains($currentJenjang, 'AKADEMI') || str_contains($currentJenjang, 'INSTITUT') || str_contains($currentJenjang, 'SEKOLAH TINGGI')) $jenjangKey = 'UNIVERSITAS';

                    // Config for Rombel/Class Columns
                    $univConfig = [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8'];
                    $rombelConfig = [
                        'TK' => [1 => 'TK A', 2 => 'TK B'],
                        'SD' => [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6'],
                        'SMP' => [7 => '7', 8 => '8', 9 => '9'],
                        'SMA' => [10 => '10', 11 => '11', 12 => '12'],
                        'SMK' => [10 => '10', 11 => '11', 12 => '12', 13 => '13'],
                        'SLB' => [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12'],
                        'UNIVERSITAS' => $univConfig,
                    ];
                    
                    $kelasToRender = $rombelConfig[$jenjangKey] ?? [10 => '10', 11 => '11', 12 => '12'];
                    ksort($kelasToRender);
                @endphp
                <div class="d-flex align-items-center mb-4">
                    <h2 class="fw-bold mb-0">DATA {{ strtoupper(\App\Helpers\TermHelper::getTerm($jenjangName, 'siswa')) }}</h2>
                </div>
                
                <div class="" id="form-display">
                    <div class="w-100 table-responsive mb-4">
                        <table class="table table-hover align-middle table-borderless" id="table">
                            <thead class="bg-light text-secondary">
                                <tr class="text-center">
                                    <th class="py-3 ps-3 rounded-start align-middle" rowspan="2">No</th>
                                    <th class="py-3 align-middle" rowspan="2">Jurusan</th>
                                    <th class="py-3" colspan="{{ count($kelasToRender) }}">{{ \App\Helpers\TermHelper::getTerm($jenjangName, 'kelas') }}</th>
                                    <th class="py-3 align-middle" rowspan="2">TOTAL</th>
                                    @if(auth()->user()->can('operator_sekolah'))
                                        <th class="py-3 rounded-end align-middle" rowspan="2" colspan="2">OPSI</th>
                                    @endif
                                </tr>
                                <tr class="text-center">
                                    @foreach($kelasToRender as $key => $label)
                                        <th class="py-2 text-secondary text-xs font-weight-bolder">{{ $label }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                        @if($data->isEmpty())
                            <tr align="center">
                                <td colspan="{{ 4 + count($kelasToRender) }}" class="text-center py-5 text-muted">
                                    <i class="fa fa-folder-open fa-3x mb-3"></i>
                                    <p>BELUM ADA DATA</p>
                                </td>
                            </tr>
                        @else
                            @php $no=1 @endphp
                                @foreach($data as $tampil)
                                    <tr class="border-bottom">
                                        <input type="hidden" class="id" value="{{ $tampil->id }}">
                                        <td class="ps-3 fw-bold text-secondary">{{ $no++ }}</td>
                                        <td class="fw-bold text-dark jurusan">{{ $tampil->rombel->jurusan->nama_jurusan  ?? '-'}}</td>
                                        @php $rowTotal = 0; @endphp
                                        @foreach($kelasToRender as $key => $label)
                                            @php 
                                                $val = $tampil->{'kelas_'.$key} ?? 0;
                                                $rowTotal += $val;
                                            @endphp
                                            <td class="text-center">{{ $val }}</td>
                                        @endforeach
                                        <td class="text-center fw-bold">{{ $rowTotal }}</td>
                                        @if(auth()->user()->can('operator_sekolah'))
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-info mb-0 edit" 
                                                    data-target=".bd-example-modal-xl" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target=".form-edit"
                                                    title="Edit">
                                                    Edit
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            <tr class="bg-light">
                                <td colspan="2" class="ps-3 fw-bold text-secondary">Total</td>
                                @php $grandTotal = 0; @endphp
                                @foreach($kelasToRender as $key => $label)
                                    @php 
                                        $colSum = $data->sum('kelas_'.$key); 
                                        $grandTotal += $colSum;
                                    @endphp
                                    <td class="text-center fw-bold">{{ $colSum }}</td>
                                @endforeach
                                <td class="text-center fw-bold text-primary">{{ $grandTotal }}</td>
                                @if(auth()->user()->can('operator_sekolah'))
                                    <td></td>
                                @endif
                            </tr>
                            @if(auth()->user()->can('operator_sekolah'))
                                @include('form.edit-siswa')
                            @endif
                        @endif
                        </tbody>
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
                var jurusan = $('.jurusan').text();
                console.log(jurusan);
            
                $('#siswa-edit-id').val(data[0].id);
                $('#siswa-edit-jurusan').val(data[0].rombel.jurusan.nama_jurusan);
                
                @foreach($kelasToRender as $key => $label)
                    $('#siswa-edit-{{$key}}').val(data[0].kelas_{{$key}});
                @endforeach
            });
        });
    </script>
    </body>

    </html>
</x-layout-sekolah>
