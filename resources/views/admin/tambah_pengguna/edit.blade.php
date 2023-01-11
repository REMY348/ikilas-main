@extends('admin.main_layout.layout')
@section('main.content')

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
<form action="{{ route('admin.update.pengguna',$pengguna->id) }}" method="post">
  @csrf
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Ubah Pengguna</h3>

      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="exampleInputRounded0">Nama Pengguna</label>
            <input type="text" value="{{ $pengguna->name }}" name="name" class="form-control rounded-0" id="exampleInputRounded0" autofocus >
              @error('name')
              <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
        </div>

        <div class="col-6">
          <div class="form-group">
            <label for="exampleInputRounded0">Email</label>
            <input type="email" name="email" value="{{ $pengguna->email }}" class="form-control rounded-0" id="exampleInputRounded0">
              @error('email')
              <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
        </div>
        </div>
        <!-- /.row 1-->
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="exampleInputRounded0">No. Tel</label>
            <input type="text" name="no_tel" value="{{ $pengguna->no_tel }}" class="form-control rounded-0" id="exampleInputRounded0">
              @error('no_tel')
              <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
        </div>

        <div class="col-6">
            <div class="form-group" data-select2-id="1">
              <label>Jantina</label>
              <select name="jantina" class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                <option selected disabled>Sila Pilih</option>
                <option value="lelaki" {{ ( $pengguna->jantina == 'lelaki') ? 'selected' : '' }}>Lelaki</option>
                <option value="perempuan" {{ ( $pengguna->jantina  == 'perempuan') ? 'selected' : '' }}>Perempuan</option>
              </select>
              {{-- {{ dd(old('jantina')) }} --}}
              @error('jantina')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
        </div>
        </div>
        <!-- /.row 2-->
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="exampleInputRounded0">No. Kad Pengenalan</label>
            <input type="text" value="{{ $pengguna->no_kp  }}" name="no_kp" class="form-control rounded-0" id="exampleInputRounded0">
              @error('no_kp')
              <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
        </div>

        <div class="col-6">
          <div class="form-group" data-select2-id="2">
            <label>Jabatan</label>
            <select name="jabatan_id" class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true">
              <option selected disabled>Sila Pilih</option>
              @foreach ($jabatan as $jabatans)
                  <option  value="{{ $jabatans->id }}" {{ ($pengguna->jabatan_id == $jabatans->id) ? 'selected' : '' }}>{{ $jabatans->name }}</option>
              @endforeach
            </select>
            @error('jabatan_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
        </div>
        <!-- /.row 3-->
        <div class="row">
          <div class="col-6">
              <div class="form-group" data-select2-id="3">
                <label>Jawatan</label>
                <select name="jawatan_id" class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true">
                  <option selected disabled>Sila Pilih</option>
                  @foreach ($jawatan as $jawatans)
                      <option  value="{{ $jawatans->id }}" {{ ($pengguna->jawatan_id == $jawatans->id) ? 'selected' : '' }}>{{ $jawatans->name }}</option>
                  @endforeach
                </select>
                @error('jawatan_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-6">
          <div class="form-group" data-select2-id="4">
            <label>Peranan</label>
            <select name="peranan" class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="4" tabindex="-1" aria-hidden="true">
              <option selected selected  disabled>Sila Pilih</option>
                  <option value="pengguna" {{ ($pengguna->role == 'pengguna') ? 'selected' : '' }}>Pengguna Biasa</option>
                  <option  value="pegawai jabatan" {{ ($pengguna->role == 'pegawai jabatan') ? 'selected' : '' }}>Pengarah Jabatan / Pegawai Jabatan</option>
                  <option  value="pentadbir" {{ ($pengguna->role == 'pentadbir') ? 'selected' : '' }}>Pentadbir (Admin)</option>
            </select>
            {{-- {{ dd(old('peranan')) }} --}}
            @error('peranan')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        </div>
        </div>
        <!-- /.row 4-->
        <div class="row">
          <div class="col-6">
            <div class="form-group" data-select2-id="5">
              <label>Status</label>
              <select name="status" class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="5" tabindex="-1" aria-hidden="true">
                <option selected disabled>Sila Pilih</option>
                    <option  value="aktif" {{ ($pengguna->status) ? 'selected' : '' }}>Aktif</option>
                    <option  value="tidak aktif" {{ ($pengguna->status == 'tidak aktif') ? 'selected' : '' }}>Tidak Aktif</option>
              </select>
              @error('status')
              <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
        </div>
        </div>
        <!-- /.row 4-->
        <div class="row">
          <input type="submit" value="Simpan" class="btn btn-dark ml-2">
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
      </div>
    <!-- /.card -->
  </form>
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection
