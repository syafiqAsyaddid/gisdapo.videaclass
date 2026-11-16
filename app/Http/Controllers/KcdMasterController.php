<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use App\Models\KategoriSekolah;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KcdMasterController extends Controller
{
    public function indexKecamatan()
    {
        $data = Kecamatan::orderBy('is_active', 'desc')->orderBy('nama_kecamatan', 'asc')->get();
        $title = "Wilayah Kerja (Kecamatan)";
        $type = "kecamatan";
        $profil = \App\Models\ProfilLembaga::first();
        return view('kcd.master-index', compact('data', 'title', 'type', 'profil'));
    }

    public function syncKecamatan()
    {
        $profil = \App\Models\ProfilLembaga::first();
        if (!$profil || !$profil->city_id) {
            return redirect()->back()->with('error', 'Silakan pilih Kota/Kabupaten di Profil Lembaga terlebih dahulu.');
        }

        try {
            $response = \Illuminate\Support\Facades\Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$profil->city_id}.json");
            
            if ($response->successful()) {
                $districts = $response->json();
                $validCodes = [];

                foreach ($districts as $district) {
                    // Use updateOrCreate with city_id and nama_kecamatan (or kode_wilayah) to avoid merging across cities
                    $item = Kecamatan::updateOrCreate(
                        [
                            'kode_wilayah' => $district['id'] // Match by unique code from API is safest
                        ], 
                        [
                            'nama_kecamatan' => $district['name'],
                            'city_id' => $profil->city_id,
                            'is_active' => true
                        ]
                    );
                    $validCodes[] = $district['id'];
                }

                // Soft Deactivate districts not belonging to this city (including legacy rows where city_id is NULL)
                // Instead of deleting, just set is_active = false so links are preserved
                Kecamatan::where(function($q) use ($profil) {
                    $q->where('city_id', '!=', $profil->city_id)
                      ->orWhereNull('city_id');
                })->update(['is_active' => false]);
                
                // Soft Deactivate districts in this city that are not in the valid codes list
                Kecamatan::where('city_id', $profil->city_id)->whereNotIn('kode_wilayah', $validCodes)->update(['is_active' => false]);

                return redirect()->back()->with('success', 'Data kecamatan berhasil disinkronisasi. Kecamatan lama dinonaktifkan (tidak dihapus) untuk menjaga data sekolah.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('error', 'Gagal mengambil data dari API.');
    }

    public function toggleKecamatan($id)
    {
        $item = Kecamatan::findOrFail($id);
        $item->is_active = !$item->is_active;
        $item->save();
        return redirect()->back()->with('success', 'Status kecamatan berhasil diubah.');
    }

    // --- Jenjang Pendidikan ---
    public function indexJenjang()
    {
        $data = Jenjang::all();
        $title = "Jenjang Pendidikan";
        $type = "jenjang";
        return view('kcd.master-index', compact('data', 'title', 'type'));
    }

    public function storeJenjang(Request $request)
    {
        $request->validate(['nama_jenjang' => 'required|string']);
        $jenjang = new Jenjang();
        $jenjang->nama_jenjang = $request->nama_jenjang;
        $jenjang->is_active = true;
        $jenjang->save();
        return redirect()->back()->with('success', 'Jenjang berhasil ditambahkan.');
    }

    public function updateJenjang(Request $request, $id)
    {
        $request->validate(['nama_jenjang' => 'required|string']);
        $jenjang = Jenjang::findOrFail($id);
        $jenjang->nama_jenjang = $request->nama_jenjang;
        $jenjang->save();
        return redirect()->back()->with('success', 'Jenjang berhasil diperbarui.');
    }

    public function destroyJenjang($id)
    {
        Jenjang::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Jenjang berhasil dihapus.');
    }

    // --- Kategori Sekolah ---
    public function indexKategori()
    {
        $data = KategoriSekolah::all();
        $title = "Kategori Sekolah";
        $type = "kategori";
        return view('kcd.master-index', compact('data', 'title', 'type'));
    }

    public function storeKategori(Request $request)
    {
        $request->validate(['kategori_sekolah' => 'required|string']);
        $kategori = new KategoriSekolah();
        $kategori->kategori_sekolah = $request->kategori_sekolah;
        $kategori->is_active = true;
        $kategori->save();
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function updateKategori(Request $request, $id)
    {
        $request->validate(['kategori_sekolah' => 'required|string']);
        $kategori = KategoriSekolah::findOrFail($id);
        $kategori->kategori_sekolah = $request->kategori_sekolah;
        $kategori->save();
        return redirect()->back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroyKategori($id)
    {
        KategoriSekolah::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}
