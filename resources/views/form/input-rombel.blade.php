<x-layout-form>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Input Rombel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="rombel/create" method="post">
                    @csrf
                    @php
                        // Get Jenjang from Authenticated User's School
                    $jenjangName = auth()->user()->sekolah->jenjang->nama_jenjang ?? '';
                    // Fix mismatch by mapping full names to keys
                    $currentJenjang = strtoupper($jenjangName);
                    $jenjangKey = $currentJenjang;
                    if (str_contains($currentJenjang, 'TAMAN KANAK-KANAK') || str_contains($currentJenjang, 'TK')) $jenjangKey = 'TK';
                    elseif (str_contains($currentJenjang, 'SEKOLAH DASAR') || str_contains($currentJenjang, 'SD')) $jenjangKey = 'SD';
                    elseif (str_contains($currentJenjang, 'SEKOLAH MENENGAH PERTAMA') || str_contains($currentJenjang, 'SMP')) $jenjangKey = 'SMP';
                    elseif (str_contains($currentJenjang, 'SEKOLAH MENENGAH ATAS') || str_contains($currentJenjang, 'SMA')) $jenjangKey = 'SMA';
                    elseif (str_contains($currentJenjang, 'SEKOLAH MENENGAH KEJURUAN') || str_contains($currentJenjang, 'SMK')) $jenjangKey = 'SMK';
                    elseif (str_contains($currentJenjang, 'SEKOLAH LUAR BIASA') || str_contains($currentJenjang, 'SLB')) $jenjangKey = 'SLB';
                    elseif (str_contains($currentJenjang, 'UNIVERSITAS') || str_contains($currentJenjang, 'MII') || str_contains($currentJenjang, 'AKADEMI') || str_contains($currentJenjang, 'INSTITUT') || str_contains($currentJenjang, 'SEKOLAH TINGGI')) $jenjangKey = 'UNIVERSITAS';

                    $hasJurusan = ($jenjangKey == 'SMK' || $jenjangKey == 'UNIVERSITAS');
                    
                    $univConfig = [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8'];
                    $rombelConfig = [
                        'TK' => [1 => 'TK A', 2 => 'TK B'],
                        'SD' => [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6'],
                        'SMP' => [7 => '7', 8 => '8', 9 => '9'],
                        'SMA' => [10 => '10', 11 => '11', 12 => '12'],
                        'SMK' => [10 => '10', 11 => '11', 12 => '12', 13 => '13'],
                        'UNIVERSITAS' => $univConfig,
                    ];

                    $kelasToRender = $rombelConfig[$jenjangKey] ?? [10 => '10', 11 => '11', 12 => '12'];
                    ksort($kelasToRender);
                        
                    // Terminology helper for Label in loop
                    $jenjangName = auth()->user()->sekolah->jenjang->nama_jenjang ?? '';
                    @endphp

                    @if($hasJurusan)
                    <div class="row">
                        <div class="col-25">
                            <label for="jurusan_id">Jurusan/Keahlian</label>
                        </div>
                        <div class="col-75">
                            <input type="text" list="jurusan" name="jurusan_id" autocomplete="off" value="{{ old('jurusan_id') }}">
                        </div>
                    </div>
                    @if ($errors->input->has('jurusan_id'))
                        <div class="invalid">{{ $errors->input->first('jurusan_id') }}</div>
                    @endif
                    @else
                        <input type="hidden" name="jurusan_id" value="-">
                    @endif

                    @foreach($kelasToRender as $key => $label)
                    <div class="row">
                        <div class="col-25">
                            @php
                                $prefix = \App\Helpers\TermHelper::getTerm($jenjangName, 'kelas');
                                if(str_contains(strtoupper($jenjangName), 'TK')) $prefix = '';
                            @endphp
                            <label for="kelas_{{ $key }}">{{ \App\Helpers\TermHelper::getTerm($jenjangName, 'rombel') }} {{ $prefix }} {{ $label }}</label>
                        </div>
                        <div class="col-75">
                            <input type="number" name="kelas_{{ $key }}" id="kelas_{{ $key }}" step="false" value="{{ old('kelas_' . $key) }}">
                        </div>
                    </div>
                    @if ($errors->input->has('kelas_' . $key))
                        <div class="invalid">{{ $errors->input->first('kelas_' . $key) }}</div>
                    @endif
                    @endforeach
                    {{-- <div class="row">
                <div class="col-25">
                    <label for="total">Total Rombel</label>
                </div>
                <div class="col-75">
                    <input type="number" name="total" value="" disabled id="total">
                </div>
            </div> --}}
                <div class="row">
                    <input type="submit" name="submit" value="submit">
                </form>
            </div>
        </div>
    </div>
</x-layout-form>
