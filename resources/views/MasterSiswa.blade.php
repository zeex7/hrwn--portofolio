@extends('admin.app')
@section('title','Master Siswa')
@section('conten-title', 'Master Siswa')
@section('content')
               
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card shawod mb-4">
                <div class="card-header py-3">
                    <a class="btn btn-success" href="{{ route('MasterSiswa.create') }}"><span class="icon text-white-50"><i></i></span>
                        <span class="text">Tambah Data</span></a> 
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>   
                                <th scope="col">No.</th> 
                                <th scope="col">NISN</th>
                                <th scope="col">Nama</th>     
                                <th scope="col">Jenis Kelamin</th> 
                                <th scope="col">Action</th>              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->nisn}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->jk}}</td>
                                <td>
                                <a href="{{ route('MasterSiswa.show' , $item->id) }}" class="btn btn-info btn-circle btn-sm"><i class="fas fa-info-circle"></i></a>
                                <a href="{{ route('MasterSiswa.edit' , $item->id) }}" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('MasterSiswa.hapus' , $item->id) }}" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>                           
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
