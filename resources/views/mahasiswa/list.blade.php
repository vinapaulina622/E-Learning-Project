@extends('index')
@section('content')
<div class="card-body">
<button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#tambahMahasiswa">Tambah Mahasiswa</button>
  <table class="table table-striped" id="table1">
      <thead>
          <tr>
              <th>Nama Mahasiswa</th>
              <th>Email</th>
              <th>No Telepon</th>
              <th>Alamat</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
        @foreach($mahasiswa as $mhs)
          <tr>
              <td>{{ $mhs->nama_mahasiswa }}</td>
              <td>{{ $mhs->email }}</td>
              <td>{{ $mhs->no_tlp }}</td>
              <td>{{ $mhs->alamat }}</td>
              <td>
                <button type="button" id="editMahasiswaButon" class="btn btn-sm btn-primary" data-id="{{$mhs->id}}" data-bs-toggle="modal" data-bs-target="#editMahasiswa">Edit</button>
                <form method="POST" action="{{ route('mahasiswa.destroy', $mhs->id) }}">
                  @csrf
                  <input name="_method" type="hidden" value="DELETE">
                  <button type="submit" id="deleteMahasiswa" class="btn btn-sm btn-danger">Hapus</button>
                </form>
              </td>
          </tr>
        @endforeach
      </tbody>
  </table>
</div>

<!-- Tambah mahasiswa -->
<div class="modal fade text-left" id="tambahMahasiswa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1">Tambah Mahasiswa</h5>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form class="form form-horizontal" id="formAddMahasiswa" action="{{route('mahasiswa.store')}}" method="POST">
      @csrf
        <div class="modal-body">
          <div class="form-body">
            <div class="row">
              <div class="col-md-4">
                <label>Nama mahasiswa</label>
              </div>
              <div class="col-md-8 form-group">
                <input type="text" name="nama" class="form-control" autocomplete="off" required/>
              </div>
              <div class="col-md-4">
                <label>Email</label>
              </div>
              <div class="col-md-8 form-group">
                <input type="email" name="email" class="form-control" autocomplete="off" required/>
              </div>
              <div class="col-md-4">
                <label>No Telepon</label>
              </div>
              <div class="col-md-8 form-group">
                <input type="text" name="no_hp" class="form-control" autocomplete="off" required/>
              </div>
              <div class="col-md-4">
                <label>Alamat</label>
              </div>
              <div class="col-md-8 form-group">
                <textarea style="resize: none;" rows="5" name="alamat" class="form-control" autocomplete="off" required ></textarea>
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

<!-- Edit mahasiswa -->
<div class="modal fade text-left" id="editMahasiswa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1">Edit Mahasiswa</h5>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form class="form form-horizontal" id="formEditMahasiswa" method="POST">
      @csrf
      @method('PUT')
        <div class="modal-body">
          <div class="form-body">
            <div class="row">
              <div class="col-md-4">
                <label>Nama mahasiswa</label>
              </div>
              <div class="col-md-8 form-group">
                <input type="text" id="editNama" name="nama" class="form-control" autocomplete="off" required/>
              </div>
              <div class="col-md-4">
                <label>Email</label>
              </div>
              <div class="col-md-8 form-group">
                <input type="email" id="editEmail" name="email" class="form-control" autocomplete="off" required/>
              </div>
              <div class="col-md-4">
                <label>No Telepon</label>
              </div>
              <div class="col-md-8 form-group">
                <input type="text" id="editTlp" name="no_hp" class="form-control" autocomplete="off" required/>
              </div>
              <div class="col-md-4">
                <label>Alamat</label>
              </div>
              <div class="col-md-8 form-group">
                <textarea style="resize: none;" rows="5" id="editAlamat" name="alamat" class="form-control" autocomplete="off" required ></textarea>
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

  $('body').on('click', '#editMahasiswaButon', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
  
    $.get('/mahasiswa/' + id, function (res) {
      $("#formEditMahasiswa").attr('action', 'http://127.0.0.1:8000/mahasiswa/' + id)
        $('#editNama').val(res.data.nama_mahasiswa)
        $('#editEmail').val(res.data.email)
        $('#editTlp').val(res.data.no_tlp)
        $('#editAlamat').val(res.data.alamat);
    })


  });

}); 
</script>
@endsection