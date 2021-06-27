<?php

namespace App\Http\Controllers;

use App\JawabTugas;
use App\Tugas;
use App\User;
use PDF;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profil()
    {
        return view('user.profil');
    }

    public function raport($id)
    { 
        $matkul = matkulMhs($id);

        $tugas = Tugas::all();
        $nilai = JawabTugas::where('id_mhs', $id)->get();

        return view('user.raport', compact('matkul', 'tugas', 'nilai', 'id'));
    }

    public function cetakPdf($id)
    {
        $matkul = matkulMhs($id);

        $tugas = Tugas::all();
        $nilai = JawabTugas::where('id_mhs', $id)->get();
    
        $pdf = PDF::loadview('cetak',['matkul'=>$matkul, 'tugas'=>$tugas, 'nilai'=>$nilai, 'id'=>$id])->setPaper('A4','potrait');;
        return $pdf->stream();
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

    public function editProfil()
    {
        return view('user.edit');
    }

    public function editProfilP(Request $request)
    {
        User::where('username',session('data')->username)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
        ]);

        $data = User::where('username', $request->username)->first();

        session(['data' => $data]);
        session(['nama' => $data->nama]);
        session(['alamat' => $data->alamat]);

        return view('user.profil')->with('status','Profil berhasil diubah');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
