<?php

namespace App\Http\Controllers;

use App\JawabKuis;
use Illuminate\Http\Request;
use App\Kuis;
use App\SoalKuis;
use App\NilaiKuis;

class KuisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $soal = SoalKuis::where('id_kuis', $id)->get();

        return view('kelas.kuis.detail', compact('soal', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('kelas.kuis.add', compact('id'));
    }

    public function addSoal($id)
    {
        return view('kelas.kuis.soal', compact('id'));
    }

    public function kuis($id)
    {
        $kuis = Kuis::where('id', $id)->first();
        date_default_timezone_set('Asia/Jakarta');
        $now = date("Y-m-d H:i:s");
        $jam_mulai = $kuis->tanggal;
        $jam_akhir = date("Y-m-d H:i:s", strtotime('+15 minutes', strtotime($jam_mulai)));
        if($now < $jam_akhir && $now > $jam_mulai){
            $soal = SoalKuis::where('id_kuis', $id)->get();
            return view('kelas.kuis.jawab', compact('soal', 'id'));  
        }else{
            return redirect()->route('insertLibrary', $kuis->id_kelas)->with('danger', 'Bukan waktunya kuis');
        }
    }

    public function kuisMhs($id_matkul, $id)
    {
        $matkul = MataKuliah_id($id_matkul);

        $nilai = NilaiKuis::where('id_kuis', $id)->get();

        return view('kelas.kuis.dataNilai', compact('matkul', 'nilai', 'id'));

    }

    public function nilai(Request $request, $id)
    {
        $nilai = new NilaiKuis();
        $nilai->id_kuis = $id;
        $nilai->id_mhs = $request->nim;
        $nilai->nilai = $request->nilai;
        $nilai->save();

        $kuis = Kuis::where('id', $id)->first();

        return redirect('nilaiKuis/'.$kuis->id_kelas.'/'.$id)->with('status', 'Kuis berhasil dinilai');
    }

    public function jawabanMhs($id, $nim)
    {
        $soal = SoalKuis::where('id_kuis', $id)->get();
        $jawaban = [];

        foreach ($soal as $item) {
            if(JawabKuis::where('id_soal', $item->id)->where('id_mhs', $nim)->count() != 0){
                $jawab = JawabKuis::where('id_soal', $item->id)->where('id_mhs', $nim)->first();
    
                $jawaban[] = $jawab->jawaban;
            }else{
                $jawaban[] = null;
            }

        }

        return view('kelas.kuis.jawaban', compact('nim', 'jawaban', 'soal', 'nim'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $jadwal = date('Y-m-d H:i', strtotime("$request->tanggal $request->waktu"));

        $tugas = new Kuis;
        $tugas->kuis = $request->kuis;
        $tugas->tanggal = $jadwal;
        $tugas->status = 0;
        $tugas->id_kelas = $id;

        $tugas->save();

        return redirect()->route('insertLibrary', $id)->with('status', 'Kuis berhasil ditambahkan');
    }

    public function storeJawaban(Request $request, $id)
    {
    
        for($i=0; count($request->soal) > $i ; $i++){
            $jwb_kuis = new JawabKuis();

            $jwb_kuis->id_mhs = session('nim');
            $jwb_kuis->id_soal = $request->soal[$i];
            $jwb_kuis->jawaban = $request->jawaban[$i];

            $jwb_kuis->save();
        }

        return redirect()->route('insertLibrary', $id)->with('status', 'Kuis berhasil dijawab');

    }
    
    public function storeSoal(Request $request, $id)
    {

        $soal = new SoalKuis();
        $soal->soal = $request->soal;
        $soal->waktu = $request->waktu;
        $soal->id_kuis = $id;

        $soal->save();

        return redirect('detailKuis/'.$id)->with('status', 'Soal berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $id_kuis)
    {
        $kuis = Kuis::where('id', $id_kuis)->first();

        return view('kelas.kuis.edit', compact('id', 'kuis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSoal($id, $id_soal)
    {
        $soal = SoalKuis::where('id', $id_soal)->first();

        return view('kelas.kuis.editSoal', compact('id', 'soal'));
    }

    public function updateSoal(Request $request, $id, $id_soal)
    {
        SoalKuis::where('id', $id_soal)->update([
            'soal' => $request->soal,
            'waktu' => $request->waktu
        ]);

        return redirect('detailKuis/'.$id)->with('status', 'Soal berhasil diubah');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $id_kuis)
    {
        $jadwal = date('Y-m-d H:i', strtotime("$request->tanggal $request->waktu"));

        Kuis::where('id', $id_kuis)->update([
            'kuis' => $request->kuis,
            'tanggal' => $jadwal
        ]);

        return redirect()->route('insertLibrary', $id)->with('status', 'Kuis berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kuis = Kuis::where('id', $id)->first();
        $id_kelas = $kuis->id_kelas;

        $cek = SoalKuis::where('id_kuis', $id)->get();

        foreach($cek as $x){
            JawabKuis::where('id_soal', $x->id)->delete();
        }

        SoalKuis::where('id_kuis', $id)->delete();
        NilaiKuis::where('id_kuis', $id)->delete();
        Kuis::where('id', $id)->delete();

        return redirect('kelas/' . $id_kelas)->with('status', 'Kuis berhasil dihapus');
    }

    public function destroySoal($id)
    {
        $soal = SoalKuis::where('id', $id)->first();
        $id_kuis = $soal->id_kuis;

        JawabKuis::where('id_soal', $soal->id)->delete();
        SoalKuis::where('id', $id)->delete();
        // Kuis::where('id', $id)->delete();

        return redirect('detailKuis/' . $id_kuis)->with('status', 'Soal berhasil dihapus');
    }
}
