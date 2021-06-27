<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Contracts\Session\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session('cekLogin') && session('user')!=0){
            return redirect('/');
        }else{
            return view('login');
        }
    }

    public function loginAdmin()
    {
        return view('loginadmin');
    }

    public function cekLogin(Request $request)
    {
        $mhs = mhs_graph();
        $dosen = dosen_graph();
        
        foreach($dosen as $cek){
            if($cek->nis == $request->username){
                session(['cekLogin' => true]);
                session(['nim' => $cek->nis]);
                session(['nama' => $cek->nama]);
                session(['alamat' => $cek->alamat]);
                session(['thumbnail' => $cek->thumbnail]);
                session(['user' => 1]);
                return redirect('/');
            }
        }
        
        foreach($mhs as $cek){
            if($cek->nim == $request->username){
                session(['cekLogin' => true]);
                session(['nim' => $cek->nim]);
                session(['nama' => $cek->nama]);
                session(['alamat' => $cek->alamat]);
                session(['thumbnail' => $cek->thumbnail]);
                session(['user' => 2]);
                return redirect('/');
            }
        }

        
        return redirect('login')->with('status', 'NIM atau NIS salah');
        // redirect('login');
    }

    public function cekLoginAdmin(Request $request)
    {
        $userData = array(
            'username' => $request->username,
            'password' => $request->password
        );

        if (Auth::attempt($userData)) {
            $data = User::where('username', $request->username)->first();
            session(['nama' => $data->nama]);
            session(['user' => 0]);
            session(['thumbnail' => null]);
            session(['data' => $data]);
            session(['cekLogin' => true]);
            session(['password' => $request->password]);

            return redirect('/');
        }

        return redirect('admin')->with('status', 'Username atau password salah');
    }

    public function logout()
    {
        // Session:flush();
        session(['cekLogin' => false]);
        session(['nim' => null]);
        session(['nama' => null]);
        session(['thumbnail' => null]);
        if (session('user') == 0) {
            session(['user' => null]);
            return redirect('/admin');
        }else{
            session(['user' => null]);
            return redirect('login');
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
