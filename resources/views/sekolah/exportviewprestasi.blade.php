<table>
    <thead>
    <tr>
        <th colspan="10" style="text-align: center"><b>Data Guru Sekolah</b></th>
    </tr>
    <tr>
        <th>Sekolah</th>
        <th>Nama </th>
        <th>Event</th>
        <th>Jenis Prestasi</th>
        <th>Tanggal Prestasi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        @php
        $sekolah = \App\Models\Sekolah::where('id', $invoice->sekolah_id)->first();
        @endphp
        <tr>
            <td>{{ $sekolah->nama }}</td>
            <td>
                @if(empty($invoice->siswa_nama))
                    {{$invoice->siswa_sekolah}}
                    @else
                    {{$invoice->siswa_nama}}
                @endif
            </td>
            <td>{{ $invoice->jenises->nama_jenis ?? '' }}</td>
            <td>{{ $invoice->event }}</td>
            <td>{{ $invoice->tgl_prestasi }}</td>
        </tr>
    @endforeach
    </tbody>
</table>