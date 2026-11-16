<table>
    <thead>
    <tr>
        <th colspan="10" style="text-align: center"><b>Data Guru Sekolah</b></th>
    </tr>
    <tr>
        <th>Sekolah</th>
        <th>Nama Unit</th>
        <th>Nama Asset</th>
        <th>Jumlah</th>
        <th>Kondisi Rusak Ringan</th>
        <th>Kondisi Rusak Sedang</th>
        <th>Kondisi Rusak Berat</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)

        <tr>
            <td>{{ $invoice->namas }}</td>
            <td>{{ $invoice->nama }}</td>
            <td>{{ $invoice->namadetail }}</td>
            <td>{{ $invoice->jumlah }}</td>
          <td>
              @php

              $total = $invoice->kondisi /$invoice->jumlah * 100;
              echo round($total, 2).' %';
              @endphp
          </td>
            <td>
                @php

                $total = $invoice->kondisi_sedang /$invoice->jumlah * 100;
                echo round($total, 2).' %';
                @endphp
            </td>
            <td>
                @php

                $total = $invoice->kondisi_buruk /$invoice->jumlah * 100;
                echo round($total, 2).' %';
                @endphp
            </td>
        </tr>
    @endforeach
    </tbody>
</table>