<x-layout-sekolah :page="$page" :kecamatan="isset($kecamatan)? $kecamatan : ''">
<div class="container" id="form-display">
<div class="header">
    <a href="../guru" class="input-href">Kembali</a>
    <h2>DATA GURU</h2>
</div>
<table border="1" style="border-collapse: collapse;">
    <tr align="center">
        <th rowspan="2">No</th>
        <th rowspan="2">Mata Pelajaran</th>
        <th rowspan="2" nowrap>Jumlah Guru</th>
        <th rowspan="2" nowrap>Jam Ajar</th>
        <th colspan="2">Tingkat Kebutuhan</th>
    </tr>
    <tr align="center">
        <th>Lebih</th>
        <th>Kurang</th>
    </tr>
    @if ($mapel->isEmpty())
        <tr align="center">
            <td colspan="8">KOSONG</td>
        </tr>
    @else
    @php 
        $no =1;
        @endphp
        @foreach ($mapel as $tampil)
        @php $total = 0; @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $tampil->mapel->nama_mapel }}</td>
                <td>{{ $guru->find($tampil->mapel->id)->count() }}</td>
                <td>
                    @foreach ( $guru->find( $tampil->mapel->id) as $jam )
                        @php
                            $total += $jam->jam->total_jam;
                        @endphp
                    @endforeach
                    {{ $total }}
                </td>
                <td></td>
                <td></td>
            </tr>
 
        @endforeach
    @endif
</table>
</div>
</x-layout-sekolah>