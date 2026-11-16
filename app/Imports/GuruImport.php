<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\Jam;
use App\Models\Jurusan;
use App\Models\Mapel;
use App\Models\Pendidikan;
use App\Models\Sekolah;
use App\Models\StatusPegawai;
use App\Models\TingkatKebutuhan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $sekolah = Sekolah::find(auth()->user()->sekolah_id)->first();


            $attributes = [
                'nip' => $row['nip'],
                'nama' => $row['nama'],
                'tempat_lahir' => $row['tempat_lahir'],
                'tanggal_lahir' => $row['tanggal_lahir'],
                'alamat' => $row['alamat'],
                'telepon' => $row['telepon'],
                'email' => $row['email'],
                'status_pegawai_id' => StatusPegawai::where(strtolower('status'), strtolower($row['status']))->first()->id,
                'pendidikan_id' => Pendidikan::where(strtolower('pendidikan'), strtolower($row['pendidikan']))->first()->id,
                'mapel_id' => $row['mapel'],
                'jurusan' => $row['jurusan']

            ];

            if (!Mapel::where(strtolower('nama_mapel'), strtolower($attributes['mapel_id']))->first()) {

                if (!Jurusan::where(strtolower('nama_jurusan'), strtolower($attributes['jurusan']))->first()) {
                    Jurusan::create([
                        'nama_jurusan' => $attributes['jurusan']
                    ]);
                }

                if ($attributes['jurusan']) {
                    Mapel::create([
                        'nama_mapel' => ucwords($attributes['mapel_id']),
                        'blok' => 2,
                        'jurusan_id' => Jurusan::where(strtolower('nama_jurusan'), strtolower($attributes['jurusan']))->first()->id
                    ]);
                } else {
                    Mapel::create([
                        'nama_mapel' => ucwords($attributes['mapel_id']),
                        'blok' => 1
                    ]);
                }
            }

            $attributes['sekolah_id'] = $sekolah->id;
            unset($attributes['jurusan']);
            $attributes['mapel_id'] = Mapel::where(strtolower('nama_mapel'), strtolower($attributes['mapel_id']))->first()->id;

            $guru = $sekolah->guru->where('nip', $attributes['nip'])->first();

            if ($guru) {

                $guru->update($attributes);
            } else {
                $guru = Guru::create($attributes);
            }


            $jam = Jam::where('mapel_id', $guru->mapel_id)->first();

            if (!$jam) {
                $jam = Jam::create([
                    'mapel_id' => $guru->mapel_id,
                    'sekolah_id' => $sekolah->id,
                    'jam_kelas_x' => 0,
                    'jam_kelas_xi' => 0,
                    'jam_kelas_xii' => 0,
                    'jam_kelas_xiii' => 0,
                    'total_jam' => 0
                ]);

                TingkatKebutuhan::create([
                    'sekolah_id' => $sekolah->id,
                    'jam_id' => $jam->id
                ]);
            }

            $kebutuhan = [];
            $tk = TingkatKebutuhan::where('jam_id', Jam::where('mapel_id', $guru->mapel_id)->first()->id)->first();

            $tb = $sekolah->guru->where('mapel_id', $attributes['mapel_id'])->count() - $jam->quota;
            $kurang = 0;
            $lebih = 0;
            $tb > 0 ? $lebih = $tb  : $kurang = abs($tb);
            $kebutuhan['lebih'] = $lebih;
            $kebutuhan['kurang'] = $kurang;

            TingkatKebutuhan::find($tk->id)->update($kebutuhan);
        }
    }
}
