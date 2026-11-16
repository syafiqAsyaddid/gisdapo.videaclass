<table>
    <thead>
    <tr>
        <th colspan="10" style="text-align: center"><b>Data Guru Sekolah</b></th>
    </tr>
    <tr>
        <th>Sekolah</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Alamat</th>
        <th>Email</th>
        <th>Status Pegawai</th>
        <th>Status Pendidikan</th>
        <th>Mata Pelajaran</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        @php
        $sekolah = \App\Models\Sekolah::where('id', $invoice->sekolah_id)->first();
        @endphp
        <tr>
            <td>{{ $sekolah->nama }}</td>
            <td>{{ $invoice->nip }}</td>
            <td>{{ $invoice->tempat_lahir }}</td>
            <td>{{ $invoice->tanggal_lahir }}</td>
            <td>{{ $invoice->alamat }}</td>
            <td>{{ $invoice->email }}</td>
<td>{{ $invoice->status_pegawai->status }}</td>
<td>{{ $invoice->pendidikan->pendidikan }}</td>
<td>{{ $invoice->mapel->nama_mapel }}</td>
        </tr>
    @endforeach
    </tbody>
</table>