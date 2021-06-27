<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library;
use App\TipeLibrary;
use Illuminate\Queue\Jobs\RedisJob;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $tipe = TipeLibrary::all();

        return view('kelas.addLibrary', compact('tipe', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if ($request->tipe != 3) {
            $file = $request->file;
            $nama_file = time() . "_" . $file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'library';
            $file->move($tujuan_upload, $nama_file);

            $library = new Library;
            $library->judul = $request->judul;
            $library->tipe = $request->tipe;
            $library->file = $nama_file;
            $library->id_kelas = $id;

            $library->save();
        } else {
            $library = new Library;
            $library->judul = $request->judul;
            $library->tipe = $request->tipe;
            $library->file = $request->link;
            $library->id_kelas = $id;

            $library->save();
        }

        return redirect()->route('insertLibrary', $id)->with('status', 'Library berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $library = Library::where('id', $id)->first();

        $tipe = TipeLibrary::all();

        return view('kelas.editMateri', compact('tipe', 'library'));
    }

    public function showP(Request $request, $id)
    {
        $library = Library::where('id', $id)->first();

        if($request->cek == true){
            unlink(public_path('library/' . $library->file));

            $file = $request->file;
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'library';
            $file->move($tujuan_upload, $nama_file);

            Library::where('id', $id)->update([
                'file' => $nama_file,
                'judul' => $request->judul,
            ]);
        }else{
            Library::where('id', $id)->update([
                'judul' => $request->judul,
            ]);
        }

        return redirect()->route('insertLibrary', $library->id_kelas)->with('status', 'e-Library berhasil diubah');
    }

    public function video($id)
    {
        $library = Library::where('id', $id)->first();
        
        $tipe = TipeLibrary::all();
        
        return view('kelas.editVideo', compact('tipe', 'library'));
    }
    
    public function videoP(Request $request, $id)
    {
        $library = Library::where('id', $id)->first();
        
        Library::where('id', $id)->update([
            'file' => $request->link,
            'judul' => $request->judul,
        ]);

        return redirect()->route('insertLibrary', $library->id_kelas)->with('status', 'e-Video berhasil diubah');
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
        $library = Library::where('id', $id)->first();

        $id_kelas = $library->id_kelas;

        if ($library->tipe != 3) {
            unlink(public_path('library/' . $library->file));
        }

        Library::where('id', $id)->delete();

        return redirect('kelas/' . $id_kelas)->with('status', 'Library berhasil dihapus');
    }
}
