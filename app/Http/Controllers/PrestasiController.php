<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Prestasi;
use App\Models\Sekolah;
use App\Models\TingkatPrestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sekolah = Sekolah::with('siswa_prestasi')->find(auth()->user()->sekolah_id);

        return view('sekolah.prestasi', [
            'page' => 'prestasi',
            'data' => $sekolah->siswa_prestasi,
            'jenis' => Jenis::all(),
            'tingkat' => TingkatPrestasi::all()
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function show(Prestasi $prestasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestasi $prestasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestasi  $prestasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestasi $prestasi)
    {
        //
    }
}
