<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use File;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = siswa::all();     
        return view ('MasterSiswa', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('CreateSiswa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $massages=[
            'required'=>':attribute harus di isi dulu',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maksimal :max karakter',
            'numeric' => ':attribute harus di isi angka',
            'mimes' => 'nama file harus jpg,jpeg,png,gif,svg'
        ];

        $this->validate($request, [
            'nisn'=>'required|numeric|min:5',
            'nama'=>'required|min:1|max:20',
            'jk'=>'required',
            'email'=>'required',
            'alamat'=>'required|min:5',
            'about'=>'required|min:5',  
            'foto'=> 'required|mimes:jpg,jpeg,png,gif,svg'          
        ],$massages);

        //ambil informasi yang di upload
        $file = $request->file('foto');

        //rename
        $nama_file = time()."_". $file->getClientOriginalName();

        //proses upload
        $tujuam_upload = './template/img';
        $file->move($tujuam_upload,$nama_file);

        //proses insert database
        Siswa::create([
            'nisn'=>$request->nisn,
            'nama'=>$request->nama,
            'jk'=>$request->jk,
            'email'=>$request->email,
            'alamat'=>$request->alamat,
            'about'=>$request->about,
            'foto'=>$nama_file
        ]);

        return redirect ('/MasterSiswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Siswa::find($id);
        $kontak =$data->kontak;
        return view('ShowSiswa', compact('data','kontak'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= Siswa::find($id);
        return view('EditSiswa', compact('data'));
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
        $massages=[
            'required'=>':attribute harus di isi dulu',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maksimal :max karakter',
            'numeric' => ':attribute harus di isi',
            'mimes' => 'nama file harus jpg,jpeg,png,gif,svg'
        ];

        $this->validate($request, [
            'nisn'=>'required|numeric|min:5',
            'nama'=>'required|min:3|max:20',
            'jk'=>'required',
            'email'=>'required',
            'alamat'=>'required|min:5',
            'about'=>'required|min:5',  
            'foto'=> 'mimes:jpg,jpeg,png,gif,svg'          
        ],$massages);

        if($request->foto !=""){
            //ganti foto

            //hapus foto lama
            $siswa=Siswa::find($id);
            file::delete('/template/img/'.$siswa->foto);

            //ambil informasi yang di upload
            $file = $request->file('foto');

            //rename
            $nama_file = time()."_". $file->getClientOriginalName();

            //proses upload
            $tujuam_upload = './template/img';
            $file->move($tujuam_upload,$nama_file);
            
            //menyimpan ke database
            $siswa->nisn = $request->nisn;
            $siswa->nama = $request->nama;
            $siswa->jk = $request->jk;
            $siswa->email = $request->email;
            $siswa->alamat = $request->alamat;
            $siswa->about = $request->about;
            $siswa->foto = $nama_file;
            $siswa->save();
            return redirect('/MasterSiswa');

            //tanpa ganti foto
        }else{
            $siswa=Siswa::find($id);
            $siswa->nisn = $request->nisn;
            $siswa->nama = $request->nama;
            $siswa->jk = $request->jk;
            $siswa->email = $request->email;
            $siswa->alamat = $request->alamat;
            $siswa->about = $request->about;
            $siswa->save();
            return redirect('/MasterSiswa');
        }
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

    public function hapus($id)
    {
        $data=Siswa::find($id)->delete();
        return redirect('MasterSiswa');
    }
}
