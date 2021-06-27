<?php

function rand_color() {
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}

function tot_matkul()
{
    $qry = '{"query":

      "query{jadwal2(prodi:62,tahunAkademik:33,limit:200){total jadwal{dosenMengajar{mataKuliahTawar{mataKuliahKurikulum{mataKuliah{id nama}}}}hari terisi jamAwal jamAkhir mahasiswa{nim nama}}}}"
    }';

    $curl = curl_init();

    curl_setopt_array($curl, array(

        CURLOPT_URL => "https://api.unira.ac.id/graphql",

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_SSL_VERIFYPEER => false, //disabled SSL

        CURLOPT_ENCODING => "",

        CURLOPT_MAXREDIRS => 10,

        CURLOPT_TIMEOUT => 30,

        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

        CURLOPT_CUSTOMREQUEST => "POST",

        CURLOPT_POSTFIELDS => $qry,

        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),

    ));

    $response = curl_exec($curl);

    $err = curl_error($curl);

    curl_close($curl);

    $data = json_decode($response);

    $data = $data->data->jadwal2->total;

    return $data;
}

function MataKuliah()
{
    $qry = '{"query":

      "query{jadwal2(prodi:62,tahunAkademik:33,limit:200){total jadwal{dosenMengajar{mataKuliahTawar{mataKuliahKurikulum{mataKuliah{id nama}}}}hari terisi jamAwal jamAkhir mahasiswa{nim nama}}}}"
    }';

    $curl = curl_init();

    curl_setopt_array($curl, array(

        CURLOPT_URL => "https://api.unira.ac.id/graphql",

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_SSL_VERIFYPEER => false, //disabled SSL

        CURLOPT_ENCODING => "",

        CURLOPT_MAXREDIRS => 10,

        CURLOPT_TIMEOUT => 30,

        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

        CURLOPT_CUSTOMREQUEST => "POST",

        CURLOPT_POSTFIELDS => $qry,

        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),

    ));

    $response = curl_exec($curl);

    $err = curl_error($curl);

    curl_close($curl);

    $data = json_decode($response);

    $data = $data->data->jadwal2->jadwal;

    // $data_matkul = array();
    // $matkul = array();

    $data_matkul = array();

    foreach ($data as $item) {
        $matkul['id'] = $item->dosenMengajar->mataKuliahTawar->mataKuliahKurikulum->mataKuliah->id;
        $matkul['nama'] = $item->dosenMengajar->mataKuliahTawar->mataKuliahKurikulum->mataKuliah->nama;
        $matkul['hari'] = $item->hari;
        $matkul['terisi'] = $item->terisi;
        $matkul['jamAwal'] = $item->jamAwal;
        $matkul['jamAkhir'] = $item->jamAkhir;
        $matkul['mahasiswa'] = $item->mahasiswa;
        $data_matkul[] = $matkul;
    }

    return $data_matkul;
}

function MataKuliah_id($id)
{
    $qry = '{"query":

      "query{jadwal2(prodi:62,tahunAkademik:33,limit:200){total jadwal{dosenMengajar{mataKuliahTawar{mataKuliahKurikulum{mataKuliah{id nama}}}}hari terisi jamAwal jamAkhir mahasiswa{nim nama}}}}"
    }';

    $curl = curl_init();

    curl_setopt_array($curl, array(

        CURLOPT_URL => "https://api.unira.ac.id/graphql",

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_SSL_VERIFYPEER => false, //disabled SSL

        CURLOPT_ENCODING => "",

        CURLOPT_MAXREDIRS => 10,

        CURLOPT_TIMEOUT => 30,

        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

        CURLOPT_CUSTOMREQUEST => "POST",

        CURLOPT_POSTFIELDS => $qry,

        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),

    ));

    $response = curl_exec($curl);

    $err = curl_error($curl);

    curl_close($curl);

    $data = json_decode($response);

    $data = $data->data->jadwal2->jadwal;

    // $data_matkul = array();
    // $matku = array();

    $data_matkul = array();

    foreach ($data as $item) {
        if ($item->dosenMengajar->mataKuliahTawar->mataKuliahKurikulum->mataKuliah->id == $id) {
            $matkul['id'] = $item->dosenMengajar->mataKuliahTawar->mataKuliahKurikulum->mataKuliah->id;
            $matkul['nama'] = $item->dosenMengajar->mataKuliahTawar->mataKuliahKurikulum->mataKuliah->nama;
            $matkul['hari'] = $item->hari;
            $matkul['terisi'] = $item->terisi;
            $matkul['jamAwal'] = $item->jamAwal;
            $matkul['jamAkhir'] = $item->jamAkhir;
            $matkul['mahasiswa'] = $item->mahasiswa;
            $data_matkul[] = $matkul;
        }
    }

    return $data_matkul;
}

function matkulMhs($nim)
{
    $qry = '{"query":

        "query{krs2(nim:\"'.$nim.'\",tahunAkademik:33){krs{jadwal{dosenMengajar{dosen{nis nama}}}mataKuliahKurikulum{berkelas mataKuliah{id nama}}}}}"
      }';

    $curl = curl_init();

    curl_setopt_array($curl, array(

        CURLOPT_URL => "https://api.unira.ac.id/graphql",

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_SSL_VERIFYPEER => false, //disabled SSL

        CURLOPT_ENCODING => "",

        CURLOPT_MAXREDIRS => 10,

        CURLOPT_TIMEOUT => 30,

        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

        CURLOPT_CUSTOMREQUEST => "POST",

        CURLOPT_POSTFIELDS => $qry,

        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),

    ));

    $response = curl_exec($curl);

    $err = curl_error($curl);

    curl_close($curl);

    $data = json_decode($response);

    $data = $data->data->krs2->krs;

    // $data_matkul = array();
    // $matkul = array();

    $data_matkul = array();

    foreach ($data as $item) {
        $matkul['berkelas'] = $item->mataKuliahKurikulum->berkelas;
        $matkul['id_kelas'] = $item->mataKuliahKurikulum->mataKuliah->id;
        $matkul['nama'] = $item->mataKuliahKurikulum->mataKuliah->nama;
        $data_matkul[] = $matkul;
    }

    return $data_matkul;
}

