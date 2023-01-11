@extends('admin.profile.index')
@section('content.profile')
<form action="{{ route('update.password.pengguna',$pengguna->id) }}" method="Post">
  @csrf
    <!-- SELECT2 EXAMPLE -->
      <!-- /.card-header -->
        <div class="row">
          <div class="col-4">
          <div class="form-group">
            <label for="exampleInputRounded0">Kata Laluan Lama</label>
            <input type="password" name="old_password" class="form-control rounded-0" id="exampleInputRounded0" autofocus >
              @error('old_password')
              <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
        </div>

        <div class="col-4">
          <div class="form-group">
            <label for="password">Kata Laluan Baru</label>
            <input id="password" type="password" name="password" class="form-control rounded-0" id="exampleInputRounded0">
              @error('password')
              <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
        </div>

        <div class="col-4">
            <div class="form-group">
              <label for="password_confirmation">Sahkan Kata Laluan</label>
              <input id="password_confirmation" type="password" name="password_confirmation" class="form-control rounded-0" id="exampleInputRounded0">
                @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
          </div>
        </div>

        <div class="row">
          <input type="submit" value="Simpan" class="btn btn-dark ml-2">
        </div>
        <!-- /.row -->
    <!-- /.card -->
  </form>

@endsection
