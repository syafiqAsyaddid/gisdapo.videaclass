<x-layout-kcd :page="$page">
    <style type="text/css">
        .input-href {
            float: right;
        }
    </style>
    <div class="container" id="form-display">
        <h2>PROFIL SEKOLAH</h2>
        <div class="row">
            <div class="col-25">NPSN</div>
            <div class="col-75">{{ $data -> npsn }}</div>
        </div>
        <div class="row">
            <div class="col-25">NSS</div>
            <div class="col-75">{{ $data -> nss }}</div>
        </div>
        <div class="row">
            <div class="col-25">Nama Sekolah</div>
            <div class="col-75">{{ $data -> nama }}</div>
        </div>
        <div class="row">
            <div class="col-25">Alamat</div>
            <div class="col-75">{{ $data -> alamat }}</div>
        </div>
        <div class="row">
            <div class="col-25">Telepon/Fax</div>
            <div class="col-75">{{ $data -> telepon }}</div>
        </div>
        <div class="row">
            <div class="col-25">Email</div>
            <div class="col-75">{{ $data -> email }}</div>
        </div>
        <div class="row">
            <div class="col-25">Total Guru</div>
            <div class="col-75">{{ $data->guru->count() }}</div>
        </div>
        <div class="row">
            <div class="col-25">Total Guru Berprestasi</div>
            <div class="col-75">{{ $data->guru_prestasi->count() }}</div>
        </div>
        <div class="row">
            <div class="col-25">Total PTK</div>
            <div class="col-75">{{ $data->ptk->count() }}</div>
        </div>
        <div class="row">
            <div class="col-25">Total Sarpras</div>
            <div class="col-75"></div>
        </div>
        <div class="row">
            <div class="col-25">Total Rombel</div>
            <div class="col-75"></div>
        </div>
        <a href="../../sekolah" class="input-href">Back</a>
        <a href="/kcd/sekolah/{{ $data->id }}/profil" class="input-href">Detail</a>
    </div>
    </x-layout-sekolah>
