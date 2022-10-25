@if($data -> isEmpty())
<h6 class="text-center">Siswa Belum Memiliki Project</h6>
@else
    @foreach($data as $item)
    <div class="card">
        <div class="card-header">
             {{$item->nama_project}}
        </div>
        <div class="card-body">
            <h5>Tanggal Project</h5>
            {{$item->tanggal}}
            <h5>Deskripsi Project</h5>
            {{$item->deskripsi}}
        </div>
        <div class="card-footer">
            <a href="" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>    
            <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
        </div>
    </div>
    @endforeach
 @endif   