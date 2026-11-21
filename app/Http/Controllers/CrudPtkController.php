<?php

namespace App\Http\Controllers;

use App\Models\Ptk;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CrudPtkController extends Controller
{
    public function createPtk()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $validator = Validator::make(request()->toArray(),[
            'nip' => ['required', Rule::unique('ptk', 'nip')],
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => 'required',
            'telepon' => 'nullable',
            'email' => 'nullable',
            'status_pegawai_id' => ['required', Rule::exists('status_pegawai', 'id')],
            'pendidikan_id' => ['required', Rule::exists('pendidikan', 'id')],
            'jabatan' => 'required'
            ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator, 'input')->withInput();
        }
    
        $attributes = $validator->validated();

        $attributes['sekolah_id'] = $sekolah->id;

        Ptk::create($attributes);

        \App\Models\VerifikasiData::catat($sekolah->id, 'PTK', 'Penambahan data PTK: ' . $attributes['nama']);

        return redirect()->back();
    }

    public function updatePtk()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $validator = Validator::make(request()->toArray(), [
            'id' => ['required', Rule::exists('ptk', 'id')],
            'nip' => ['required', Rule::unique('ptk', 'nip')->ignore(request()->id)],
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'telepon' => 'nullable',
            'email' => 'nullable',
            'status_pegawai_id' => ['required', Rule::exists('status_pegawai', 'id')],
            'pendidikan_id' => ['required', Rule::exists('pendidikan', 'id')],
            'jabatan' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator, 'edit')->withInput();
        }

        $attributes = $validator->validated();

        $attributes['sekolah_id'] = $sekolah->id;

        $id = $attributes['id'];
        unset($attributes['id']);

        Ptk::find($id)->update($attributes);

        \App\Models\VerifikasiData::catat($sekolah->id, 'PTK', 'Pembaruan data PTK: ' . $attributes['nama']);

        return redirect()->back();
    }

    public function deletePtk(Ptk $ptk)
    {

        $ptk->delete();

        return redirect("/sekolah/ptk");
    }

    public function formatPtk(){
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\PtkFormatExport, 'format_ptk.xlsx');
    }
}
