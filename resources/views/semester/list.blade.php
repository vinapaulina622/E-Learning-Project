@extends('index')
@section('content')
<div class="card-body">
<button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#tambahSemester">Tambah Semester</button>
  <table class="table table-striped" id="table1">
      <thead>
          <tr>
              <th>Semester</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
        @foreach($semester as $r)
          <tr>
              <td>{{ $r->semester }}</td>
              <td>
                <button type="button" id="editSemesterButon" class="btn btn-sm btn-primary" data-id="{{$r->id}}" data-bs-toggle="modal" data-bs-target="#editSemester">Edit</button>
                <form method="POST" action="{{ route('semester.destroy', $r->id) }}">
                  @csrf
                  <input name="_method" type="hidden" value="DELETE">
                  <button type="submit" id="deleteSemester" class="btn btn-sm btn-danger">Hapus</button>
                </form>
              </td>
          </tr>
        @endforeach
      </tbody>
  </table>
</div>

<!-- Tambah semester -->
<div class="modal fade text-left" id="tambahSemester" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1">Tambah Semester</h5>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form class="form form-horizontal" id="formAddSemester" action="{{route('semester.store')}}" method="POST">
      @csrf
        <div class="modal-body">
          <div class="form-body">
            <div class="row">
              <div class="col-md-4">
                <label>Semester</label>
              </div>
              <div class="col-md-8 form-group">
                <input type="number" name="semester" class="form-control" autocomplete="off" required/>
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

<!-- Edit semester -->
<div class="modal fade text-left" id="editSemester" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1">Edit Semester</h5>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form class="form form-horizontal" id="formEditSemester" method="POST">
      @csrf
      @method('PUT')
        <div class="modal-body">
          <div class="form-body">
            <div class="row">
              <div class="col-md-4">
                <label>Semester</label>
              </div>
              <div class="col-md-8 form-group">
                <input type="number" id="editSmt" name="semester" class="form-control" autocomplete="off" required/>
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

  $('body').on('click', '#editSemesterButon', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
  
    $.get('/api/semester/' + id, function (res) {
      $("#formEditSemester").attr('action', 'http://127.0.0.1:8000/semester/' + id)
      $("#editSmt").val(res.data.semester)
    })


  });

}); 
</script>
@endsection