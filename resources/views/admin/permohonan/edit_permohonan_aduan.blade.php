@extends('admin.main_layout.layout')
@section('main.content')
{{-- {{ dd($jenkemaskini) }} --}}
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    
<form action="{{ route('update.permohonan.aduan',$mohon->id) }}" method="post" enctype="multipart/form-data">
  @csrf
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Ubahsuai Permohonan Aduan</h3>

      </div>
      <!-- /.card-header -->
      
      <div class="card-body">
        <div class="row">

          <div class="col-6">
            <div class="form-group">
              <label for="exampleInputRounded0">Nama pemohon:</label><br>
              {{ $mohon->user->name }}
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="exampleInputRounded0">Nama jabatan:</label><br>
              {{ $mohon->jabatan->name }}
            </div>
          </div>

          <div class="col-6">
          <div class="form-group">
            <label for="exampleInputRounded0">No Rujukan</label>
            <input type="text" name="no_rujukan" value="{{ $mohon->no_rujukan }}" class="form-control rounded-0" id="exampleInputRounded0" autofocus >
              @error('no_rujukan')
              <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
        </div>

  
            <div class="col-6">
            
            <div class="form-group">
                <label for="exampleInputRounded0">Jenis Aduan</label>
                <select name="jenis_aduan_id"  class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true">
                  <option selected disabled>Sila Pilih</option>
                  @foreach ($jenaduan as $jenis)
                  
                      <option value="{{ $jenis->id }}" {{ ($mohon->jenis_aduan_id == $jenis->id) ? 'selected' : '' }}>{{ $jenis->name }}</option>
  
                  @endforeach
                </select>
                  @error('jenis_aduan_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
          </div>
  
          </div>
          <!-- /.row -->
        <div class="row">

            
  
          </div>
          <!-- /.row -->
        <div class="row">

            <div class="col-6">
                
                <div class="form-group">
                    <label for="exampleInputRounded0">Muat Naik Gambar</label>
                    <input type="file" name="uploaded_image[]" class="form-control rounded-0" id="exampleInputRounded0" multiple>
                      @error('uploaded_image')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
          </div>

            
                <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                      <label>Keterangan</label>
                      <textarea class="form-control" name="keterangan"  rows="3">{{ $mohon->keterangan }}</textarea>
                      @error('keterangan')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                    
  
          </div>
          <!-- /.row -->

          <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Document Yang Telah Dimuat</label><br>
                    @php
                        $multpicture = explode(',',$mohon->uploaded_image)
                    @endphp
                  @foreach ($multpicture as $multpictures)
                      {{-- <img src="{{ url($multpictures) }}" alt="" style="width: 50px;height:50px"> <br> --}}
                      <i class="fa-solid fa-file-arrow-down fa-2x"></i><small>&nbsp;&nbsp;{{ $multpictures }}</small><br>
                  @endforeach
            </div>
            </div>
          </div>

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
