<?php

namespace App\Imports;

use App\Models\Jurusan;
use App\Models\Rombel;
use App\Models\Sekolah;
use App\Models\Siswa;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RombelImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $sekolah = Sekolah::find(auth()->user()->sekolah_id);

            $attributes = [
                'jurusan' => $row['jurusan'],
                'kelas_10' => $row['kelas_10'],
                'kelas_11' => $row['kelas_11'],
                'kelas_12' => $row['kelas_12'],
                'kelas_13' => $row['kelas_13']
            ];

            $attributes['sekolah_id'] = $sekolah->id;

            $jurusan = Jurusan::where(strtolower('nama_jurusan'), '=', strtolower($attributes['jurusan']))->first();

            if (!$jurusan) {

                Jurusan::create([
                    'nama_jurusan' => ucwords($attributes['jurusan'])
                ]);
            }

            $jurusan = Jurusan::where(strtolower('nama_jurusan'), '=', strtolower($attributes['jurusan']))->first();

            unset($attributes['jurusan']);

            $attributes['jurusan_id'] = $jurusan->id;

            if ($id = $sekolah->rombel->where('jurusan_id', $attributes['jurusan_id'])->first()) {

                $id->update($attributes);
            } else {

                $rombel = Rombel::create($attributes);
                Siswa::create([
                    'rombel_id' => $rombel->id,
                    'sekolah_id' => $sekolah->id,
                    'kelas_10' => 0,
                    'kelas_11' => 0,
                    'kelas_12' => 0,
                    'kelas_13' => 0
                ]);
            }

            $jam = $sekolah->jam->all();

            $rombel = $sekolah->rombel;

            foreach ($jam as $jams) {

                if (isset($jams->mapel->jurusan_id)) {

                    $total =
                        $jams->jam_kelas_x * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_10') +
                        $jams->jam_kelas_xi * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_11') +
                        $jams->jam_kelas_xii * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_12') +
                        $jams->jam_kelas_xiii * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_13');
                } else {

                    $total =
                        $jams->jam_kelas_x * $rombel->sum('kelas_10') +
                        $jams->jam_kelas_xi * $rombel->sum('kelas_11') +
                        $jams->jam_kelas_xii * $rombel->sum('kelas_12') +
                        $jams->jam_kelas_xiii * $rombel->sum('kelas_13');
                }

                $jams->update([
                    'total_jam' => $total
                ]);

                $tk = $jams->tingkat_kebutuhan;

                $quota = $total / 30;

                $kebutuhan = [];
                $guru = $sekolah->guru->where('mapel_id', $jams->mapel_id)->count();

                $tb =  $guru - $quota;
                $kurang = 0;
                $lebih = 0;
                $tb > 0 ? $lebih = $tb  : $kurang = abs($tb);
                $kebutuhan['lebih'] = $lebih;
                $kebutuhan['kurang'] = $kurang;
                $kebutuhan['quota'] = $quota;

                $tk->update($kebutuhan);
            }
        }
    }
}
