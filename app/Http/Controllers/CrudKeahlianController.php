<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use App\Models\Mapel;
use App\Models\Sekolah;
use App\Models\TingkatKebutuhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CrudKeahlianController extends Controller
{
    public function createKeahlian()
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $validator = Validator(request()->toArray(), [
            'nama_mapel' => 'required',
            'jam_kelas_x' => ['numeric', 'nullable'],
            'jam_kelas_xi' => ['numeric', 'nullable'],
            'jam_kelas_xii' => ['numeric', 'nullable'],
            'jurusan_id' => ['required', 'numeric']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'input')->withInput();
        }

        $attributes = $validator->validated();

        $attributes['sekolah_id'] = $sekolah->id;

        if (!Mapel::where([[strtolower('nama_mapel'), '=', strtolower($attributes['nama_mapel'])], ['jurusan_id', '=', $attributes['jurusan_id']], ['blok', '=', 2]])->first()) {

            $mapel_id = Mapel::create([
                'nama_mapel' => ucwords($attributes['nama_mapel']),
                'jurusan_id' => $attributes['jurusan_id'],
                'blok' => 2
            ]);
        } else {
        }
        $mapel_id = Mapel::where([[strtolower('nama_mapel'), '=', strtolower($attributes['nama_mapel'])], ['jurusan_id', '=', $attributes['jurusan_id']], ['blok', '=', 2]])->first();
        $attributes['mapel_id'] = $mapel_id->id;
        unset($attributes['nama_mapel']);

        $rombel = $sekolah->rombel;

        $total =
            ($attributes['jam_kelas_x'] ? $attributes['jam_kelas_x'] : 0) * $rombel->where('jurusan_id', $attributes['jurusan_id'])->sum('kelas_10') +
            ($attributes['jam_kelas_xi'] ? $attributes['jam_kelas_xi'] : 0) * $rombel->where('jurusan_id', $attributes['jurusan_id'])->sum('kelas_11') +
            ($attributes['jam_kelas_xii'] ? $attributes['jam_kelas_xii'] : 0) * $rombel->where('jurusan_id', $attributes['jurusan_id'])->sum('kelas_12');

        unset($attributes['jurusan_id']);
        $attributes['total_jam'] = $total;

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

        return redirect()->back();
    }

    public function updateKeahlian()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $validator = Validator(request()->toArray(), [
            'nama_mapel' => 'required',
            'jam_kelas_x' => ['numeric', 'nullable'],
            'jam_kelas_xi' => ['numeric', 'nullable'],
            'jam_kelas_xii' => ['numeric', 'nullable'],
            'jurusan_id' => ['required', 'numeric']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'input')->withInput();
        }

        $attributes = $validator->validated();

        $id = $attributes['id'];
        unset($attributes['id']);

        $rombel = $sekolah->rombel;

        $total =
            ($attributes['jam_kelas_x'] ? $attributes['jam_kelas_x'] : 0) * $rombel->where('jurusan_id', $attributes['jurusan_id'])->sum('kelas_10') +
            ($attributes['jam_kelas_xi'] ? $attributes['jam_kelas_xi'] : 0) * $rombel->where('jurusan_id', $attributes['jurusan_id'])->sum('kelas_11') +
            ($attributes['jam_kelas_xii'] ? $attributes['jam_kelas_xii'] : 0) * $rombel->where('jurusan_id', $attributes['jurusan_id'])->sum('kelas_12');

        $attributes['total_jam'] = $total;

        unset($attributes['jurusan_id']);

        Jam::find($id)->update($attributes);

        $kebutuhan = [
            'quota' => ceil($total / 30),
        ];

        $jam = Jam::find($id);

        $tb = $sekolah->guru->where('mapel_id', $jam['mapel_id'])->count() - $kebutuhan['quota'];
        $kurang = 0;
        $lebih = 0;
        $tb > 0 ? $lebih = $tb  : $kurang = abs($tb);
        $kebutuhan['lebih'] = $lebih;
        $kebutuhan['kurang'] = $kurang;

        $jam->tingkat_kebutuhan->first()->update($kebutuhan);

        return redirect()->back();
    }

    public function deleteKeahlian(Jam $jam)
    {

        if ($jam->tingkat_kebutuhan) $jam->tingkat_kebutuhan->delete();

        $jam->delete();

        return redirect()->back();
    }
}
