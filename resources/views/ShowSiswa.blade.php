@extends('admin.app')
@section('title','Show Siswa')
@section('conten-title', 'Show Siswa')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            {{-- <div class="card-header">
                <h6 class="font-weight-bold text-primary">Profil</h6>
            </div> --}}
            <div class="card-body text-center">                
                <img src="{{ asset('template/img/'.$data->foto) }}" width="200" class=" img-thumbnail">
                <h4 class="font-weight-bold">{{$data->nama}}</h4> 
                <h5>{{$data->email}}</h5>
                <h5>{{$data->alamat}}</h5>                
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">Biodata</h6>
            </div>
            <div class="card-body">
                <h5>NISN : {{$data->nisn}}</h5>
                <h5>Jenis Kelamin : {{$data->jk}}</H6>            
                <h5>About : {{$data->about}}</h5>
            </div>            
        </div>        
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">Project</h6>
            </div>
            <div class="card-body">
                
            </div>            
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">Kontak</h6>
            </div>
            <div class="card-bodyadw">                
                      @foreach ($kontak as $item)
                          {{$item->deskripsi}}
                      @endforeach                                          
            </div>
        </div>
    </div>                
</div>
@endsection