function mhs_graph()
{

    $qry = '{"query":

      "query{mahasiswa2(prodi:62,limit:500){total mahasiswa{nim nama thumbnail alamat jenisKelamin}}}"
    }';

    $curl = curl_init();

    curl_setopt_array($curl, array(

        CURLOPT_URL => "https://api.unira.ac.id/graphql",

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_SSL_VERIFYPEER => false, //disabled SSL

        CURLOPT_ENCODING => "",

        CURLOPT_MAXREDIRS => 10,

        CURLOPT_TIMEOUT => 30,

        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

        CURLOPT_CUSTOMREQUEST => "POST",

        CURLOPT_POSTFIELDS => $qry,

        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),

    ));

    $response = curl_exec($curl);

    $err = curl_error($curl);

    curl_close($curl);

    $data = json_decode($response);

    $data_mhs = $data->data->mahasiswa2->mahasiswa;

    $data_mahasiswa = [];

    foreach ($data_mhs as $key) {
        if ($key != null) {
            $data_mahasiswa[] = $key;
        }
    }

    return $data_mahasiswa;
}

function tot_mhs()
{

    $qry = '{"query":

      "query{mahasiswa2(prodi:62,limit:500){total mahasiswa{nim nama thumbnail}}}"
    }';

    $curl = curl_init();

    curl_setopt_array($curl, array(

        CURLOPT_URL => "https://api.unira.ac.id/graphql",

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_SSL_VERIFYPEER => false, //disabled SSL

        CURLOPT_ENCODING => "",

        CURLOPT_MAXREDIRS => 10,

        CURLOPT_TIMEOUT => 30,

        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

        CURLOPT_CUSTOMREQUEST => "POST",

        CURLOPT_POSTFIELDS => $qry,

        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),

    ));

    $response = curl_exec($curl);

    $err = curl_error($curl);

    curl_close($curl);

    $data = json_decode($response);

    $data_mhs = $data->data->mahasiswa2->mahasiswa;

    $data_mahasiswa = [];

    foreach ($data_mhs as $key) {
        if ($key != null) {
            $data_mahasiswa[] = $key;
        }
    }

    return count($data_mahasiswa);
}

function dosen_graph()
{

    $qry = '{"query":

      "query{dokar2(prodi:62,limit:500){dokar{nis nama thumbnail alamat ijazahTerakhir}}}"
    }';

    $curl = curl_init();

    curl_setopt_array($curl, array(

        CURLOPT_URL => "https://api.unira.ac.id/graphql",

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_SSL_VERIFYPEER => false, //disabled SSL

        CURLOPT_ENCODING => "",

        CURLOPT_MAXREDIRS => 10,

        CURLOPT_TIMEOUT => 30,

        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

        CURLOPT_CUSTOMREQUEST => "POST",

        CURLOPT_POSTFIELDS => $qry,

        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),

    ));

    $response = curl_exec($curl);

    $err = curl_error($curl);

    curl_close($curl);

    $data = json_decode($response);

    $data_dosen = $data->data->dokar2->dokar;

    return $data_dosen;
}

function tot_dosen()
{

    $qry = '{"query":

      "query{dokar2(prodi:62,limit:500){total dokar{nis nama thumbnail}}}"
    }';

    $curl = curl_init();

    curl_setopt_array($curl, array(

        CURLOPT_URL => "https://api.unira.ac.id/graphql",

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_SSL_VERIFYPEER => false, //disabled SSL

        CURLOPT_ENCODING => "",

        CURLOPT_MAXREDIRS => 10,

        CURLOPT_TIMEOUT => 30,

        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

        CURLOPT_CUSTOMREQUEST => "POST",

        CURLOPT_POSTFIELDS => $qry,

        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),

    ));

    $response = curl_exec($curl);

    $err = curl_error($curl);

    curl_close($curl);

    $data = json_decode($response);

    $data_dosen = $data->data->dokar2->total;

    return $data_dosen;
}

function mhs()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.unira.ac.id/v1/mhs",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
        ),
    ));

    $response = curl_exec($curl);

    $mhs = json_decode($response);
    $mhs = $mhs->data;

    $data_mhs = array();

    foreach ($mhs as $data) {
        $data_mhs[] = $data->attributes;
    }

    return $data_mhs;
}

function dokar()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.unira.ac.id/v1/dokar",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
        ),
    ));

    $response = curl_exec($curl);

    $dokar = json_decode($response);
    $dokar = $dokar->data;

    $data_dokar = array();

    foreach ($dokar as $data) {
        $data_dokar[] = $data->attributes;
    }

    return $data_dokar;
}

function hari($hari)
{
    if ($hari == 2) {
        return "Senin";
    } elseif ($hari == 3) {
        return "Selasa";
    } elseif ($hari == 4) {
        return "Rabu";
    } elseif ($hari == 5) {
        return "Kamis";
    } elseif ($hari == 6) {
        return "Jumat";
    } elseif ($hari == 7) {
        return "Sabtu";
    }
}

function cekAbsensi($id_kelas, $absen, $absen_user)
{
    $tanggal = date("Y-m-d");
    
    
}