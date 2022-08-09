@extends('index')
@section('content')
<div class="card-body">
<button class="btn btn-sm btn-success addabsen" data-bs-toggle="modal" data-bs-target="#tambahAbsen">Tambah Absen</button>
  <table class="table table-striped" id="table1">
      <thead>
          <tr>
              <th>Matakuliah</th>
              <th>Nama Mahasiswa</th>
              <th>Keterangan</th>
              <th>Waktu Absen</th>
          </tr>
      </thead>
      <tbody>
        @foreach($absen as $r)
          <tr>
              <td>{{ $r->matakuliah->nama_matakuliah }}</td>
              <td>{{ $r->mahasiswa->nama_mahasiswa }}</td>
              <td>{{ $r->keterangan }}</td>
              <td>{{ $r->waktu_absen }}</td>
          </tr>
        @endforeach
      </tbody>
  </table>
</div>

<!-- Tambah absen -->
<div class="modal fade text-left" id="tambahAbsen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel1">Tambah Absen</h5>
        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
          <i data-feather="x"></i>
        </button>
      </div>
      <form class="form form-horizontal" id="formAddAbsen" action="{{route('absen.store')}}" method="POST">
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
                <label>Matakuliah</label>
              </div>
              <div class="col-md-8 form-group">
                <select class="form-select" id="listMatakuliah" name="matakuliah_id">
                </select>
              </div>
              <div class="col-md-4">
                <label>Matakuliah</label>
              </div>
              <div class="col-md-8 form-group">
                <select class="form-select" id="keterangan" name="keterangan">
                    <option value="hadir">Hadir</option>
                    <option value="tidak hadir">Tidak hadir</option>
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

<script>
  $(document).ready(function () {

  $('body').on('click', '.addabsen', function (e) {
    e.preventDefault();
  
    $.get('/api/matakuliah', function (res) {
      $('#listMatakuliah').empty();
      $.each(res.data, function (key, value) {
        $('#listMatakuliah').append('<option value="' + value.id + '">' + value.nama_matakuliah + '</option>');
      });
    })

    $.get('/api/mahasiswa', function (res) {
      $('#listMahasiswa').empty();
      $.each(res.data, function (index, value) {
        $('#listMahasiswa').append('<option value="' + value.id + '">' + value.nama_mahasiswa + '</option>');
      });
    })

  });

}); 
</script>
@endsection