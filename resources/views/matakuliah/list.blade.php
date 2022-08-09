@extends('index')
@section('content')
<div class="card-body">
<button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#tambahMatakuliah">Tambah Matakuliah</button>
  <table class="table table-striped" id="table1">
      <thead>
          <tr>
              <th>Nama Matakuliah</th>
              <th>SKS</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
        @foreach($matakuliah as $mk)
          <tr>
              <td>{{ $mk->nama_matakuliah }}</td>
              <td>{{ $mk->sks }}</td>
              <td>
                <button type="button" id="editMatakuliahButon" class="btn btn-sm btn-primary" data-id="{{$mk->id}}" data-bs-toggle="modal" data-bs-target="#editMatakuliah">Edit</button>
                <form method="POST" action="{{ route('matakuliah.destroy', $mk->id) }}">
                  @csrf
                  <input name="_method" type="hidden" value="DELETE">
                  <button type="submit" id="deleteMatakuliah" class="btn btn-sm btn-danger">Hapus</button>
                </form>
              </td>
          </tr>
        @endforeach
      </tbody>
  </table>
</div>

<!-- Tambah matakuliah -->
<div class="modal fade text-left" id="tambahMatakuliah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1">Tambah Matakuliah</h5>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form class="form form-horizontal" id="formAddMatakuliah" action="{{route('matakuliah.store')}}" method="POST">
      @csrf
        <div class="modal-body">
          <div class="form-body">
            <div class="row">
              <div class="col-md-4">
                <label>Nama matakuliah</label>
              </div>
              <div class="col-md-8 form-group">
                <input type="text" name="matakuliah" class="form-control" autocomplete="off" required/>
              </div>
              <div class="col-md-4">
                <label>SKS</label>
              </div>
              <div class="col-md-8 form-group">
                <input type="number" name="sks" class="form-control" autocomplete="off" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Batal</span>
          </button>
          <button type="submit" class="btn btn-primary ml-1" id="btnTambah">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Tambah</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit matakuliah -->
<div class="modal fade text-left" id="editMatakuliah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1">Edit Matakuliah</h5>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form class="form form-horizontal" id="formEditMatakuliah" method="POST">
      @csrf
      @method('PUT')
        <div class="modal-body">
          <div class="form-body">
            <div class="row">
              <div class="col-md-4">
                <label>Nama matakuliah</label>
              </div>
              <div class="col-md-8 form-group">
                <input type="text" id="editMatkul" name="matakuliah" class="form-control" autocomplete="off" required/>
              </div>
              <div class="col-md-4">
                <label>SKS</label>
              </div>
              <div class="col-md-8 form-group">
                <input type="number" id="editSks" name="sks" class="form-control" autocomplete="off" required/>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Batal</span>
          </button>
          <button type="submit" class="btn btn-primary ml-1" id="btnTambah">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Simpan</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {

  $('body').on('click', '#editMatakuliahButon', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
  
    $.get('/matakuliah/' + id, function (res) {
      $("#formEditMatakuliah").attr('action', 'http://127.0.0.1:8000/matakuliah/' + id)
        $('#editMatkul').val(res.data.nama_matakuliah)
        $('#editSks').val(res.data.sks)
    })


  });

}); 
</script>
@endsection