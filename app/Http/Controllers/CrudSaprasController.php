<?php

namespace App\Http\Controllers;

use App\Models\Detailsarpras;
use App\Models\Parameter;
use App\Models\Sapras;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class CrudSaprasController extends Controller
{

    public function createSapras(Request $request)
    {


        $sekolah = Sekolah::find(auth()->user()->sekolah_id);



        $validator = Validator::make(request()->toArray(),[
            'ruangan_id' => 'required|exists:ruangan,id',
            'nama' => 'required',
//            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if($validator->fails()){
            return redirect()->back()->withError($validator, 'input');
        }

        $attributes = $validator->validated();

        $attributes['sekolah_id'] = $sekolah->id;


//        upload foto

       $sarptras = Sapras::create($attributes);
        $foto = request()->file('foto');
        if ($foto){
            $nama_foto = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('foto'), $nama_foto);
            $sarptras->update([
                'foto' => $nama_foto
            ]);
        }

        \App\Models\VerifikasiData::catat($sekolah->id, 'Sarpras', 'Penambahan data Sarpras: ' . $attributes['nama']);

        return redirect()->back();
    }
    public function createSapras_paramter(Request $request)
    {

//        ddd($request->all());
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $data = array(
            'ruangan_id' => $request->ruangan_id,
            'parameter' => $request->nama,
            'value' => $request->nilai,
            'sekolah_id' => auth()->user()->sekolah_id,
        );
        try {

            $cek = Parameter::where('ruangan_id', $request->ruangan_id)->where('parameter', $request->nama)->first();
            if ($cek) {
                $cek->update($data);
            } else {
                Parameter::create($data);
            }
            alert()->success('Berhasil', 'Data Berhasil Disimpan');
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        }catch (\Exception $e) {
            alert()->error('Gagal', 'Data Gagal Disimpan');
            return redirect()->back()->with('error', $e->getMessage());
        }

    }


    public function updateSapras()
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $validator = Validator::make(request()->toArray(),[
            'id' => ['required', Rule::exists('sapras', 'id')->where('sekolah_id', $sekolah->id)],
            'ruangan_id' => 'required|exists:ruangan,id',
            'nama' => 'required',
            'kondisi_baik' => 'numeric|nullable',
            'kondisi_sedang' => 'numeric|nullable',
            'kondisi_berat' => 'numeric|nullable'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator, 'edit');
        }

        $attributes = $validator->validated();
        $id = $attributes['id'];

        \Illuminate\Support\Facades\DB::transaction(function () use ($attributes, $id, $sekolah) {
            // 1. Update tabel sapras (nama barang)
            $sapras = Sapras::find($id);
            $sapras->update([
                'nama' => $attributes['nama'],
                'ruangan_id' => $attributes['ruangan_id'],
                'sekolah_id' => $sekolah->id,
            ]);

            // 2. Update atau buat tabel sarprasdetails (data kerusakan)
            $detail = Detailsarpras::where('id_sarpras', $id)->first();

            $detailData = [
                'kondisi' => $attributes['kondisi_baik'] ?? 0,          // Rusak Ringan
                'kondisi_sedang' => $attributes['kondisi_sedang'] ?? 0,  // Rusak Sedang
                'kondisi_buruk' => $attributes['kondisi_berat'] ?? 0,    // Rusak Berat
            ];

            if ($detail) {
                $detail->update($detailData);
            } else {
                // Jika belum ada detail, buat baru
                $detailData['id_sarpras'] = $id;
                $detailData['jumlah'] = ($detailData['kondisi'] ?? 0) + ($detailData['kondisi_sedang'] ?? 0) + ($detailData['kondisi_buruk'] ?? 0);
                Detailsarpras::create($detailData);
            }
        });

        Alert::success('Berhasil', 'Data Berhasil Disinkronkan!');
        return redirect()->back();
    }

    public function deleteSapras($sapras)
    {


        $detail = Detailsarpras::where('id_sarpras', $sapras)->get();
        foreach ($detail as $item) {
            $item->delete();
        }

        $sapras = Sapras::where('id', $sapras)->first();
        $sapras->delete();

        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->back();
    }
}
