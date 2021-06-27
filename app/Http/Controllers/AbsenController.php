<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
use App\DtlAbsen;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $absensi = Absen::where('id_kelas', $id)->get();

        return view('kelas.absen.index', compact('absensi'));
    }
    
    public function detail($id)
    {
        $absen = Absen::where('id', $id)->first();

        $absensi = DtlAbsen::where('id_absensi', $id)->get();

        $data_matakuliah = MataKuliah_id($absen->id_kelas);

        $data_matkul = $data_matakuliah[0];

        $data_mhs = $data_matkul['mahasiswa'];

        return view('kelas.absen.detail', compact('absensi', 'data_mhs'));
    }

    public function absen($id)
    {
        $tanggal = date("Y-m-d");
        $cek = Absen::where('id_kelas', $id)->where('tanggal', $tanggal)->first();

        if($cek){
            $absen = new DtlAbsen();
            $absen->id_absensi = $cek->id;
            $absen->id_user = session('user');
            $absen->level_user = session('user');

            $absen->save();
        }else{
            $buat = new Absen();
            $buat->id_kelas = $id;
            $buat->tanggal = $tanggal;
            $buat->save();

            $absen_baru = Absen::where('id_kelas', $id)->where('tanggal', $tanggal)->first();

            $absen = new DtlAbsen();
            $absen->id_absensi = $absen_baru->id;
            $absen->id_user = session('nim');
            $absen->level_user = session('user');

            $absen->save();
        }

        return redirect('kelas/'.$id)->with('status', 'Anda berhasil melakukan absensi');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
