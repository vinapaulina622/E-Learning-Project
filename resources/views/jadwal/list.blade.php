@extends('index')
@section('content')
<div class="card-body">
<button class="btn btn-sm btn-success addjadwal" data-bs-toggle="modal" data-bs-target="#tambahJadwal">Tambah Jadwal</button>
  <table class="table table-striped" id="table1">
      <thead>
          <tr>
              <th>Matakuliah</th>
              <th>Jadwal</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
        @foreach($jadwal as $r)
          <tr>
              <td>{{ $r->matakuliah->nama_matakuliah }}</td>
              <td>{{ $r->jadwal }}</td>
              <td>
                <button type="button" id="editJadwalButon" class="btn btn-sm btn-primary" data-id="{{$r->id}}" data-bs-toggle="modal" data-bs-target="#editJadwal">Edit</button>
                <form method="POST" action="{{ route('jadwal.destroy', $r->id) }}">
                  @csrf
                  <input name="_method" type="hidden" value="DELETE">
                  <button type="submit" id="deleteJadwal" class="btn btn-sm btn-danger">Hapus</button>
                </form>
              </td>
          </tr>
        @endforeach
      </tbody>
  </table>
</div>

<!-- Tambah jadwal -->
<div class="modal fade text-left" id="tambahJadwal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1">Tambah Jadwal</h5>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form class="form form-horizontal" id="formAddJadwal" action="{{route('jadwal.store')}}" method="POST">
      @csrf
        <div class="modal-body">
          <div class="form-body">
            <div class="row">
              <div class="col-md-4">
                <label>Matakuliah</label>
              </div>
              <div class="col-md-8 form-group">
                <select class="form-select" id="listMatakuliah" name="matakuliah_id">
                </select>
              </div>
              <div class="col-md-4">
                <label>Jadwal</label>
              </div>
              <div class="col-md-8 form-group">
                <input type="datetime-local" name="jadwal" class="form-control" autocomplete="off" required/>
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

<!-- Edit jadwal -->
<div class="modal fade text-left" id="editJadwal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1">Edit Jadwal</h5>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form class="form form-horizontal" id="formEditJadwal" method="POST">
      @csrf
      @method('PUT')
        <div class="modal-body">
          <div class="form-body">
            <div class="row">
              <div class="col-md-4">
                <label>Matakuliah</label>
              </div>
              <div class="col-md-8 form-group">
                <select class="form-select" id="editlistMatakuliah" name="matakuliah_id">
                </select>
              </div>
              <div class="col-md-4">
                <label>Jadwal</label>
              </div>
              <div class="col-md-8 form-group">
                <input type="datetime-local" id="editJadwal" name="jadwal" class="form-control" autocomplete="off" required/>
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

  $('body').on('click', '.addjadwal', function (e) {
    e.preventDefault();
  
    $.get('/api/matakuliah', function (res) {
      $('#listMatakuliah').empty();
      $.each(res.data, function (key, value) {
        $('#listMatakuliah').append('<option value="' + value.id + '">' + value.nama_matakuliah + '</option>');
      });
    })
  });

  $('body').on('click', '#editJadwalButon', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
  
    $.get('/api/matakuliah', function (res) {
      $("#formEditJadwal").attr('action', 'http://127.0.0.1:8000/jadwal/' + id)
        $.each(res.data, function (key, value) {
          $('#editlistMatakuliah').append('<option value="' + value.id + '">' + value.nama_matakuliah + '</option>');
        });
    })


  });

}); 
</script>
@endsection