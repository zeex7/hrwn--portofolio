<ol class="list-group list-group-numbered">

    @foreach($data as $item)
    <li class="list-group-item d-flex justify-content-between align-items-start">
      <div class="ms-2 me-auto">
        <div class="fw-bold" style="font-weight:bold;text-align:left;">{{ $item->nama_project }}</div>
        <div class="card-body">
            <img class="w-50" src="{{ asset('template/img/'.$item->foto) }}">
        </div>
        <span style="text-align: right;">Deskripsi : </span> <span style="text-align: right;"> {{ $item->deskripsi }} </span>
        
        <div style="text-align: left">
            
            <form id="form-delete{{ $item->id }}"
                action="{{ route('MasterProject.destroy', ['MasterProject' => $item->id]) }}"
                method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger mt-2">
                    <i class="fas fa-trash-alt"></i></button>
                    <a class="btn btn-warning mt-2" type="button" href="{{ route('MasterProject.edit',['MasterProject' => $item->id] )}} "><i class="fas fa-edit"></i></a>
            </form>
            
        </div>

      </div>
      <span class="badge bg-primary rounded-pill" style="color: white;">{{ $item->tanggal }}</span>
    </li>
    @endforeach

</ol>