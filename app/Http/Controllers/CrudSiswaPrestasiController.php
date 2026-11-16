<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\SiswaPrestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CrudSiswaPrestasiController extends Controller
{
    public function createSiswaPrestasi(Request $request)
    {


        $sekolah = auth()->user()->sekolah_id;


        $attributes['sekolah_id'] = $sekolah;
        $sekolahnama = Sekolah::where('id', $sekolah)->first();



//        image

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //        image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().'.'.$image->extension();
            $image->move(public_path('images'), $image_name);
            $attributes['image'] = $image_name;
        } else {
             return redirect()->back()->withErrors(['image' => 'Image is required']);
        }

        $form = array(
            'sekolah_id' => $sekolah,
            'siswa_sekolah' => $sekolahnama->nama,
            'siswa_nama' => $request->nama ?? '',
            'siswa_jenkel' => $request->jenkel ?? '',
            'tgl_prestasi' => $request->tgl_prestasi ?? '',
            'siswa_tgl_input' => date('Y-m-d'),
            'siswa_tgl_input' => date('Y-m-d'),
            'jenis' => $request->jenis,
            'tingkat_id' => $request->tingkat_id,
            'event' => $request->event,
            'image' => $image_name,
            'verify' => 0,
        );
        $siswa_prestasi  = SiswaPrestasi::create($form);
//        SiswaPrestasi::create($attributes);

        return redirect()->back();
    }

    public function updateSiswaPrestasi()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);
//
//        $id = $attributes['id'];
//        unset($attributes['id']);

        $attributes['sekolah_id'] = $sekolah->id;

//        SiswaPrestasi::find($id)->update($attributes);

        return redirect()->back();
    }

    public function deleteSiswaPrestasi($id)
    {

        SiswaPrestasi::where('siswa_id',$id)->delete();

        return redirect()->back();
    }
}
