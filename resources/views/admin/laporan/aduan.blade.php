@extends('admin.main_layout.layout')
@section('main.content')
{{-- {{ dd($date) }} --}}

<form action="{{ route('all.laporan.aduan') }}" method="get">
<!-- SELECT2 EXAMPLE -->
<div class="container-fluid">
<div class="card card-dark">
    <!-- /.card-header -->
    <div class="card-body">
      <div class="row">

        <div class="col-3">
            <div class="form-group">
              <label for="exampleInputRounded0">Tarikh Mohon</label>
              <input type="date" value="{{ $date }}" name="tarikh_mohon" class="form-control rounded-0" id="exampleInputRounded0" >
                @error('tarikh_mohon')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        
            <div class="col-3">
            <div class="form-group">
                    <label for="exampleInputRounded0">Status</label>
                    <select name="status" class="form-control select2bs4 select2-hidden-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true">
                      <option selected disabled>Sila Pilih</option>
                      <option value="baru" {{ ($status == 'baru') ? 'selected' : '' }}>Baru</option>
                      <option value="baru_r" {{ ($status == 'baru_r') ? 'selected' : '' }}>Kembali Pada Kerani Jabatan</option>
                      <option value="diluluskan" {{ ($status == 'diluluskan') ? 'selected' : '' }}>Lulus</option>
                    </select>
                      @error('status')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
              </div>

              <div class="col-3" style="margin-top: 32px">
                <input type="submit" value="Buat Carian" class="btn btn-dark ml-2">
              </div>
        </div>

      
      <!-- /.row -->
    </div>
    <!-- /.card-body -->
    </div>
  <!-- /.card -->
</div>
@if ($date == null)

<div class="container-fluid">
    <div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h6 class="float-left"><strong>Halaman Laporan Aduan</strong></h6>
            </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>No. Rujukan</th>
                <th>Tajuk</th>
                <th>Keterangan</th>
                <th>Jabatan</th>
                <th>Jenis aduan</th>
                <th>Tarikh Mohon</th>
                <th>Status</th>
                <th>Tarikh Lulus</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @foreach ($laporan as $key=>$laporans)
                <tr>
                    <td>{{ $laporans->no_rujukan }}</td>
                    <td>{{ $laporans->tajuk }}</td>
                    <td>{{ $laporans->keterangan }}</td>
                    <td class="text-center">{{ $laporans->jabatan->name }}</td>
                    <td class="text-center">{{ $laporans->jenisaduan->name }}</td>
                    <td>{{ $laporans->tarikh_mohon}}</td>
                    <td class="text-center"><span class="badge badge-warning">{{ $laporans->status }}</span></td>
                    <td class="text-center">{{ $laporans->tarikh_lulus }}</td>
                </tr>
                @endforeach
            </tr>

            </tbody>
            <tfoot>
            <tr>
                <th>No. Rujukan</th>
                <th>Tajuk</th>
                <th>Keterangan</th>
                <th>Jabatan</th>
                <th>Jenis aduan</th>
                <th>Tarikh Mohon</th>
                <th>Status</th>
                <th>Tarikh Lulus</th>
            </tr>
            </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->


@else
<div class="container-fluid">
    <div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h6 class="float-left"><strong>Halaman Laporan Aduan</strong></h6>
            </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>No. Rujukan</th>
                <th>Tajuk</th>
                <th>Keterangan</th>
                <th>Jabatan</th>
                <th>Jenis aduan</th>
                <th>Tarikh Mohon</th>
                <th>Status</th>
                <th>Tarikh Lulus</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($laporan as $key=>$laporans)
            <tr>
                <td>{{ $laporans->no_rujukan }}</td>
                <td>{{ $laporans->tajuk }}</td>
                <td>{{ $laporans->keterangan }}</td>
                <td class="text-center">{{ $laporans->jabatan->name }}</td>
                <td class="text-center">{{ $laporans->jenisaduan->name }}</td>
                <td>{{ $laporans->tarikh_mohon}}</td>
                <td class="text-center"><span class="badge badge-warning">{{ $laporans->status }}</span></td>
                <td class="text-center">{{ $laporans->tarikh_lulus }}</td>
            </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th>No. Rujukan</th>
                <th>Tajuk</th>
                <th>Keterangan</th>
                <th>Jabatan</th>
                <th>Jenis aduan</th>
                <th>Tarikh Mohon</th>
                <th>Status</th>
                <th>Tarikh Lulus</th>
            </tr>
            </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endif
    
</form>
@endsection