@extends('admin.app')
@section('title','Edit Siswa')
@section('conten-title', 'Edit Siswa')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card shawod mb-4">            
            <div class="card-body">
                @if(count ($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" enctype="multipart/form-data" action="{{route('MasterSiswa.update', $data->id)}}">
                    @csrf
                    {{ method_field('PUT') }}                
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" value="{{ $data->nisn}}">  
                    </div>                    
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{$data->nama}}">  
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-select form-control" id="jk" name="jk" value="{{$data->jk}}">  
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{$data->email}}">  
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{$data->alamat}}">  
                    </div>
                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea class="form-control" id="about" name="about" >{{ $data->about }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto Siswa</label>
                        <input type="file" class="form-control-file" id="foto" name="foto" value="{{$data->foto}}">  
                        <img src="{{ asset('/template/img/'.$data->foto)}}" width="300"  class="img-thumbnail">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Simpan" >
                        <a href="{{route('MasterSiswa.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection