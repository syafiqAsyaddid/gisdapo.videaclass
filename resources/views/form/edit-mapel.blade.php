<x-layout-form-edit>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Mapel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">

                <form action="mapel/update" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row row-na">
                      <input type="hidden" name="id" id="mapel-edit-id" value="">
                        <div class="col-25">
                            <label for="mapel">{{ \App\Helpers\TermHelper::getTerm(auth()->user()->sekolah->jenjang->nama_jenjang ?? '', 'mapel') }}</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="" list="mapel" value="" id="mapel-edit-nama" autocomplete="off" disabled>
                        </div>
                    </div>
                    @php
                        $jenjangName = auth()->user()->sekolah->jenjang->nama_jenjang ?? '';
                        $userJenjang = auth()->user()->sekolah->jenjang_melayani ?? [];
                        
                        $currentJenjang = strtoupper($jenjangName);
                        $jenjangKey = $currentJenjang;
                        if (str_contains($currentJenjang, 'TAMAN KANAK-KANAK') || str_contains($currentJenjang, 'TK')) $jenjangKey = 'TK';
                        elseif (str_contains($currentJenjang, 'SEKOLAH DASAR') || str_contains($currentJenjang, 'SD')) $jenjangKey = 'SD';
                        elseif (str_contains($currentJenjang, 'SEKOLAH MENENGAH PERTAMA') || str_contains($currentJenjang, 'SMP')) $jenjangKey = 'SMP';
                        elseif (str_contains($currentJenjang, 'SEKOLAH MENENGAH ATAS') || str_contains($currentJenjang, 'SMA')) $jenjangKey = 'SMA';
                        elseif (str_contains($currentJenjang, 'SEKOLAH MENENGAH KEJURUAN') || str_contains($currentJenjang, 'SMK')) $jenjangKey = 'SMK';
                        elseif (str_contains($currentJenjang, 'SEKOLAH LUAR BIASA') || str_contains($currentJenjang, 'SLB')) $jenjangKey = 'SLB';
                        elseif (str_contains($currentJenjang, 'UNIVERSITAS') || str_contains($currentJenjang, 'MII') || str_contains($currentJenjang, 'AKADEMI') || str_contains($currentJenjang, 'INSTITUT') || str_contains($currentJenjang, 'SEKOLAH TINGGI')) $jenjangKey = 'UNIVERSITAS';

                        $univConfig = [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8'];
                        $mapelConfig = [
                            'TK' => [1 => 'TK A', 2 => 'TK B'],
                            'SD' => [1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6'],
                            'SMP' => [7 => '7', 8 => '8', 9 => '9'],
                            'SMA' => [10 => '10', 11 => '11', 12 => '12'],
                            'SMK' => [10 => '10', 11 => '11', 12 => '12', 13 => '13'],
                            'UNIVERSITAS' => $univConfig,
                        ];
                        
                        $kelasToRender = $mapelConfig[$jenjangKey] ?? [10 => '10', 11 => '11', 12 => '12'];
                        ksort($kelasToRender);
                    @endphp

                    @foreach($kelasToRender as $key => $label)
                        @php
                            $fieldName = 'jam_kelas_' . $key;
                            if ($key == 10) $fieldName = 'jam_kelas_x';
                            if ($key == 11) $fieldName = 'jam_kelas_xi';
                            if ($key == 12) $fieldName = 'jam_kelas_xii';
                            
                            $prefix = \App\Helpers\TermHelper::getTerm($jenjangName, 'kelas');
                             if(str_contains(strtoupper($jenjangName), 'TK')) $prefix = '';
                             
                             // Unique IDs for Edit Form
                             $checkboxId = 'checkbox-edit-'.$key;
                             $containerId = 'container-edit-'.$key;
                             $inputId = 'mapel-edit-'.$key; // Kept consistent with previous mapel.blade.php JS
                        @endphp
                    <div class="row">
                        <div class="col-25">
                            <label>Termasuk {{ $prefix }} {{ $label }}?</label>
                        </div>
                        <div class="col-75">
                             {{-- Onclick calls toggle function with specific ID suffix --}}
                             <input type="checkbox" id="{{ $checkboxId }}" onclick="toggleEditInput('{{ $key }}')">
                        </div>
                    </div>
                    <div class="row" id="{{ $containerId }}" style="display: none;">
                        <div class="col-25">
                            <label for="{{ $fieldName }}">Total Jam {{ $prefix }} {{ $label }}</label>
                        </div>
                        <div class="col-75">
                            <input type="number" name="{{ $fieldName }}" id="{{ $inputId }}" value="">
                        </div>
                    </div>
                    @endforeach

                    <div class="row">
                        <input type="submit" name="submit" value="Simpan">
                    </div>
                </form>
                
                <script>
                    function toggleEditInput(key) {
                        var container = document.getElementById('container-edit-' + key);
                        if (container.style.display === "none") {
                            container.style.display = "flex";
                        } else {
                            container.style.display = "none";
                        }
                    }
                </script>
            </div>
        </div>

    </div>
</x-layout-form-edit>
