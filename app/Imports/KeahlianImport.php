<?php

namespace App\Imports;

use App\Models\Jam;
use App\Models\Jurusan;
use App\Models\Mapel;
use App\Models\Sekolah;
use App\Models\TingkatKebutuhan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KeahlianImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $sekolah = Sekolah::find(auth()->user()->sekolah_id);

            $attributes = [
                'nama_mapel' => $row['mapel'],
                'jam_kelas_x' => $row['jam_kelas_10'],
                'jam_kelas_xi' => $row['jam_kelas_11'],
                'jam_kelas_xii' => $row['jam_kelas_12'],
                'jam_kelas_xiii' => $row['jam_kelas_13']
            ];

            $jurusan = Jurusan::where(strtolower('nama_jurusan'), strtolower($row['jurusan']))->first();

            if (!$jurusan) {
                $jurusan = Jurusan::create([
                    'nama_jurusan' => ucwords($row->jurusan)
                ]);
            }

            $mapel = Mapel::where([[strtolower('nama_mapel'), '=', strtolower($attributes['nama_mapel'])], ['blok', 2], ['jurusan_id', $jurusan->id]])->first();

            if (!$mapel) {

                $mapel = Mapel::create([
                    'nama_mapel' => ucwords($attributes['nama_mapel']),
                    'jurusan_id' => $jurusan->id,
                    'blok' => 2
                ]);
            }

            unset($attributes['nama_mapel']);

            if ($jam = $sekolah->jam->where('mapel_id', $mapel->id)->first()) {

                $rombel = $sekolah->rombel;
                $total =
                    $attributes['jam_kelas_x'] * $rombel->where('jurusan_id', $jurusan->id)->sum('kelas_10') +
                    $attributes['jam_kelas_xi'] * $rombel->where('jurusan_id', $jurusan->id)->sum('kelas_11') +
                    $attributes['jam_kelas_xii'] * $rombel->where('jurusan_id', $jurusan->id)->sum('kelas_12') +
                    $attributes['jam_kelas_xiii'] * $rombel->where('jurusan_id', $jurusan->id)->sum('kelas_13');

                $attributes['total_jam'] = $total;

                unset($attributes['jurusan_id']);

                $jam->update($attributes);

                $kebutuhan = [
                    'quota' => ceil($total / 30),

                ];

                $tb = $sekolah->guru->where('mapel_id', $jam->mapel_id)->count() - $kebutuhan['quota'];
                $kurang = 0;
                $lebih = 0;
                $tb ? $tb : 0;
                $tb > 0 ? $lebih = $tb  : $kurang = abs($tb);
                $kebutuhan['lebih'] = $lebih;
                $kebutuhan['kurang'] = $kurang;
                $kebutuhan['sekolah_id'] = $sekolah->id;

                $jam->tingkat_kebutuhan->first()->update($kebutuhan);
            } else {

                $attributes['sekolah_id'] = $sekolah->id;
                $attributes['mapel_id'] = $mapel->id;
                $rombel = $sekolah->rombel;
                $total =
                    $attributes['jam_kelas_x'] * $rombel->where('jurusan_id', $jurusan->id)->sum('kelas_10') +
                    $attributes['jam_kelas_xi'] * $rombel->where('jurusan_id', $jurusan->id)->sum('kelas_11') +
                    $attributes['jam_kelas_xii'] * $rombel->where('jurusan_id', $jurusan->id)->sum('kelas_12') +
                    $attributes['jam_kelas_xiii'] * $rombel->where('jurusan_id', $jurusan->id)->sum('kelas_13');

                $attributes['total_jam'] = $total;

                unset($attributes['jurusan_id']);

                $jam = Jam::create($attributes);

                $kebutuhan = [
                    'quota' => ceil($total / 30),

                ];

                $tb = $sekolah->guru->where('mapel_id', $jam->mapel_id)->count() - $kebutuhan['quota'];
                $kurang = 0;
                $lebih = 0;
                $tb > 0 ? $lebih = $tb  : $kurang = abs($tb);
                $kebutuhan['lebih'] = $lebih;
                $kebutuhan['kurang'] = $kurang;
                $kebutuhan['jam_id'] = $jam->id;
                $kebutuhan['sekolah_id'] = $sekolah->id;

                TingkatKebutuhan::create($kebutuhan);
            }
        }
    }
}
