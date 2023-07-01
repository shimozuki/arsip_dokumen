@extends('layouts/app2')
@section('title','Data Bansos')
@section('judul','List Data Penerima Bansos')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Data Perusahaan</h4>
    </div>
    <div class="card-body">
        @if (auth()->user()->role == 1)
        <div class="button mb-4">
            <button class="btn btn-success" data-toggle="modal" data-target="#addbansos">Import Excel</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPT">Tambah Data</button>
        </div>
        @endif
        <table class="table table-striped data">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Penerima</th>
                    <th scope="col">Jenis Bansos</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <?php $no = 1; ?>
            <tbody>
                @foreach ($data as $pt)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$pt->nama_penerima}}</td>
                    <td>{{ $pt->jenis_bantuan }}</td>
                    <td>{{ $pt->alamat }}</td>
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
<div class="modal fade" id="addbansos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('importBansos') }}" method="post" enctype="multipart/form-data">
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
            <form action="{{ route('bansos.store') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <label>Nama Penerima</label>
                    <div class="form-group">
                        <input type="text" placeholder="Nama Penerima" name="nama" class="form-control">
                    </div>
                    <label>Jenis Bansos</label>
                    <div class="form-group">
                        <input type="text" name="jenis" placeholder="Jenis Bantuan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" rows="3"></textarea>
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
            <form action="{{ route('bansos.update', $pt->id) }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @method('PUT');
                    <label>Nama Penerima</label>
                    <div class="form-group">
                        <input type="text" placeholder="{{ $pt->nama_penerima }}" name="nama" value="{{ $pt->nama_penerima }}"  class="form-control">
                    </div>
                    <label>Jenis Bansos</label>
                    <div class="form-group">
                        <input type="text" name="jenis" placeholder="{{ $pt->jenis_bantuan }}" value="{{ $pt->jenis_bantuan }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" rows="3">{{ $pt->alamat }}</textarea>
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
                <h5 class="modal-title" id="exampleModalLabel">Hapus Perusahaan {{$pt->nama_penerima}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('bansos.destroy', $pt->id)}}" method="POST" enctype="multipart/form-data">
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