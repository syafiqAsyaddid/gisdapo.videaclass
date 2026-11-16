<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Rekomendasi</title>
    <style>
        .container {
            width: 19cm;
            margin: auto;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        p {
            text-align: justify;
            text-justify: inter-word;
        }
        .td-number {
            vertical-align: top;
            text-align: center;
            width: 30px;
            padding-top: 5px;
        }
        .td-content {
            vertical-align: top;
            padding-bottom: 20px; /* Jarak antar item sarpras */
        }
        .detail-item {
            margin-left: 20px;
            font-size: 0.9em;
        }
    </style>
</head>

<body>
<div class="container">
    <table>
        <tr>
            <td width="120px">
                @if(isset($profil_lembaga) && $profil_lembaga->logo)
                    <img src="{{ public_path('storage/'.$profil_lembaga->logo) }}" width="110" height="90" alt="logo">
                @else
                    <img src="{{ public_path('images/jabar.png') }}" width="110" height="90" alt="logo">
                @endif
            </td>
            <td align="center">
                <font size="4"><strong>
                    {{ isset($profil_lembaga) && $profil_lembaga->nama_lembaga ? strtoupper($profil_lembaga->nama_lembaga) : 'CABANG DINAS PENDIDIKAN PROVINSI JAWA BARAT WILAYAH 1 KABUPATEN BOGOR' }}
                </strong></font><br>
                <font size="2">
                    {{ $profil_lembaga->alamat ?? 'Jln. H. Mantik No.9, Karadenan, Kec. Cibinong, Kabupaten Bogor.' }}<br>
                    e-mail : {{ $profil_lembaga->email ?? 'info@cadisdikwil1jabar.go.id' }} | Telepon: {{ $profil_lembaga->no_telp ?? '02517508913' }}<br>
                    {{ $profil_lembaga->kota ?? 'Kabupaten Bogor 16913' }}
                </font>
            </td>
        </tr>
        <tr>
            <td colspan="2"><hr></td>
        </tr>
    </table>

    <table style="margin-top: 10px">
        <tr>
            <td align="center">
                <b>DETAIL SARPRAS</b>
                <h2 style="margin: 5px 0;">{{ $sekolah->nama }}</h2>
            </td>
        </tr>
    </table>

    <p>
        Berdasarkan hasil rekaman pendataan sekolah melalui aplikasi Satuan Data Mandiri {{ isset($profil_lembaga) ? $profil_lembaga->nama_lembaga : 'Cadisdik Wilayah 1 Kabupaten Bogor' }}, maka berikut kami lampirkan detail sarana dan prasarana untuk sekolah <b>{{ $sekolah->nama }}</b> dengan rincian sebagai berikut :
    </p>

    <div style="margin-top: 20px; margin-bottom: 10px; font-weight: bold;">Detail Data Sarana & Prasarana Sekolah</div>

    <table>
        @php $no = 1; @endphp
        @foreach($data as $value)
            <tr>
                <td class="td-number">{{ $no++ }}.</td>
                
                <td class="td-content">
                    <strong>{{ $value->nama }}</strong>
                    
                    @if($value->foto)
                        <br>
                        <img src="{{ public_path('foto/'.$value->foto) }}" width="250" style="margin-top: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    @endif

                    <div style="margin-top: 10px;">
                        @foreach($value->parametersekolah as $detail)
                            <div class="detail-item">
                                - {{ $detail->nilai }} {{ $detail->parameters->parameter }}
                            </div>
                        @endforeach
                    </div>
                </td>
            </tr>
        @endforeach
    </table>

    <table style="margin-top: 30px">
        <tr>
            <td>
                <p>Demikian Data Sarana dan Prasarana ini dibuat berdasarkan perekaman Aplikasi Satuan data Mandiri {{ isset($profil_lembaga) ? $profil_lembaga->nama_lembaga : 'Cadisdik Wilayah 1 Kabupaten Bogor' }}.</p>
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
</html>