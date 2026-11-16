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
                <b>DETAIL SARPRAS</b>
                <h2>
                    {{$sekolah->nama}}
                </h2>
            </td>
        </tr>
        {{-- <tr><td>Nomor:</td></tr> --}}
    </table>
    <table>
        <tr>
            <td>
                <p>
                    Berdasarkan hasil rekaman pendataan sekolah melalui aplikasi Satuan Data Mandiri {{ isset($profil_lembaga) ? $profil_lembaga->nama_lembaga : 'Cadisdik Wilayah 1 Kabupaten Bogor' }}, maka berikut kami lampirkan detail sarana dan prasarana untuk sekolah {{$sekolah->nama}} dengan rincian sebagai berikut :
                </p>
            </td>
        </tr>
    </table>


    <table style="margin-top: 20px">
        <tr>
            <td> Detail Data Sarana & Prasarana Sekolah</td>
        </tr>
    </table>
    <table border="1" style="border-collapse: collapse; width: 100%; margin-top: 10px;">
    <thead>
        <tr style="text-align: center; background-color: #f2f2f2;">
            <th rowspan="2" width="30">No</th>
            <th rowspan="2">Nama Sarpras</th>
            <th rowspan="2">Jenis Sarpras</th>
            <th colspan="3">Kondisi</th>
        </tr>
        <tr style="text-align: center; background-color: #f2f2f2;">
            <th width="80">Rusak Ringan</th>
            <th width="80">Rusak Sedang</th>
            <th width="80">Rusak Berat</th>
        </tr>
    </thead>
    <tbody>
        @php
    $no = 1;
    $total_persentase_berat = 0;
    $jumlah_item_detail = 0;
@endphp

@foreach($data as $value)
    @php $rowCount = count($value->detail_sapras); @endphp
    
    @foreach($value->detail_sapras as $index => $values)
        @php
            $jumlah = $values->jumlah > 0 ? $values->jumlah : 1;
            $p_ringan = ($values->kondisi / $jumlah) * 100;
            $p_sedang = ($values->kondisi_sedang / $jumlah) * 100;
            $p_berat = ($values->kondisi_buruk / $jumlah) * 100;

            $total_persentase_berat += $p_berat;
            $jumlah_item_detail++;
        @endphp
        <tr style="text-align: center">
            @if($index === 0)
                <td rowspan="{{ $rowCount }}">{{ $no++ }}</td>
                <td rowspan="{{ $rowCount }}" style="text-align: left; padding-left: 5px;">{{ $value->nama }}</td>
            @endif
            <td style="text-align: left; padding-left: 5px;">{{ $values->namadetail }}</td>
            <td>{{ round($p_ringan, 2) }}%</td>
            <td>{{ round($p_sedang, 2) }}%</td>
            <td>{{ round($p_berat, 2) }}%</td>
        </tr>
    @endforeach
@endforeach
    </tbody>
</table>



    @php
    // Menghitung rata-rata kerusakan berat
    $grandtotalberat = $jumlah_item_detail > 0 ? ($total_persentase_berat / $jumlah_item_detail) : 0;
    $grandtotalberat = round($grandtotalberat);

    // Penentuan kategori berdasarkan rata-rata
    if ($grandtotalberat <= 0) {
        $kondisi = 'Baik / Tidak Ada Kerusakan';
    } elseif ($grandtotalberat >= 1 && $grandtotalberat <= 30) {
        $kondisi = 'Rusak Ringan';
    } elseif ($grandtotalberat >= 31 && $grandtotalberat <= 70) {
        $kondisi = 'Rusak Sedang';
    } else {
        $kondisi = 'Rusak Berat';
    }
@endphp

<table>
    <tr>
        <td>
            <p>
                Secara keseluruhan dapat diambil kesimpulan bahwa: <br>
                Sarana dan Prasarana <b>{{ $sekolah->nama }}</b> secara rata-rata masuk dalam kategori 
                <b>{{ $kondisi }}</b> dengan persentase tingkat kerusakan berat sebesar 
                <b>{{ $grandtotalberat }}%</b>.
            </p>
        </td>
    </tr>
</table>



    <table>
        <tr>
            <td>
                <p>Demikian Rekomendasi ini dibuat berdasarkan data rekam Aplikasi Satuan data Mandiri {{ isset($profil_lembaga) ? $profil_lembaga->nama_lembaga : 'Cadisdik Wilayah 1 Kabupaten Bogor' }}.</p>
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
