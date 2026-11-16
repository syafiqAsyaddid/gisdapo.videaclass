<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Rombel;
use App\Models\Sekolah;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CrudRombelController extends Controller
{
    public function createRombel()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $validator = Validator::make(request()->toArray(), [
            'jurusan_id' => ['required'],
            'kelas_10' => ['numeric', 'nullable'],
            'kelas_11' => ['numeric', 'nullable'],
            'kelas_12' => ['numeric', 'nullable'],
            'kelas_1' => ['numeric', 'nullable'],
            'kelas_2' => ['numeric', 'nullable'],
            'kelas_3' => ['numeric', 'nullable'],
            'kelas_4' => ['numeric', 'nullable'],
            'kelas_5' => ['numeric', 'nullable'],
            'kelas_6' => ['numeric', 'nullable'],
            'kelas_7' => ['numeric', 'nullable'],
            'kelas_8' => ['numeric', 'nullable'],
            'kelas_9' => ['numeric', 'nullable']
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator, 'input')->withInput();
        };

        $attributes = $validator->validated();

        if (!Jurusan::where(strtolower('nama_jurusan'), strtolower($attributes['jurusan_id']))->first()) {
            Jurusan::create([
                'nama_jurusan' => ucwords($attributes['jurusan_id'])
            ]);
        }

        $attributes['jurusan_id'] = Jurusan::where(strtolower('nama_jurusan'), strtolower($attributes['jurusan_id']))->first()->id;

        if (Rombel::where('sekolah_id', $sekolah->id)->where('jurusan_id', $attributes['jurusan_id'])->first()) {
            throw ValidationException::withMessages([
                'jurusan_id' => 'Data already exists, please use delete or edit to the data that already exist'
            ]);
        };

        $attributes['sekolah_id'] = $sekolah->id;

        $rombel = Rombel::create($attributes);
        Siswa::create([
            'rombel_id' => $rombel->id,
            'sekolah_id' => $sekolah->id
        ]);

        $jam = $sekolah->jam->load(['mapel'])->all();

        $rombel = $sekolah->rombel;

        foreach ($jam as $jams) {

            if (isset($jams->mapel->jurusan_id)) {

                $total =
                    $jams->jam_kelas_x * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_10') +
                    $jams->jam_kelas_xi * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_11') +
                    $jams->jam_kelas_xii * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_12') +
                    ($jams->jam_kelas_1 ?? 0) * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_1') +
                    ($jams->jam_kelas_2 ?? 0) * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_2') +
                    ($jams->jam_kelas_3 ?? 0) * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_3') +
                    ($jams->jam_kelas_4 ?? 0) * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_4') +
                    ($jams->jam_kelas_5 ?? 0) * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_5') +
                    ($jams->jam_kelas_6 ?? 0) * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_6') +
                    ($jams->jam_kelas_7 ?? 0) * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_7') +
                    ($jams->jam_kelas_8 ?? 0) * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_8') +
                    ($jams->jam_kelas_9 ?? 0) * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_9');
            } else {

                $total =
                    $jams->jam_kelas_x * $rombel->sum('kelas_10') +
                    $jams->jam_kelas_xi * $rombel->sum('kelas_11') +
                    $jams->jam_kelas_xii * $rombel->sum('kelas_12') +
                    ($jams->jam_kelas_1 ?? 0) * $rombel->sum('kelas_1') +
                    ($jams->jam_kelas_2 ?? 0) * $rombel->sum('kelas_2') +
                    ($jams->jam_kelas_3 ?? 0) * $rombel->sum('kelas_3') +
                    ($jams->jam_kelas_4 ?? 0) * $rombel->sum('kelas_4') +
                    ($jams->jam_kelas_5 ?? 0) * $rombel->sum('kelas_5') +
                    ($jams->jam_kelas_6 ?? 0) * $rombel->sum('kelas_6') +
                    ($jams->jam_kelas_7 ?? 0) * $rombel->sum('kelas_7') +
                    ($jams->jam_kelas_8 ?? 0) * $rombel->sum('kelas_8') +
                    ($jams->jam_kelas_9 ?? 0) * $rombel->sum('kelas_9');
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
        return redirect("/sekolah/rombel");
    }

    public function updateRombel()
    {


        $validator = Validator::make(request()->toArray(), [
            'jurusan_id' => ['required'],
            'kelas_10' => ['numeric', 'nullable'],
            'kelas_11' => ['numeric', 'nullable'],
            'kelas_12' => ['numeric', 'nullable'],
            'kelas_1' => ['numeric', 'nullable'],
            'kelas_2' => ['numeric', 'nullable'],
            'kelas_3' => ['numeric', 'nullable'],
            'kelas_4' => ['numeric', 'nullable'],
            'kelas_5' => ['numeric', 'nullable'],
            'kelas_6' => ['numeric', 'nullable'],
            'kelas_7' => ['numeric', 'nullable'],
            'kelas_8' => ['numeric', 'nullable'],
            'kelas_9' => ['numeric', 'nullable']
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator, 'edit')->withInput();
        };

        $attributes = $validator->validated();
        $id = $attributes['id'];
        unset($attributes['id']);

        Rombel::find($id)->update($attributes);

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);
        $jam = $sekolah->jam->all();
        $rombel = $sekolah->rombel;

        foreach ($jam as $jams) {

            if (isset($jams->mapel->jurusan_id)) {

                $total =
                    $jams->jam_kelas_x * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_10') +
                    $jams->jam_kelas_xi * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_11') +
                    $jams->jam_kelas_xii * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_12');
            } else {

                $total =
                    $jams->jam_kelas_x * $rombel->sum('kelas_10') +
                    $jams->jam_kelas_xi * $rombel->sum('kelas_11') +
                    $jams->jam_kelas_xii * $rombel->sum('kelas_12');
            }

            $jams->update([
                'total_jam' => $total
            ]);

            $tk = $jams->tingkat_kebutuhan;

            $quota = ceil($total / 30);

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

        return redirect()->back();
    }

    public function deleteRombel(Rombel $rombel)
    {

        Siswa::where('rombel_id', $rombel->id)->delete();

        $rombel->delete();

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);
        $jam = $sekolah->jam->all();
        $rombel = $sekolah->rombel;

        foreach ($jam as $jams) {

            if (isset($jams->mapel->jurusan_id)) {

                $total =
                    $jams->jam_kelas_x * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_10') +
                    $jams->jam_kelas_xi * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_11') +
                    $jams->jam_kelas_xii * $rombel->where('jurusan_id', $jams->mapel->jurusan_id)->sum('kelas_12');
            } else {

                $total =
                    $jams->jam_kelas_x * $rombel->sum('kelas_10') +
                    $jams->jam_kelas_xi * $rombel->sum('kelas_11') +
                    $jams->jam_kelas_xii * $rombel->sum('kelas_12');
            }

            $jams->update([
                'total_jam' => $total
            ]);

            $tk = $jams->tingkat_kebutuhan;

            $quota = ceil($total / 30);

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


        return redirect()->back();
    }

    public function updateSiswa()
    {
        $validator = Validator::make(request()->toArray(), [
            'id' => ['required', Rule::exists('siswa', 'id')],
            'kelas_10' => 'numeric|nullable',
            'kelas_11' => 'numeric|nullable',
            'kelas_12' => 'numeric|nullable',
            'kelas_1' => 'numeric|nullable',
            'kelas_2' => 'numeric|nullable',
            'kelas_3' => 'numeric|nullable',
            'kelas_4' => 'numeric|nullable',
            'kelas_5' => 'numeric|nullable',
            'kelas_6' => 'numeric|nullable',
            'kelas_7' => 'numeric|nullable',
            'kelas_8' => 'numeric|nullable',
            'kelas_9' => 'numeric|nullable'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator, 'edit')->withInput();
        }

        $attributes = $validator->validated();

        $id = $attributes['id'];
        unset($attributes['id']);

        Siswa::find($id)->update($attributes);

        return redirect()->back();
    }
}
