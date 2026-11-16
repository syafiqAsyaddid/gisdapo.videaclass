<table>
    <thead>
    <tr>
        <th colspan="6" style="text-align: center"><b>Data Rombel Sekolah</b></th>
    </tr>
    <tr>
        <th>Sekolah</th>
        <th>Jurusan</th>
        <th>Kelas 10</th>
        <th>Kelas 11</th>
        <th>Kelas 12</th>
        <th>Kelas 13</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        @php
        $sekolah = \App\Models\Sekolah::where('id', $invoice->sekolah_id)->first();
        @endphp
        <tr>
            <td>{{ $sekolah->nama }}</td>

            <td>{{ $invoice->jurusan->nama_jurusan ?? '' }}</td>
            <td>{{ $invoice->kelas_10 }}</td>
            <td>{{ $invoice->kelas_11 }}</td>
            <td>{{ $invoice->kelas_12 }}</td>
            <td>{{ $invoice->kelas_13 }}</td>
        </tr>
    @endforeach
    </tbody>
</table>