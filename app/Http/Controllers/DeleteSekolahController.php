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

class DeleteSekolahController extends Controller
{
    public function deletePtk(Ptk $ptk)
    {

        $ptk->delete();

        return redirect("/sekolah/ptk");
    }

    public function deleteSiswaPrestasi(SiswaPrestasi $siswa)
    {

        $siswa->delete();

        return redirect("/sekolah/rombel/siswa-prestasi");
    }

    public function deleteGuruPrestasi(GuruPrestasi $guru_prestasi)
    {

        $guru_prestasi->delete();

        return redirect()->back();
    }

    public function deleteSapras(Sapras $sapras)
    {
        $sapras->delete();

        return redirect("/sekolah/sapras");
    }

    public function deleteRombel(Rombel $rombel)
    {

        $rombel->delete();

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);
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


        return redirect("/sekolah/rombel");
    }

    public function deleteGuru(Guru $guru)
    {

        $guru->delete();

        $kebutuhan = [];
        $jam = TingkatKebutuhan::where('jam_id', Jam::where('mapel_id', $guru->mapel_id)->first()->id)->first();

        $tb = Guru::where('mapel_id', $guru->mapel_id)->count() - $jam->quota;
        $kurang = 0;
        $lebih = 0;
        $tb > 0 ? $lebih = $tb  : $kurang = abs($tb);
        $kebutuhan['lebih'] = $lebih;
        $kebutuhan['kurang'] = $kurang;

        TingkatKebutuhan::find($jam->id)->update($kebutuhan);

        return redirect("/sekolah/guru");
    }

    public function deleteMapel(Jam $jam)
    {

        $jam->tingkat_kebutuhan->delete();

        $jam->delete();


        return redirect("/sekolah/mapel");
    }

    public function deleteKeahlian(Jam $jam)
    {

        $jam->delete();

        return redirect("/sekolah/mapel");
    }
}
