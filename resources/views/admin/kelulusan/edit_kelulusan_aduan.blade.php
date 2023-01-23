@extends('admin.main_layout.layout')
@section('main.content')
{{-- {{ dd($admin) }} --}}
{{-- {{ dd($lulus) }} --}}

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    
<form action="{{ route('update.kelulusan.aduan',$lulus->id) }}" method="post" enctype="multipart/form-data">
  @csrf

  <div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title"><b>Ringkasan Permohonan</b></h3>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <table class="table table-borderless m-0 p-0">
                    <tr>
                        <td style="max-width: 100px">No Rujukan</td>
                        <td>| {{ $lulus->no_rujukan }}</td>
                    </tr>
                    <tr>
                        <td style="max-width: 100px">Nama Pemohon</td>
                        <td>| {{ $lulus->mohon_by }}</td>
                    </tr>
                    <tr>
                        <td style="max-width: 100px">Keterangan</td>
                        <td>| {{ $lulus->keterangan }}</td>
                    </tr>
                    <tr>
                        <td style="max-width: 100px">Jenis Pengemaskinian</td>
                        <td>| {{ $lulus->status}}</td>
                    </tr>
                    <tr>
                        <td style="max-width: 100px">Tarikh Mohon</td>
                        <td>| {{ $lulus->tarikh_mohon }}</td>
                    </tr>
                    
                
                    <tr>
                        <td style="max-width: 100px">Ulasan Pegawai/Pengarah</td>
                        <td>| {{ $lulus->ulasan }}</td>
                    </tr>
                    <tr>
                        <td style="max-width: 100px">Muat Naik Gambar</td>
                        <td> 
                            @php
                        $multpicture = explode(',',$lulus->uploaded_image)
                            @endphp
                    @foreach ($multpicture as $multpictures)
                    <a href="{{ url($multpictures) }}" download="{{ $multpictures }}">
                        |&nbsp;&nbsp;<i class="fa-solid fa-file-arrow-down fa-2x"></i><small>&nbsp;&nbsp;{{ trim($multpictures,'assets/doc_upload/') }}</small><br>
                    </a>
                    @endforeach

                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
  </div>

    <!-- SELECT2 EXAMPLE -->
    <div class="card card-dark">
      <div class="card-header">
        <h3 class="card-title">Kelulusan Aduan</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
              <div class="col-6">
              <div class="form-group">
                      <label for="exampleInputRounded0">Status Kelulusan</label>
                      <select name="status" class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true">
                        <option selected disabled>Sila Pilih</option>
                        <option value="baru_r">Kembali Pada Kerani Jabatan</option>
                        <option value="diluluskan">Diluluskan Oleh Pentadbir</option>
                      </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputRounded0">Url</label>
                      <input type="text" value="{{ old('url') }}" name="url" class="form-control rounded-0" id="exampleInputRounded0" >
                        @error('url')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-6">
                  <div class="form-group">
                    <label for="exampleInputRounded0">Pengesahan Kelulusan Oleh</label>
                    <select name="lulus_by" class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true">
                      <option selected disabled>Sila Pilih</option>
                      @foreach ($admin as $s_admin)
                      <option value="{{ $s_admin->name }}">{{ $s_admin->name }}</option>
                      @endforeach
                      </select>
                      @error('lulus_by')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
              </div>


              <div class="col-6">
                  
                  <div class="form-group">
                    <label>Ulasan Pegawai</label>
                    <textarea class="form-control" name="ulasan" rows="3"></textarea>
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
