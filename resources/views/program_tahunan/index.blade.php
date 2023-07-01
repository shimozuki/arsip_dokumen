@extends('layouts/app2')
@section('title','Data Program Tahunan Desa')
@section('judul','List Program Tahunan')
@section('content')
<div class="card">
  <div class="card-header">
    <h4>Data Perusahaan</h4>
  </div>
  <div class="card-body">
    @if (auth()->user()->role == 1)
    <div class="button mb-4">
      <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPT">Tambah Data</button>
    </div>
    @endif
    <table class="table table-striped data">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama Dusun</th>
          {{-- <th scope="col">No Pendaftaran</th> --}}
          <th scope="col">Action</th>
        </tr>
      </thead>
      <?php $no = 1; ?>
      <tbody>
        @foreach ($data as $pt)
        <tr>
          <td>{{$no++}}</td>
          <td>{{$pt->judul_program}}</td>
          <td>
            @if (auth()->user()->role == 1)
            <button class="btn btn-primary" data-toggle="modal" data-target="#editPT{{$pt->id}}">Edit</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#hapusPT{{$pt->id}}">Delete</button>
            @endif
            @if (auth()->user()->role == 2)
            <a href="{{ route('program.show', $pt->id) }}" class="btn btn-primary">Lihat</a>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

<!-- Modal Add PT -->
<div class="modal fade" id="addPT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('importPT') }}" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          @csrf
          <label>Pilih File Excel</label>
          <div class="form-group">
            <input type="file" name="file" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Import</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Modal tambah data --}}
<div class="modal fade" id="tambahPT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Program Tahunan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('program.store') }}" method="post">
        <div class="modal-body">
          @csrf
          <label>Judul Program</label>
          <div class="form-group">
            <input type="text" placeholder="Judul Program Tahunan" name="judul" class="form-control">
          </div>
          <label>Tanggal Mulai</label>
          <div class="form-group">
            <input type="date" name="start" class="form-control">
          </div>
          <label>Tanggal Selsai</label>
          <div class="form-group">
            <input type="date" name="end" class="form-control">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>


@foreach ($data as $pt)
<!-- Modal Edit PT -->
<div class="modal fade" id="editPT{{$pt->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit {{$pt->judul_program}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('program.update', $pt->id) }}" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          @csrf
          @method('PUT');
          <label>Judul Program</label>
          <div class="form-group">
            <input type="text" placeholder="{{$pt->judul_program}}" name="judul" class="form-control">
          </div>
          <label>Tanggal Mulai</label>
          <div class="form-group">
            <input type="date" name="start" class="form-control" value="{{$pt->tgl_mulai}}">
          </div>
          <label>Tanggal Selsai</label>
          <div class="form-group">
            <input type="date" name="end" class="form-control" value="{{$pt->tg_akhir}}">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" rows="3">{{$pt->keterangan}}</textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Edit Data</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@foreach ($data as $pt)
<!-- Modal Hapus-->
<div class="modal fade" id="hapusPT{{$pt->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Perusahaan {{$pt->judul_program}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('program.destroy', $pt->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <div class="form-group" align="center">
            <h3>Yakin ingin menghapus data ini ?</h3>
            <img src="{{url('/img/delete.png')}}" width="50%">
          </div>
        </div>
        <div class="modal-footer" align="center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus Data</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach