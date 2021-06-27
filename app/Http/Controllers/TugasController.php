<?php

namespace App\Http\Controllers;

use App\TipeTugas;
use App\Tugas;
use App\JawabTugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $tipe_tugas = TipeTugas::all();

        return view('kelas.addTugas', compact('tipe_tugas', 'id'));
    }

    public function jawaban($id_matkul, $id_tugas)
    {
        $matkul = MataKuliah_id($id_matkul);
        $jawaban = JawabTugas::where('id_tugas', $id_tugas)->get();

        return view('kelas.jawaban', compact('jawaban', 'matkul', 'id_matkul', 'id_tugas'));
    }

    public function nilai(Request $request, $id_matkul, $id_tugas)
    {
        JawabTugas::where('id', $request->id)
        ->update([
            'nilai' => $request->nilai,
        ]);

        return redirect('/detailJawab/'.$id_matkul.'/'.$id_tugas)->with('status', 'Tugas berhasil dinilai');
    }

    public function editTugas($id)
    {
        $tipe_tugas = TipeTugas::all();

        $tugas = Tugas::where('id', $id)->first();
        
        return view('kelas.editTugas', compact('tipe_tugas', 'tugas'));
    }
    
    public function editTugasP(Request $request, $id)
    {
        $tugas = Tugas::where('id', $id)->first();
        
        if($request->cek == true){
            unlink(public_path('tugas/' . $tugas->file));

            $file = $request->file;
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'tugas';
            $file->move($tujuan_upload, $nama_file);

            $deadline = date('Y-m-d H:i', strtotime("$request->tanggal $request->waktu"));

            Tugas::where('id', $id)->update([
                'judul' => $request->tugas,
                'tipe_tugas' => $request->tipe,
                'file' => $nama_file,
                'deadline' => $deadline
            ]);
        }else{
            $deadline = date('Y-m-d H:i', strtotime("$request->tanggal $request->waktu"));

            Tugas::where('id', $id)->update([
                'judul' => $request->tugas,
                'tipe_tugas' => $request->tipe,
                'deadline' => $deadline
            ]);
        }

        return redirect()->route('insertLibrary', $tugas->id_kelas)->with('status', 'Tugas berhasil diedit');
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
    public function store(Request $request, $id)
    {
        $file = $request->file;
        $nama_file = time() . "_" . $file->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'tugas';
        $file->move($tujuan_upload, $nama_file);

        $deadline = date('Y-m-d H:i', strtotime("$request->tanggal $request->waktu"));

        $tugas = new Tugas;
        $tugas->judul = $request->tugas;
        $tugas->tipe_tugas = $request->tipe;
        $tugas->file = $nama_file;
        $tugas->deadline = $deadline;
        $tugas->id_kelas = $id;

        $tugas->save();

        return redirect()->route('insertLibrary', $id)->with('status', 'Tugas berhasil ditambahkan');
    }

    public function turnIn(Request $request)
    {
        $tugas = Tugas::where('id', $request->id)->first();
        $id_tugas = $tugas->id;

        $file = $request->file;
        $nama_file = time() . "_" . $file->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'jawab_tugas';
        $file->move($tujuan_upload, $nama_file);

        $jawab = new JawabTugas;
        $jawab->id_tugas = $id_tugas;
        $jawab->id_mhs = session('nim');
        $jawab->file = $nama_file;

        $jawab->save();

        return redirect()->route('insertLibrary', $tugas->id_kelas)->with('status', 'Jawaban berhasil dikirim');
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
        $tugas = Tugas::where('id', $id)->first();

        $id_kelas = $tugas->id_kelas;
        unlink(public_path('tugas/' . $tugas->file));

        $jawaban = JawabTugas::where('id_tugas', $id)->get();

        foreach ($jawaban as $item) {
            unlink(public_path('jawab_tugas/' . $item->file));

            JawabTugas::where('id', $item->id)->delete();
        }

        Tugas::where('id', $id)->delete();

        return redirect('kelas/' . $id_kelas)->with('status', 'Tugas berhasil dihapus');
    }
}
