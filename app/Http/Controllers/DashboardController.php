<?php

namespace App\Http\Controllers;

use App\JawabTugas;
use App\Tugas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_matakuliah = MataKuliah();
        $tot_matkul = tot_matkul();
        $tot_mhs = tot_mhs();
        $tot_dosen = tot_dosen();
        
        $matkul = [];
        $terisi = [];
        $rata2 = [];
        $warna = [];
        
        foreach($data_matakuliah as $item){
            $matkul[] = $item['nama'];
            $terisi[] = $item['terisi'];
            $warna[] = rand_color();
            
            $tot_tugas = Tugas::where('id_kelas', $item['id'])->count();
            
            if($tot_tugas != 0){

                $tugas = Tugas::where('id_kelas', $item['id'])->get();

                foreach($tugas as $tgs)
                {
                    $tot_nilai = 0;
                    
                    $jwb_tugas = JawabTugas::where('id_tugas', $tgs->id)->get();
        
                    foreach ($jwb_tugas as $nilai) {
                        $tot_nilai = $tot_nilai + $nilai->nilai;
                    }
        
                    $hasil = round($tot_nilai/($item['terisi'] * $tot_tugas), 3);
                }
            }else{
                $hasil = 0;
            }

            $rata2[] = $hasil;

        }

        // dd($warna);

        // dd($matkul);

        return view('dashboard', compact('tot_dosen', 'tot_matkul', 'tot_mhs', 'data_matakuliah', 'matkul', 'terisi', 'warna', 'rata2'));
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
