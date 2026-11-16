<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jabatan;
use App\Models\Jam;
use App\Models\Jenis;
use App\Models\Jurusan;
use App\Models\Mapel;
use App\Models\Pendidikan;
use App\Models\Ptk;
use App\Models\Rombel;
use App\Models\Sapras;
use App\Models\Sekolah;
use App\Models\SiswaPrestasi;
use App\Models\StatusPegawai;
use App\Models\TingkatPrestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SekolahController extends Controller
{

    // Profil

    public function profil()
    {
        Gate::allows('operator_sekolah');

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.profil', [
            'page' => 'profil',
            'data' => $sekolah
        ]);
    }

    public function editProfil()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('operator.edit-profil', [
            'page' => 'edit',
            'data' => $sekolah
        ]);
    }

    // PTK

    public function ptk()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.ptk', [
            'page' => 'ptk',
            'data' => $sekolah->ptk
        ]);
    }

    public function inputPtk()
    {

        return view('operator.input-ptk', [
            'page' => 'input',
            'jabatan' => Jabatan::all(),
            'pendidikan' => Pendidikan::all(),
            'status' => StatusPegawai::all()
        ]);
    }

    public function editPtk(Ptk $ptk)
    {


        return view('operator.edit-ptk', [
            'page' => 'edit',
            'jabatan' => Jabatan::all(),
            'pendidikan' => Pendidikan::all(),
            'status' => StatusPegawai::all(),
            'data' => $ptk
        ]);
    }

    //guru
    public function guru()
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.guru', [
            'page' => 'guru',
            'data' => $sekolah->guru->load(['pendidikan', 'status_pegawai', 'mapel'])
        ]);
    }

    public function inputGuru()
    {
        return view('operator.input-guru', [
            'page' => 'input',
            'mapel' => Mapel::all(),
            'pendidikan' => Pendidikan::all(),
            'status' => StatusPegawai::all()
        ]);
    }

    public function editGuru(Guru $guru)
    {

        return view('operator.edit-guru', [
            'page' => 'edit',
            'mapel' => Mapel::all(),
            'pendidikan' => Pendidikan::all(),
            'status' => StatusPegawai::all(),
            'data' => $guru
        ]);
    }

    //guru prestasi

    public function guruPrestasi()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.guru-prestasi', [
            'page' => 'input',
            'data' => $sekolah->guru_prestasi->load(['tingkat_prestasi', 'guru'])
        ]);
    }

    public function inputGuruPrestasi()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('operator.input-guru-prestasi', [
            'page' => 'input',
            'guru' => $sekolah->guru,
            'tingkat' => TingkatPrestasi::all()
        ]);
    }

    // Tingkat Kebutuhan

    public function tingkatKebutuhan()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.tingkat-kebutuhan', [
            'page' => 'input',
            'mapel' => $sekolah->guru->unique('mapel_id'),
            'guru' => $sekolah->guru->load(['mapel'], ['jam'])
        ]);
    }

    // sapras

    public function sapras()
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.sapras', [
            'page' => 'sapras',
            'data' => $sekolah->sapras
        ]);
    }

    public function inputSapras()
    {

        return view('operator.input-sapras', [
            'page' => 'input'
        ]);
    }
    public function editSapras(Sapras $sapras)
    {

        return view('operator.edit-sapras', [
            'page' => 'edit',
            'data' => $sapras
        ]);
    }

    // rombel

    public function rombel()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.rombel', [
            'page' => 'rombel',
            'data' => $sekolah->rombel->load(['jurusan'])
        ]);
    }

    public function inputRombel()
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('operator.input-rombel', [
            'page' => 'input',
            'jurusan' => Jurusan::whereNotIn('id', $sekolah->rombel->pluck('jurusan_id')->unique())->get()
        ]);
    }

    public function editRombel(Rombel $rombel)
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('operator.edit-rombel', [
            'page' => 'edit',
            'jurusan' => Jurusan::all(),
            'data' => $rombel
        ]);
    }

    // siswa prestasi

    public function siswaPrestasi()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.siswa-prestasi', [
            'page' => 'input',
            'data' => $sekolah->siswa_prestasi->load(['tingkat_prestasi'])
        ]);
    }

    public function inputSiswaPrestasi()
    {
        return view('operator.input-siswa-prestasi', [
            'page' => 'input',
            'tingkat' => TingkatPrestasi::all(),
            'jenis' => Jenis::all()

        ]);
    }
    public function editSiswaPrestasi(SiswaPrestasi $siswa)
    {
        return view('operator.edit-siswa-prestasi', [
            'page' => 'edit',
            'tingkat' => TingkatPrestasi::all(),
            'data' => $siswa
        ]);
    }

    //mapel

    public function mapel()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.mapel', [
            'page' => 'mapel',
            'data' => Jam::all()->load('mapel')->where('mapel.blok', 1),
            'guru' => Guru::where('sekolah_id', $sekolah->id)->get(),
            'rombel' => Rombel::where('sekolah_id', $sekolah->id)->get()
        ]);
    }

    public function inputMapel()
    {
        return view('operator.input-mapel', [
            'page' => 'input',
            'mapel' => Mapel::where('blok', 1)->get()
        ]);
    }

    public function keahlian()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('sekolah.keahlian', [
            'page' => 'mapel',
            'data' => Jam::all()->load('mapel')->where('mapel.blok', 2),
            'guru' => Guru::where('sekolah_id', $sekolah->id)->get(),
            'rombel' => Rombel::where('sekolah_id', $sekolah->id)->get()
        ]);
    }

    public function inputKeahlian()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        return view('operator.input-keahlian', [
            'page' => 'mapel',
            'mapel' => Mapel::where('blok', 2)->get(),
            'jurusan' => Jurusan::whereIn('id', $sekolah->rombel->pluck('jurusan_id')->unique())->get()
        ]);
    }
}
