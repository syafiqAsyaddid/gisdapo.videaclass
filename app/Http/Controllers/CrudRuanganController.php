<?php

namespace App\Http\Controllers;

use App\Models\Detailsarpras;
use App\Models\Ruangan;
use App\Models\Sapras;
use App\Models\Sekolah;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class CrudRuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        error_reporting(0);
        $sekolah = Sekolah::find((int) $id);
        $data = Sapras::orderBy('nama', 'asc')->where('sekolah_id', $id)->get();
        $count = count($data);
//        ddd($count);
        return view('sekolah.sapras', [
            'data' => $data,
            'sekolah' => $sekolah,
            'count' => $count,
            'page' => 'sapras'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $sekolah = Sekolah::find($id);

        return view('form.input-sapras',[
            'sekolah' => $sekolah,
            'page' => 'sapras'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
//        ddd($request);
        $attrributes = $this->validate($request, [
            'nama' => 'required',
            'sekolah_id' => 'required',
            'jenis_sarpras' => 'required',
            'jumlah' => 'required',
            'kondisi' => 'required',
            'kondisi_sedang' => 'required',
            'kondisi_buruk' => 'required'
        ]);

        $attrributes['tahun'] = date('Y');
        $attrributes['bulan'] = date('M');
        Sapras::create($attrributes);
        return redirect('/sekolah/sapras/'.$request->sekolah_id)->with('success', 'Berhasil Menambahkan Data');

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function show($id,$id_sarpras)
    {
        error_reporting(0);
        $sekolah = Sekolah::find($id);
        $sarpras = Sapras::find($id_sarpras);

//        ddd($sarpras->id);

        $detail = DB::table('sarprasdetails')
                            ->where('id_sarpras', $id_sarpras)
                         ->get();



        return view('sekolah.detailsapras',[
            'data' => $detail,
            'sekolah' => $sekolah,
            'page' => 'sapras',
            'sapras' => $sarpras
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Sapras::find($id);
        $sekolah = Sekolah::find($data->sekolah_id);
//        ddd($data);

        return view('form.edit-sapras',[
           'data' => $data,
           'sekolah' => $sekolah,
            'page' => 'sapras'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attrributes = $this->validate($request, [
            'nama' => 'required',
            'jenis_sarpras' => 'required',
            'jumlah' => 'required',
            'kondisi' => 'required',
            'kondisi_sedang' => 'required',
            'kondisi_buruk' => 'required'
        ]);

        $attrributes['tahun'] = date('Y');
        $attrributes['bulan'] = date('M');

        Sapras::where('id', $id)->update($attrributes);
        return back()->with('success', 'Berhasil Mengubah Data');

    }

    public function createdetail($sekolah, $id_sarpras){
        $sekolah = Sekolah::find($sekolah);
        $sarpras = Sapras::find($id_sarpras);

        return view('form.input-detailsapras',[
            'sekolah' => $sekolah,
            'sapras' => $sarpras,
            'page' => 'sapras'
        ]);
    }

    public function  storedetail(Request $request){
//        ddd($request);
        $attrributes = $this->validate($request, [
            'namadetail' => 'required',
            'id_sarpras' => 'required',
            'jumlah' => 'required',
            'kondisi' => 'required',
            'kondisi_sedang' => 'required',
            'kondisi_buruk' => 'required'
        ]);
        Detailsarpras::create($attrributes);
        $sarpras = Sapras::find($request->id_sarpras);

        return redirect('/sekolah/'.$sarpras->sekolah_id.'/sapras/'.$request->id_sarpras.'/detail')->with('success', 'Berhasil Menambahkan Data');

    }
    public function editdetail($id){
        $data = Detailsarpras::find($id);
//        ddd($data);
        $sarpras = Sapras::find($data->id_sarpras);
        $sekolah = Sekolah::find($sarpras->sekolah_id);

        return view('form.edit-detail-sapras',[
           'data' => $data,
           'sarpras' => $sarpras,
           'sekolah' => $sekolah,
           'page' => 'sapras'
        ]);
    }
    public function updatedetail(Request $request, $id){
//        ddd($request);
        $attrributes = $this->validate($request, [
            'namadetail' => 'required',
            'jumlah' => 'required',
            'kondisi' => 'required',
            'kondisi_sedang' => 'required',
            'kondisi_buruk' => 'required'
        ]);
        $attrributes['tahun'] = date('Y');
        $attrributes['bulan'] = date('M');
        Detailsarpras::where('id', $id)->update($attrributes);
        return back()->with('success', 'Berhasil Mengubah Data');
    }

    public function destroydetail($id){
        Detailsarpras::destroy($id);
        return back()->with('success', 'Berhasil Menghapus Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sapras::destroy($id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function detail()
    {
        return view('sekolah.detailsapras',[
            'page' => 'sapras'
        ]);
    }

    // PDF 
    public function pdfsarpras($id)
    {
        ini_set('max_execution_time', 600);
        ini_set('memory_limit', '512M');

        $sekolah = Sekolah::find($id);
        
        // Eager load details
        $subkategori = Sapras::with('detail_sapras')->where('sekolah_id', $id)->get();


        $count = count($subkategori);
        $profil_lembaga = \App\Models\ProfilLembaga::first();
        
        $pdf = PDF::loadView('sekolah.pdfsarpras', [
            'sekolah' => $sekolah,
            'data' => $subkategori,
            'count' => $count,
            'profil_lembaga' => $profil_lembaga
        ]);
        return $pdf->stream('surat-rekomendasi.pdf');
    }

    public function pdfdetailsarpras($id)
    {
        ini_set('max_execution_time', 600);
        ini_set('memory_limit', '512M');
        $sekolah = Sekolah::find($id);
        
        // Eager load details
        $subkategori = Sapras::with('detail_sapras')->where('sekolah_id', $id)->get();

        // Pre-calculation loop removed as View uses direct attributes now for performance.

        $count = count($subkategori);
        
        $profil_lembaga = \App\Models\ProfilLembaga::first();

        $pdf = PDF::loadView('sekolah.pdfsarpras', [
            'sekolah' => $sekolah,
            'data' => $subkategori,
            'count' => $count,
            'profil_lembaga' => $profil_lembaga
        ]);
        return $pdf->stream('surat-rekomendasi-sarpras'.$sekolah->nama.'.pdf');
    }
    public function pdfprofilesarpras($id)
    {
        ini_set('max_execution_time', 600);
        ini_set('memory_limit', '512M');
        $sekolah = Sekolah::find($id);
        $subkategori = Sapras::with('parametersekolah.parameters')->where('sekolah_id', $id)->get();

        $count = count($subkategori);
        
        $profil_lembaga = \App\Models\ProfilLembaga::first();

        $pdf = PDF::loadView('sekolah.pdfparameter', [
            'sekolah' => $sekolah,
            'data' => $subkategori,
            'count' => $count,
            'profil_lembaga' => $profil_lembaga
        ]);
        return $pdf->stream('Profile Sarpras'.$sekolah->nama.'.pdf');

    }
    public function statistik(){

        $sekolah = Sekolah::count();
        $ruangan = Ruangan::count();
        $sarpras = Sapras::count();
        $detail = Detailsarpras::count();

        $sekolah_jumlah = DB::table('sekolah')
            ->leftJoin('jenjang','jenjang.id','=','sekolah.jenjang_id')
//            ->leftJoin('ruangan','ruangan.sekolah_id','=','sekolah.id')
            ->leftJoin('sapras','sapras.sekolah_id','=','sekolah.id')
            ->leftJoin('sarprasdetails','sarprasdetails.id_sarpras','=','sapras.id')
            ->select('jenjang.nama_jenjang',DB::raw('
(sum(if(sarprasdetails.kondisi is null,0,sarprasdetails.kondisi)) / sum(if(jumlah is null,0,jumlah)) * 100) as persen,
(sum(if(sarprasdetails.kondisi_sedang is null,0,sarprasdetails.kondisi_sedang)) / sum(if(jumlah is null,0,jumlah)) * 100) as persensedang,
(sum(if(sarprasdetails.kondisi_buruk is null,0,sarprasdetails.kondisi_buruk)) / sum(if(jumlah is null,0,jumlah)) * 100) as persenburuk

'))
            ->groupBy('jenjang.nama_jenjang')->get();

//        ddd($sekolah_jumlah);

        return view('sekolah.statistik_sarpras',[
            'page' => 'statistik',
            'sekolah' => $sekolah,
            'ruangan' => $ruangan,
            'sarpras' => $sarpras,
            'detail' => $detail,
            'tipe' => $sekolah_jumlah,
        ]);
    }

    public function createRuang(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'ruangan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'input')->withInput();
        }

        Ruangan::create([
            'ruangan' => $request->ruangan,
            'sekolah_id' => auth()->user()->sekolah_id
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Data');
    }

    public function subkategori(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'nama_sub' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'input')->withInput();
        }

        \App\Models\Subkategori::create([
            'nama_sub' => $request->nama_sub
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Data');
    }

    public function parameters(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'parameter' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'input')->withInput();
        }

        \App\Models\Parameter::create([
            'parameter' => $request->parameter
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Data');
    }

    public function updateRuang(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'ruangan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'edit')->withInput();
        }

        Ruangan::where('id', $request->id)->update([
            'ruangan' => $request->ruangan
        ]);

        return redirect()->back()->with('success', 'Berhasil Mengubah Data');
    }

    public function addunit()
    {
        return view('form.input-unit', [
            'units' => \App\Models\Units::all(), 
            'page' => 'ruangan'
        ]);
    }

    public function simpanunit(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'nama_units' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'input')->withInput();
        }

        \App\Models\Units::create([
            'nama_units' => $request->nama_units
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Data');
    }
    
    public function updateunit(Request $request, $id)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'nama_units' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'edit')->withInput();
        }

        \App\Models\Units::find($id)->update([
            'nama_units' => $request->nama_units
        ]);

        return redirect()->back()->with('success', 'Berhasil Mengubah Data');
    }

    public function hapusunit($id)
    {
        \App\Models\Units::destroy($id);
        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }

    public function deletesubkategori($id)
    {
        \App\Models\Subkategori::destroy($id);
        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }

    public function deleteparameter($id)
    {
        \App\Models\Parameter::destroy($id);
        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }

    public function deleteRuang($id)
    {
        Ruangan::destroy($id);
        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }
    
    public function parametersekolah(Request $request) {
         $data = array(
            'ruangan_id' => $request->ruangan_id,
            'parameter' => $request->nama,
            'value' => $request->nilai,
            'sekolah_id' => auth()->user()->sekolah_id,
        );
        try {

            $cek = \App\Models\Parametersekolah::where('ruangan_id', $request->ruangan_id)->where('parameter', $request->nama)->first();
            if ($cek) {
                $cek->update($data);
            } else {
                \App\Models\Parametersekolah::create($data);
            }
             return redirect()->back()->with('success', 'Data berhasil disimpan');
        }catch (\Exception $e) {
             return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editparametersekolah(Request $request, $id){
           return redirect()->back();
    }
    
    public function deleteparametersekolah($id){
         \App\Models\Parametersekolah::destroy($id);
        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }

}
