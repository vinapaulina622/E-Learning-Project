@extends('index')
@section('content')
<div class="card-body">
<button class="btn btn-sm btn-success addkontrak" data-bs-toggle="modal" data-bs-target="#tambahKontrak">Tambah Kontrak</button>
  <table class="table table-striped" id="table1">
      <thead>
          <tr>
              <th>Nama Mahasiswa</th>
              <th>Semester</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
        @foreach($kontrak as $r)
          <tr>
            <td>{{ $r->mahasiswa->nama_mahasiswa }}</td>
            <td>{{ $r->semester->semester }}</td>
            <td>
                <button type="button" id="editKontrakButon" class="btn btn-sm btn-primary" data-id="{{$r->id}}" data-bs-toggle="modal" data-bs-target="#editKontrak">Edit</button>
                <form method="POST" action="{{ route('kontrak.destroy', $r->id) }}">
                  @csrf
                  <input name="_method" type="hidden" value="DELETE">
                  <button type="submit" id="deleteKontrak" class="btn btn-sm btn-danger">Hapus</button>
                </form>
              </td>
          </tr>
        @endforeach
      </tbody>
  </table>
</div>

<!-- Tambah kontrak -->
<div class="modal fade text-left" id="tambahKontrak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1">Tambah Kontrak</h5>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form class="form form-horizontal" id="formAddKontrak" action="{{route('kontrak.store')}}" method="POST">
      @csrf
        <div class="modal-body">
          <div class="form-body">
            <div class="row">
              <div class="col-md-4">
                <label>Nama Mahasiswa</label>
              </div>
              <div class="col-md-8 form-group">
                <select class="form-select" id="listMahasiswa" name="mahasiswa_id">
                </select>
              </div>
              <div class="col-md-4">
                <label>Semester</label>
              </div>
              <div class="col-md-8 form-group">
                <select class="form-select" id="listSemester" name="semester_id">
                </select>
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

<!-- Edit kontrak -->
<div class="modal fade text-left" id="editKontrak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1">Edit Kontrak</h5>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form class="form form-horizontal" id="formEditKontrak" method="POST">
      @csrf
      @method('PUT')
        <div class="modal-body">
          <div class="form-body">
            <div class="row">
            <div class="col-md-4">
                <label>Nama Mahasiswa</label>
              </div>
              <div class="col-md-8 form-group">
                <select class="form-select" id="editlistMahasiswa" name="mahasiswa_id">
                </select>
              </div>
              <div class="col-md-4">
                <label>Semester</label>
              </div>
              <div class="col-md-8 form-group">
                <select class="form-select" id="editlistSemester" name="semester_id">
                </select>
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

  $('body').on('click', '.addkontrak', function (e) {
    e.preventDefault();
  
    $.get('/api/semester', function (res) {
      $('#listSemester').empty();
      $.each(res.data, function (key, value) {
        $('#listSemester').append('<option value="' + value.id + '">' + value.semester + '</option>');
      });
    })

    $.get('/api/mahasiswa', function (res) {
      $('#listMahasiswa').empty();
      $.each(res.data, function (index, value) {
        $('#listMahasiswa').append('<option value="' + value.id + '">' + value.nama_mahasiswa + '</option>');
      });
    })

  });

  $('body').on('click', '#editKontrakButon', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
  
    $.get('/kontrak/' + id, function (res) {
      $("#formEditKontrak").attr('action', 'http://127.0.0.1:8000/kontrak/' + id)
        $.get('/api/mahasiswa', function (res) {
          $('#editlistMahasiswa').empty();
          $.each(res.data, function (index, value) {
            $('#editlistMahasiswa').append('<option value="' + value.id + '">' + value.nama_mahasiswa + '</option>');
          });
        })

        $.get('/api/semester', function (res) {
          $('#editlistSemester').empty();
          $.each(res.data, function (key, value) {
            $('#editlistSemester').append('<option value="' + value.id + '">' + value.semester + '</option>');
          });
        })
    })


  });

}); 
</script>
@endsection