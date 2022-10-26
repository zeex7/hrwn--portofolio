<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\siswa;
use App\Models\project;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = project::all();
        $siswa = siswa::all();
        return view('MasterProject', compact('data', 'siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $data = siswa::all($id);
    //     return view('CreateProject', compact ('data'));
    // }
    public function tambah($id)
    {
        $data = siswa::find($id);
        return view('CreateProject', compact ('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages=[
            'required' => ':attribute harus diisi dulu joo',
            'min' => ':attribute minimal :min karakkter ya joo',
            'max' => ':attribute maksimal :max karakter joo ',
            'numeric' =>  'attribute isien angka joo ',
            'mimes' => 'file :attribute harus bertipe jpg,jpeg.png',
            'size' => 'file yang diupload maksimal :size'
        ];

        $this->validate($request,[
            'id_siswa' => 'required',
            'nama_project' => 'required|min:5',
            'tanggal' => 'required',
            'deskripsi' => 'required|min:5',
            'foto' => 'required',
            
        ],$messages);

        //ambil informasi file yang diupload
        $file = $request->file('foto');

        //rename + ambil nama file 
        $nama_file = time()."_".$file->getClientOriginalName();
        
        //proses upload
        $tujuan_upload ='./template/img';
        $file->move($tujuan_upload,$nama_file);

        //proses Insert Database
        project::create([
            'id_siswa' => $request->id_siswa,
            'nama_project' => $request->nama_project,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'foto' => $nama_file,
        ]);

        return redirect('/MasterProject');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = siswa::find($id)->project()->get();
        return view('ShowProject',compact ('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $projects = project::find($id);
        return view('EditProject', compact('projects'));
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
        $messages=[
            'required' => ':attribute harus diisi dulu joo',
            'min' => ':attribute minimal :min karakkter ya joo',
            'max' => ':attribute maksimal :max karakter joo ',
            'numeric' =>  'attribute isien angka joo ',
            'mimes' => 'file :attribute harus bertipe jpg,jpeg.png',
            'size' => 'file yang diupload maksimal :size'
        ];

        $this->validate($request,[
            'nama_project' => 'required|min:5',
            'tanggal' => 'required',
            'deskripsi' => 'required|min:5',
            
        ],$messages);


        if($request->foto !=''){
            //Dengan Ganti Foto

            //1.hapus foto lama 
            $project=project::find($id);
            file::delete('/template/img/'.$project->foto);

            //2.ambil informasi file yang diupload
    $file = $request->file('foto');

    //3.rename + ambil nama file 
    $nama_file = time()."_".$file->getClientOriginalName();
    
    //4.proses upload
    $tujuan_upload ='./template/img';
    $file->move($tujuan_upload,$nama_file);

    //5.menyimpan ke database
            $project=project::find($id);    
            $project->nama_project = $request->nama_project;
            $project->tanggal = $request->tanggal;
            $project->deskripsi = $request->deskripsi;
            $project->foto = $nama_file;
            $project->save();
            return redirect ('MasterProject');

            
        }else{
            //Tanpa Ganti Foto
            $project=project::find($id);
            $project->nama_project = $request->nama_project;
            $project->tanggal = $request->tanggal;
            $project->deskripsi = $request->deskripsi;
            $project->save();
            return redirect ('MasterProject');
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
        $data=Project::find($id)->delete();
        return redirect('MasterProject');
    }
}
