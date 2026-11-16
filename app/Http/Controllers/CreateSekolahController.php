<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\GuruPrestasi;
use App\Models\Jam;
use App\Models\Mapel;
use App\Models\Ptk;
use App\Models\Rombel;
use App\Models\Sapras;
use App\Models\Sekolah;
use App\Models\SiswaPrestasi;
use App\Models\TingkatKebutuhan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CreateSekolahController extends Controller
{
    public function createPtk()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $attributes = request()->validate([
            'nip' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'telepon' => '',
            'email' => '',
            'status_pegawai_id' => ['required', Rule::exists('status_pegawai', 'id')],
            'pendidikan_id' => ['required', Rule::exists('pendidikan', 'id')],
            'jabatan_id' => ['required', Rule::exists('jabatan', 'id')]
        ]);

        $attributes['sekolah_id'] = $sekolah->id;

        Ptk::create($attributes);

        return redirect("/sekolah/ptk");
    }

    public function createSapras()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $attributes = request()->validate([
            'ruang' => 'required',
            'nama' => 'required',
            'kondisi_baik' => 'numeric',
            'kondisi_sedang' => 'numeric',
            'kondisi_berat' => 'numeric'
        ]);

        $attributes['sekolah_id'] = $sekolah->id;

        Sapras::create($attributes);

        return redirect("/sekolah/sapras");
    }

    public function createRombel()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $attributes = request()->validate([
            'jurusan_id' => ['required', Rule::exists('jurusan', 'id')],
            'kelas_10' => ['numeric', 'nullable'],
            'kelas_11' => ['numeric', 'nullable'],
            'kelas_12' => ['numeric', 'nullable'],
            'kelas_13' => ['numeric', 'nullable']
        ]);

        $attributes['sekolah_id'] = $sekolah->id;

        Rombel::create($attributes);

        $jam = $sekolah->jam->all();

        $rombel = $sekolah->rombel;

        foreach ($jam as $jams) {

            $total =
                $jams->jam_kelas_x * $rombel->sum('kelas_10') +
                $jams->jam_kelas_xi * $rombel->sum('kelas_11') +
                $jams->jam_kelas_xii * $rombel->sum('kelas_12') +
                $jams->jam_kelas_xiii * $rombel->sum('kelas_13');

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

    public function createSiswaPrestasi()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $attributes = request()->validate([
            'nis' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'prestasi_siswa' => 'required',
            'event' => 'required',
            'tanggal_event' => 'required',
            'tingkat_id' => 'required'
        ]);

        $attributes['sekolah_id'] = $sekolah->id;

        SiswaPrestasi::create($attributes);

        return redirect("/sekolah/rombel/siswa-prestasi");
    }

    public function createGuru()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);


        $attributes = request()->validate([
            'nip' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'telepon' => 'nullable',
            'email' => 'nullable',
            'status_pegawai_id' => ['required', Rule::exists('status_pegawai', 'id')],
            'pendidikan_id' => ['required', Rule::exists('pendidikan', 'id')],
            'mapel_id' => ['required', Rule::exists('mapel', 'id')]

        ]);

        $attributes['sekolah_id'] = $sekolah->id;

        $guru = Guru::create($attributes);

        $kebutuhan = [];
        $jam = TingkatKebutuhan::where('jam_id', Jam::where('mapel_id', $guru->mapel_id)->first()->id)->first();

        $tb = $sekolah->guru->where('mapel_id', $attributes['mapel_id'])->count() - $jam->quota;
        $kurang = 0;
        $lebih = 0;
        $tb > 0 ? $lebih = $tb  : $kurang = abs($tb);
        $kebutuhan['lebih'] = $lebih;
        $kebutuhan['kurang'] = $kurang;

        TingkatKebutuhan::find($jam->id)->update($kebutuhan);

        return redirect("/sekolah/guru");
    }

    public function createGuruPrestasi()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $attributes = request()->validate([
            'nip' => ['required', Rule::exists('guru', 'nip')],
            'tingkat_id' => ['required', Rule::exists('tingkat_prestasi', 'id')],
            'prestasi_guru' => 'required'
        ]);
        $id_guru = Guru::where('nip', $attributes['nip'])->without(['status_pegawai', 'mapel', 'pendidikan'])->first();
        $attributes['guru_id'] = $id_guru->id;
        unset($attributes['nip']);
        $attributes['sekolah_id'] = $sekolah->id;

        GuruPrestasi::create($attributes);
    }

    public function createMapel()
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $attributes = request()->validate([
            'nama_mapel' => 'required',
            'jam_kelas_x' => ['numeric', 'nullable'],
            'jam_kelas_xi' => ['numeric', 'nullable'],
            'jam_kelas_xii' => ['numeric', 'nullable'],
            'jam_kelas_xiii' => ['numeric', 'nullable']
        ]);

        $attributes['sekolah_id'] = $sekolah->id;
        $mapel = Mapel::where([[strtolower('nama_mapel'), '=', strtolower($attributes['nama_mapel'])], ['blok', 1]])->first();

        if (!$mapel) {

            Mapel::create([
                'nama_mapel' => ucwords($attributes['nama_mapel']),
                'blok' => 1
            ]);
        }

        $mapel = Mapel::where([[strtolower('nama_mapel'), '=', strtolower($attributes['nama_mapel'])], ['blok', 1]])->first();

        $mapel_id = $mapel->id;
        $attributes['mapel_id'] = $mapel_id;
        $rombel = $sekolah->rombel;
        $total =
            $attributes['jam_kelas_x'] * $rombel->sum('kelas_10') +
            $attributes['jam_kelas_xi'] * $rombel->sum('kelas_11') +
            $attributes['jam_kelas_xii'] * $rombel->sum('kelas_12') +
            $attributes['jam_kelas_xiii'] * $rombel->sum('kelas_13');

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

        return redirect("/sekolah/mapel");
    }

    public function createKeahlian()
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $attributes = request()->validate([
            'nama_mapel' => 'required',
            'jam_kelas_x' => ['numeric', 'nullable'],
            'jam_kelas_xi' => ['numeric', 'nullable'],
            'jam_kelas_xii' => ['numeric', 'nullable'],
            'jam_kelas_xiii' => ['numeric', 'nullable'],
            'jurusan_id' => ['required', 'numeric']
        ]);

        $attributes['sekolah_id'] = $sekolah->id;

        if (!Mapel::where([[strtolower('nama_mapel'), '=', strtolower($attributes['nama_mapel'])], ['blok', 1]])->first()) {

            Mapel::create([
                'nama_mapel' => ucwords($attributes['nama_mapel']),
                'jurusan_id' => $attributes['jurusan_id'],
                'blok' => 2
            ]);
        }
        $mapel_id = Mapel::where(strtolower('nama_mapel'), '=', strtolower($attributes['nama_mapel']))->first();
        $attributes['mapel_id'] = $mapel_id->id;
        unset($attributes['nama_mapel']);
        unset($attributes['jurusan_id']);

        $rombel = $sekolah->rombel;
        $total =
            $attributes['jam_kelas_x'] * $rombel->sum('kelas_10') +
            $attributes['jam_kelas_xi'] * $rombel->sum('kelas_11') +
            $attributes['jam_kelas_xii'] * $rombel->sum('kelas_12') +
            $attributes['jam_kelas_xiii'] * $rombel->sum('kelas_13');

        $attributes['total_jam'] = $total;

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

        return redirect("/sekolah/keahlian");
    }
}
