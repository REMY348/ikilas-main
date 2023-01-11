@extends('admin.main_layout.layout')
@section('main.content')

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    
<form action="{{ route('update.jawatan',$jawatan->id) }}" method="post">
  @csrf
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Ubah Jawatan</h3>

      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-12">
          <div class="form-group">
            <label for="exampleInputRounded0">Nama Jawatan</label>
            <input type="text" name="name" value="{{ $jawatan->name }}" class="form-control rounded-0" id="exampleInputRounded0" autofocus >
              @error('name')
              <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
        </div>
        </div>
        <!-- /.row -->
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
