@extends('admin.app')
@section('title','Master Project')
@section('conten-title', 'Master Project')
@section('content')
<div class="row">
    <div class="col-lg-5">
      <div class="card shadow mb-4">
          <div class="card-header py-3">
              {{-- <a href="{{ route('project.create') }}" class="btn btn-primary">Create</a> --}}
              Data Siswa
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                              <th>NO</th>
                              <th>Nama Siswa</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($siswa as $item)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $item->nama }}</td>
                                  <td>
                                      <a href="" onclick="show('{{ $item->id }}', event)" class="btn btn-primary btn-circle btn-sm">
                                          <i class="fas fa-eye"></i>
                                      </a>
                                      <a href="{{ route('projects.create')}}" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-plus"></i>
                                      </a>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
    </div>
    <div class="col">
      <div class="card shadow mb-4">
          <div class="card-header py-3">
              Project Siswa
          </div>
          <div class="card-body" id="project">

          </div>
      </div>
    </div>
  </div>
  <script>
    function show(id,e) {
        e.preventDefault();
        $.get('/MasterProject/' + id, function(data) {
            $('#project').html(data);
        })
    }
</script>

@endsection