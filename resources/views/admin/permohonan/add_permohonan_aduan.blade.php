@extends('admin.main_layout.layout')
@section('main.content')
{{-- {{ dd($jenkemaskini) }} --}}
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    
<form action="{{ route('create.permohonan.aduan') }}" method="post" enctype="multipart/form-data">
  @csrf
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Tambah Permohonan Aduan</h3>

      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">

          <div class="col-6">
          <div class="form-group">
            <label for="exampleInputRounded0">Nama penguna:</label><br>
            {{ Auth::user()->name; }}
            
          </div>
        </div>

             

          <div class="col-6">
            <div class="form-group">
                <label>Jabatan:</label><br>
                {{ Auth::user()->jabatan->name; }}
               
              </div>
        </div>

        </div>
        <!-- /.row -->
        <div class="row">
          
          <div class="col-6">
            <div class="form-group">
              <label for="exampleInputRounded0">Tajuk Permohonan</label>
              <input type="text" name="tajuk" value="{{ old('tajuk') }}" class="form-control rounded-0" id="exampleInputRounded0" autofocus >
                @error('tajuk')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
          </div>
          
            {{-- <div class="col-6">
            
            <div class="form-group">
                <label for="exampleInputRounded0">No Rujukan:</label><br>
                <input type="text" id="no_rujukan" name="no_rujukan" style="width:100%" class="form-control hidden-accessible"><br>
             
              </div>
          </div> --}}
  
            <div class="col-6">
            
            <div class="form-group">
                <label for="exampleInputRounded0">Jenis Aduan</label>
                <select name="jenis_aduan_id"  class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true">
                  <option selected disabled>Sila Pilih</option>
                  @foreach ($jenAduan as $jenis)
                  
                      <option value="{{ $jenis->id }}" {{ (old('jenis_aduan_id') == $jenis->id) ? 'selected' : '' }}>{{ $jenis->name }}</option>
  
                  @endforeach
                </select>
                  @error('jenis_aduan_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
          </div>
  
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
                  <textarea class="form-control" name="keterangan"  rows="3">{{ old('keterangan') }}</textarea>
                  @error('keterangan')
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
      <!-- /.row -->
      </div>
      <!-- /.card-body -->
    

      </div>
    <!-- /.card -->

  </div>
</form>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection
