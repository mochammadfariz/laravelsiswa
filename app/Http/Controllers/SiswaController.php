<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data_siswa = \App\Siswa::where('nama_depan', 'LIKE', '%' . $request->cari . '%')->get();
        } else {
            $data_siswa = \App\Siswa::all();
        }
        return view('siswa.index', ['data_siswa' => $data_siswa]);
    }

    public function create(Request $request)
    {

        //insert ke table User
        $user = new \App\User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('rahasia');
        $user->remember_token = str_random(60);
        $user->save();

        //insert ke table Siswa
        $request->request->add(['user_id' => $user->id]);
        $siswa = \App\Siswa::create($request->all());
        return redirect('/siswa')->with('sukses', 'Data berhasil di input');
    }

    public function edit($id)
    {
        $siswa = \App\Siswa::find($id);
        return view('siswa/edit', ['siswa' => $siswa]);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $siswa = \App\Siswa::find($id);
        $siswa->update($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses', 'Data berhasil di update');
    }

    public function delete($id)
    {
        $siswa = \App\Siswa::find($id);
        $siswa->delete();
        return redirect('/siswa')->with('sukses', 'Data berhasil di hapus');
    }

    public function profile($id)
    {
        $siswa = \App\Siswa::find($id);
        return view('siswa.profile', ['siswa' => $siswa]);
    }
}
