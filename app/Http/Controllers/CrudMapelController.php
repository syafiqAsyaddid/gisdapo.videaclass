<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use App\Models\Mapel;
use App\Models\Sekolah;
use App\Models\TingkatKebutuhan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CrudMapelController extends Controller
{
    public function createMapel()
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $attributes = request()->validate([
            'nama_mapel' => 'required',
            'jam_kelas_x' => ['numeric', 'nullable'],
            'jam_kelas_xi' => ['numeric', 'nullable'],
            'jam_kelas_xii' => ['numeric', 'nullable'],

            'jam_kelas_1' => ['numeric', 'nullable'],
            'jam_kelas_2' => ['numeric', 'nullable'],
            'jam_kelas_3' => ['numeric', 'nullable'],
            'jam_kelas_4' => ['numeric', 'nullable'],
            'jam_kelas_5' => ['numeric', 'nullable'],
            'jam_kelas_6' => ['numeric', 'nullable'],
            'jam_kelas_7' => ['numeric', 'nullable'],
            'jam_kelas_8' => ['numeric', 'nullable'],
            'jam_kelas_9' => ['numeric', 'nullable']
        ]);

        $attributes['sekolah_id'] = $sekolah->id;
        $mapel = Mapel::where([[strtolower('nama_mapel'), '=', strtolower($attributes['nama_mapel'])], ['blok', 1]])->first();

        if (!$mapel) {

            $mapel = Mapel::create([
                'nama_mapel' => ucwords($attributes['nama_mapel']),
                'blok' => 1
            ]);
        }

        $mapel_id = $mapel->id;
        $attributes['mapel_id'] = $mapel_id;
        $rombel = $sekolah->rombel;
        $total =
            ($attributes['jam_kelas_x'] ?? 0) * $rombel->sum('kelas_10') +
            ($attributes['jam_kelas_xi'] ?? 0) * $rombel->sum('kelas_11') +
            ($attributes['jam_kelas_xii'] ?? 0) * $rombel->sum('kelas_12') +

            ($attributes['jam_kelas_1'] ?? 0) * $rombel->sum('kelas_1') +
            ($attributes['jam_kelas_2'] ?? 0) * $rombel->sum('kelas_2') +
            ($attributes['jam_kelas_3'] ?? 0) * $rombel->sum('kelas_3') +
            ($attributes['jam_kelas_4'] ?? 0) * $rombel->sum('kelas_4') +
            ($attributes['jam_kelas_5'] ?? 0) * $rombel->sum('kelas_5') +
            ($attributes['jam_kelas_6'] ?? 0) * $rombel->sum('kelas_6') +
            ($attributes['jam_kelas_7'] ?? 0) * $rombel->sum('kelas_7') +
            ($attributes['jam_kelas_8'] ?? 0) * $rombel->sum('kelas_8') +
            ($attributes['jam_kelas_9'] ?? 0) * $rombel->sum('kelas_9');

        $attributes['total_jam'] = $total;

        unset($attributes['nama_mapel']);
        $jam = Jam::create($attributes);

        $kebutuhan = [
            'quota' => ceil($total / 30),

        ];

        $tb = $sekolah->guru->where('mapel_id', $attributes['mapel_id'])->count() - $kebutuhan['quota'];
        $kurang = 0;
        $lebih = 0;
        $tb > 0 ? $lebih = $tb  : $kurang = abs($tb);
        $kebutuhan['lebih'] = $lebih;
        $kebutuhan['kurang'] = $kurang;
        $kebutuhan['jam_id'] = $jam->id;
        $kebutuhan['sekolah_id'] = $sekolah->id;

        TingkatKebutuhan::create($kebutuhan);

        return redirect()->back();
    }

    public function updateMapel()
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $attributes = request()->validate([
            'id' => ['required', Rule::exists('jam', 'id')],
            'jam_kelas_x' => ['numeric', 'nullable'],
            'jam_kelas_xi' => ['numeric', 'nullable'],
            'jam_kelas_xii' => ['numeric', 'nullable'],

            'jam_kelas_1' => ['numeric', 'nullable'],
            'jam_kelas_2' => ['numeric', 'nullable'],
            'jam_kelas_3' => ['numeric', 'nullable'],
            'jam_kelas_4' => ['numeric', 'nullable'],
            'jam_kelas_5' => ['numeric', 'nullable'],
            'jam_kelas_6' => ['numeric', 'nullable'],
            'jam_kelas_7' => ['numeric', 'nullable'],
            'jam_kelas_8' => ['numeric', 'nullable'],
            'jam_kelas_9' => ['numeric', 'nullable']
        ]);

        $id = $attributes['id'];
        unset($attributes['id']);

        $rombel = $sekolah->rombel;
        $total =
            ($attributes['jam_kelas_x'] ?? 0) * $rombel->sum('kelas_10') +
            ($attributes['jam_kelas_xi'] ?? 0) * $rombel->sum('kelas_11') +
            ($attributes['jam_kelas_xii'] ?? 0) * $rombel->sum('kelas_12') +

            ($attributes['jam_kelas_1'] ?? 0) * $rombel->sum('kelas_1') +
            ($attributes['jam_kelas_2'] ?? 0) * $rombel->sum('kelas_2') +
            ($attributes['jam_kelas_3'] ?? 0) * $rombel->sum('kelas_3') +
            ($attributes['jam_kelas_4'] ?? 0) * $rombel->sum('kelas_4') +
            ($attributes['jam_kelas_5'] ?? 0) * $rombel->sum('kelas_5') +
            ($attributes['jam_kelas_6'] ?? 0) * $rombel->sum('kelas_6') +
            ($attributes['jam_kelas_7'] ?? 0) * $rombel->sum('kelas_7') +
            ($attributes['jam_kelas_8'] ?? 0) * $rombel->sum('kelas_8') +
            ($attributes['jam_kelas_9'] ?? 0) * $rombel->sum('kelas_9');

        $attributes['total_jam'] = $total;

        $sekolah->jam->find($id)->update($attributes);

        $kebutuhan = [
            'quota' => ceil($total / 30),

        ];

        $jam = Jam::find($id);

        $tb = $sekolah->guru->where('mapel_id', $jam->mapel_id)->count() - $kebutuhan['quota'];
        $kurang = 0;
        $lebih = 0;
        $tb > 0 ? $lebih = $tb  : $kurang = abs($tb);
        $kebutuhan['lebih'] = $lebih;
        $kebutuhan['kurang'] = $kurang;
        $kebutuhan['sekolah_id'] = $sekolah->id;

        $jam->tingkat_kebutuhan->first()->update($kebutuhan);

        return redirect()->back();
    }

    public function deleteMapel(Jam $jam)
    {

        $jam->tingkat_kebutuhan->delete();

        $jam->delete();


        return redirect()->back();
    }
}
