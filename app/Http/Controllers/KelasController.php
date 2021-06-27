<?php

namespace App\Http\Controllers;

use App\JawabTugas;
use Illuminate\Http\Request;
use App\Library;
use App\Tugas;
use App\TipeLibrary;
use App\Kuis;
use App\NilaiKuis;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session('user')==2){
            $matkul = matkulMhs(session('nim'));
            $data_matakuliah = MataKuliah();
            return view('kelas.index', compact('data_matakuliah', 'matkul'));
        }else{
            $data_matakuliah = MataKuliah();
            return view('kelas.index', compact('data_matakuliah'));
        }

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
        $data_matakuliah = MataKuliah_id($id);
        $jurnal = Library::where('id_kelas', $id)->where('tipe', '1')->get();
        $materi = Library::where('id_kelas', $id)->where('tipe', '2')->get();
        $video = Library::where('id_kelas', $id)->where('tipe', '3')->get();
        $tugas = Tugas::where('id_kelas', $id)->orderBy('created_at', 'DESC')->get();
        $kuis = Kuis::where('id_kelas', $id)->orderBy('created_at', 'DESC')->get();
        $jawaban = JawabTugas::where('id_mhs', session('nim'))->get();

        $data_matkul = $data_matakuliah[0];

        if(session('user') == 2){
            $nilai = [];

            foreach($kuis as $item){
                $data = NilaiKuis::where('id_mhs', session('nim'))->where('id_kuis', $item->id)->first();
                
                if($data != null){
                    $nilai[] = $data->nilai;
                }else{
                    $nilai[] = 0;
                }
            }
            
            return view('kelas.detail', compact('nilai', 'data_matakuliah', 'data_matkul', 'jurnal', 'materi', 'video', 'tugas', 'kuis', 'jawaban', 'id'));
        }

        return view('kelas.detail', compact('data_matakuliah', 'data_matkul', 'jurnal', 'materi', 'video', 'tugas', 'kuis', 'jawaban', 'id'));
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
        
    }
}
