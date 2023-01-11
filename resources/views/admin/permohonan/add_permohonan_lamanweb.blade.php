@extends('admin.main_layout.layout')
@section('main.content')
{{-- {{ dd($jenkemaskini) }} --}}
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    
<form action="{{ route('create.permohonan.lamanweb') }}" method="post" enctype="multipart/form-data">
  @csrf
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Tambah Permohonan Laman Web</h3>

      </div>
      <!-- /.card-header -->
      <div class="card-body">
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

              {{-- @php
              $katsalid = explode(',',$mohon->kategori_saluran_id);
              $kira = count($katsalid)
              @endphp --}}

          <div class="col-6">
            <div class="form-group">
                <label>Kategori Saluran</label>
                <select name="kategori_saluran_id[]" class="select2bs4"  multiple data-placeholder="Sila Pilih" style="width: 100%;">
                    @foreach ($katsaluran as $saluran)
                        <option value="{{ $saluran->name }}" 

                          @php
                            if (old('kategori_saluran_id')) {
                              # code...
                              $lama = old('kategori_saluran_id');
                            }else {
                              # code...
                              $lama = [];
                            }
                          @endphp

                          @foreach ($lama as $katsalids)
                            {{ ($katsalids == $saluran->name) ? 'selected' : '' }}
                            @endforeach
                          >{{ $saluran->name }}</option>
                          
                    @endforeach
                </select>
                @error('kategori_saluran_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
        </div>

        </div>
        <!-- /.row -->
        <div class="row">

            <div class="col-6">
            
            <div class="form-group">
                <label for="exampleInputRounded0">Kategori Maklumat</label>
                <select name="kategori_maklumat_id"  class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true">
                  <option selected disabled>Sila Pilih</option>
                  @foreach ($katmaklumat as $maklumat)
  
                      <option value="{{ $maklumat->id }}" {{ (old('kategori_maklumat_id') == $maklumat->id) ? 'selected' : '' }}>{{ $maklumat->name }}</option>
                      
                  @endforeach
                </select>
                  @error('kategori_maklumat_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
          </div>
  
            <div class="col-6">
            
            <div class="form-group">
                <label for="exampleInputRounded0">Jenis Pengemaskinian</label>
                <select name="jenis_kemaskini_id"  class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true">
                  <option selected disabled>Sila Pilih</option>
                  @foreach ($jenkemaskini as $jenis)
                  
                      <option value="{{ $jenis->id }}" {{ (old('jenis_kemaskini_id') == $jenis->id) ? 'selected' : '' }}>{{ $jenis->name }}</option>
  
                  @endforeach
                </select>
                  @error('jenis_kemaskini_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
          </div>
  
          </div>
          <!-- /.row -->
        <div class="row">

            <div class="col-6">
            
            <div class="form-group">
                <label for="exampleInputRounded0">Tarikh Mula</label>
                <input type="date" value="{{ old('tarikh_mula') }}" name="tarikh_mula" class="form-control rounded-0" id="exampleInputRounded0" >
                  @error('tarikh_mula')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
          </div>
  
            <div class="col-6">
                
                  <div class="form-group">
                    <label for="exampleInputRounded0">Tarikh Tamat</label>
                    <input type="date" value="{{ old('tarikh_tamat') }}" name="tarikh_tamat" class="form-control rounded-0" id="exampleInputRounded0" >
                      @error('tarikh_tamat')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
                  
          </div>
  
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
      <!-- /.card-body -->
      </div>
    <!-- /.card -->
  </form>
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection
