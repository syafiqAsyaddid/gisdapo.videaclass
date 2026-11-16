<html>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Surat Rekomendasi</title>
    <style>
        .container{
            width: 19cm;
            margin: auto;
            padding: 10px;
        }
        table{
            width: 90%;

        }
        p {
            text-align: justify;
            text-justify: inter-word;
            margin-right: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
    <table>
        <tr>
            <td width="75px">
                @if(isset($profil_lembaga) && $profil_lembaga->logo)
                    <img src="{{ public_path('storage/'.$profil_lembaga->logo) }}" width="120" height="100" alt="logo">
                @else
                    <img src="{{ public_path('images/jabar.png') }}" width="120" height="100" alt="logo">
                @endif
            </td>
            <td>
                <center>
                    <font size="4"><strong>
                        @if(isset($profil_lembaga) && $profil_lembaga->nama_lembaga)
                            {{ strtoupper($profil_lembaga->nama_lembaga) }}
                        @else
                            CABANG DINAS PENDIDIKAN PROVINSI JAWA BARAT WILAYAH 1 KABUPATEN BOGOR
                        @endif
                    </strong></font><br>
                    
                    <font size="2">
                        @if(isset($profil_lembaga) && $profil_lembaga->alamat)
                            {{ $profil_lembaga->alamat }}
                        @else
                            Jln. H. Mantik No.9, Karadenan, Kec. Cibinong, Kabupaten Bogor.
                        @endif
                    </font><br>
                    <font size="2">
                        @if(isset($profil_lembaga))
                           e-mail : {{ $profil_lembaga->email ?? 'info@cadisdikwil1jabar.go.id' }} | Telepon: {{ $profil_lembaga->no_telp ?? '02517508913' }}
                        @else
                           e-mail : info@cadisdikwil1jabar.go.id | Telepon: 02517508913
                        @endif
                    </font><br>
                    <font size="2">{{ isset($profil_lembaga) && $profil_lembaga->kota ? $profil_lembaga->kota : 'Kabupaten Bogor 16913' }}</font><br>
                </center>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td align="center">
                <b>SURAT REKOMENDASI</b>
            </td>
        </tr>
        {{-- <tr><td>Nomor:</td></tr> --}}
    </table>
    <table>
        <tr>
            <td>
                <p>
                    Berdasarkan hasil rekaman pendataan sekolah melalui aplikasi Satuan Data Mandiri {{ isset($profil_lembaga) ? $profil_lembaga->nama_lembaga : 'Cadisdik Wilayah 1 Kabupaten Bogor' }}, maka berikut kami lampirkan rekomendasi untuk sekolah {{ $sekolah->nama }} dengan rincian sebagai berikut :
                </p>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>1.Data Pendidik Mapel Umum</td>
        </tr>
    </table>
    <table border="1" style="border-collapse: collapse;">
        <tr>
            <td>No</td>
            <td>Mata Pelajaran</td>
            <td>Jumlah Guru</td>
            <td>Kebutuhan</td>
            <td>Rekomendasi</td>
        </tr>
        @if ($jam->where('mapel.blok', 1)->isEmpty())
            <tr>
                <td colspan="5">TIDAK ADA DATA</td>
            </tr>
        @else
        <?php $no = 1; ?>
        @foreach ( $jam->where('mapel.blok', 1) as $tampil )
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $tampil->mapel->nama_mapel }}</td>
                <td>{{ $guru = $tampil->mapel->guru->count() }}</td>
                <td>{{ $quota = $tampil->tingkat_kebutuhan->quota }}</td>
                <td>@php
                    switch ($guru) {

                        case $guru < $quota:
                            echo 'Ditambah'; 
                            break;

                        case $guru > $quota:
                            echo 'Dipindahkan';
                            break;
                        
                        default:
                            echo 'Sesuai kebutuhan';
                            break;
                    }
                @endphp
                </td>
            </tr>
        @endforeach
        @endif
    </table>
    <table>
        <tr>
            <td>2.Data Pendidik Mapel Produktif</td>
        </tr>
    </table>
    <table border="1" style="border-collapse: collapse;">
        <tr>
            <td>No</td>
            <td>Kompetensi Keahlian</td>
            <td>Mata Pelajaran</td>
            <td>Jumlah Guru</td>
            <td>Kebutuhan</td>
            <td>Rekomendasi</td>
        </tr>
        @if ($jam->where('mapel.blok', 2)->isEmpty())
            <tr>
                <td colspan="6">TIDAK ADA DATA</td>
            </tr>
        @else
        <?php $no = 1; ?>
        @foreach ( $jam->where('mapel.blok', 2) as $tampil )
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $tampil->mapel->jurusan->nama_jurusan ?? '-' }}</td>
                <td>{{ $tampil->mapel->nama_mapel }}</td>
                <td>{{ $guru = $tampil->mapel->guru->count() }}</td>
                <td>{{ $quota = $tampil->tingkat_kebutuhan->quota }}</td>
                <td>@php
    
                    switch ($guru) {

                        case $guru < $quota:
                            echo 'Ditambah'; 
                            break;

                        case $guru > $quota:
                            echo 'Dipindahkan';
                            break;
                        
                        default:
                            echo 'Sesuai kebutuhan';
                            break;
                    }
                @endphp
                </td>
            </tr>
        @endforeach
        @endif
    </table>
    {{-- <table>
        <tr>
            <td>
                <b>Keterangan</b>
            </td>
        </tr>
    </table>
    @php
        $kebutuhan = $tingkat_kebutuhan->sum('lebih') - $tingkat_kebutuhan->sum('kurang')? $tingkat_kebutuhan->sum('lebih') - $tingkat_kebutuhan->sum('kurang') : 0;
    @endphp --}}
    {{-- <table>
        <tr>
            <td><input type="checkbox" {{ $kebutuhan > 0? "checked": ""; }}></td>
            <td>Mutasi</td>
        </tr>
        <tr>
            <td><input type="checkbox" {{ $kebutuhan < 0? "checked": ""; }}></td>
            <td>Ditambah</td>
        </tr>
        <tr>
            <td><input type="checkbox" {{ $kebutuhan == 0? "checked": ""; }}></td>
            <td>Tidak Ada</td>
        </tr>
    </table><br> --}}

    {{-- <table>
        <tr>
            <td>3.Data Tenaga Kependidikan</td>
        </tr>
    </table>
    <table border="1" style="border-collapse: collapse;">
        <tr>
            <td>No</td>
            <td>Jumlah</td>
            <td>Kebutuhan</td>
            <td>Rekomendasi</td>
        </tr>
         @if ($guru_prestasi->isEmpty())
            <tr>
                <td colspan="5">TIDAK ADA DATA</td>
            </tr>
        @else
        @foreach ( $guru_prestasi as $tampil )
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $tampil->guru->nama }}</td>
                <td>{{ $tampil->guru->mapel->nama_mapel }}</td>
                <td>{{ $tampil->prestasi_guru }}</td>
                <td>Nama tersebut agar dapat diikutsertakan dalam pendidikan dan pelatihan tingkat selanjutnya.</td>
            </tr>
        @endforeach
        @endif
    </table><br> --}}
    {{-- <table>
        <tr>
            <td>4.Data Tenaga Kependidikan Berprestasi</td>
        </tr>
    </table>
    
    <table border="1" style="border-collapse: collapse;">
        <tr>
            <td>No</td>
            <td>Nama Tenaga Kependidikan</td>
            <td>Tempat Bertugas</td>
            <td>Prestasi</td>
            <td>Rekomendasi</td>
        </tr>
    </table><br> --}}
    <table>
        <tr>
            <td>3.Data Siswa Berprestasi</td>
        </tr>
    </table>
    <table border="1" style="border-collapse: collapse;">
        <tr>
            <td>No</td>
            <td>Nama Siswa / Sekolah</td>
            <td>Jenis Prestasi</td>
            <td>Event</td>
        </tr>
    @if ($siswa_prestasi->isEmpty())
            <tr>
                <td colspan="5">TIDAK ADA DATA</td>
            </tr>
    @else
    <?php $no = 1 ?>
    @foreach ($siswa_prestasi as $tampil )
        // Optimized: Relationship loaded in Controller
        // $jenis = \Illuminate\Support\Facades\DB::table('jenis_prestasi')->where('id', $tampil->jenis)->first();
        @endphp
        <tr>
            <td>{{ $no++ }}</td>
            <td>
                @if(empty($tampil->siswa_nama))
                {{$tampil->siswa_sekolah}}
                @else
                    {{$tampil->siswa_nama}}
                @endif
            </td>
            <td>{{ $tampil->jenises->nama_jenis ?? '-' }}</td>
            <td>{{$tampil->event}}</td>
        </tr>
    @endforeach
    @endif
    </table><br>
    <table>
        <tr>
            <td>4.Data Sarana dan Prasarana</td>
        </tr>
    </table>
    <table border="1" style="border-collapse: collapse;">
        <tr>
            <td>No</td>
            <td>Nama Barang</td>
            <td>Jumlah Kondisi Rusak Berat</td>
            <td>Rekomendasi</td>
        </tr>
    @if ($sapras->isEmpty())
        <tr>
            <td colspan="4">TIDAK ADA DATA</td>
        </tr>
    @else
    <?php $no = 1 ?>
    @foreach ($sapras->where('kondisi_berat', '>', 0) as $tampil )
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $tampil->nama }}</td>
            <td>{{ $tampil->kondisi_berat }}</td>
            <td>Harus di subsidi</td>
        </tr>
    @endforeach
    @endif
    </table><br>
    <table>
        <tr>
            <td>5.Data Siswa Per Rombel Per Kompetensi Keahlian</td>
        </tr>
    </table>
    <table border="1" style="border-collapse: collapse;">
        <tr>
            <td>No</td>
            <td>Kompetensi Keahlian</td>
            <td>Jumlah Siswa</td>
            <td>Jumlah Rombel</td>
            <td>Rekomendasi</td>
        </tr>
        @if ($rombel->isEmpty())
        <tr>
            <td colspan="5">TIDAK ADA DATA</td>
        </tr>
        @else
        <?php $no = 1 ?>
        @foreach ($rombel as $tampil )
            @php
                $siswaFirst = $tampil->siswa->first();
                $total_siswa = 0;
                $total_rombel = 0;
                
                for ($i = 1; $i <= 13; $i++) {
                    $total_siswa += optional($siswaFirst)->{'kelas_' . $i} ?? 0;
                    $total_rombel += $tampil->{'kelas_' . $i} ?? 0;
                }
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $tampil->jurusan->nama_jurusan ?? '-' }}</td>
                <td>{{ $total_siswa }}</td>
                <td>{{ $total_rombel }}</td>
                <td>
                    @if($total_rombel == 0)
                        {!! '<strong><font color="gray">Tidak Ada Rombel</font></strong>' !!}
                    @else
                        @switch(true)
                            @case($total_siswa/$total_rombel <= 5)
                                    {!! 'Rombel di Sekolah Tersebut Selayaknya <strong><font color="red">DITUTUP</font></strong>' !!}
                                @break
                            @case($total_siswa/$total_rombel <= 10)
                                    {!! 'Rombel Tersebut Harus di <strong><font color="red">MERGER</font></strong>' !!}
                                @break
                            @case($total_siswa/$total_rombel <= 20)
                                    {!! 'Sekolah Harus Meningkatkan <strong><font color="red">PROMOSI</font></strong>' !!}
                                @break
                            @case($total_siswa/$total_rombel <= 30)
                                    {!! '<strong><font color="red">PEMBINAAN</font></strong> Oleh Pengawas' !!}
                                @break
                        
                            @default
                                {!! '<strong><font color="red">TAMBAH ROMBEL</font></strong>' !!}
                        @endswitch
                    @endif
                </td>
            </tr>
        @endforeach
        @endif
    </table><br>
    <table>
        <tr>
            <td>
                <p>Demikian Rekomendasi ini dibuat berdasarkan data rekam Aplikasi Satuan data Mandiri {{ isset($profil_lembaga) ? $profil_lembaga->nama_lembaga : 'Cabang Dinas Pendidikan Wilayah 1 Kabupaten Bogor' }}.</p>
            </td>
        </tr>
    </table>
    <table style="margin-top: 50px; border: none;">
        <tr>
            <td width="60%"></td>
            <td align="center">
                <p style="margin-bottom: 60px; text-align: center; margin-right: 0;">
                    Mengetahui,<br>
                    Kepala {{ $sekolah->nama }}
                </p>
                <p style="text-align: center; margin-right: 0;">
                    <strong><u>{{ $sekolah->kepala_sekolah ?? 'Nama Kepala Sekolah' }}</u></strong>
                </p>
            </td>
        </tr>
    </table>
    </div>
</body>
</head>

</html>
