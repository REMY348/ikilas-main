@extends('admin.main_layout.layout')
@section('main.content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    {{-- BEGIN PERMOHONAN --}}
    <div class="col-12">
        <div class="card">
          <div class="card-header bg-dark">
            <th><b> Permohonan Laman Web </b></th>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap table-striped table-bordered">
              <thead>
                <tr>
                  <th colspan="2" class="text-center"> Tarikh Dari <i>{{ $lamanweb->tarikh_mula }}</i> Hingga <i>{{ $lamanweb->tarikh_tamat }}</i></th>
                  </tr>
                <tr>
                  <th>Perkara</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td style="width: 30%"><b>Nombor Rujukan</b></td>
                    <td>{{ ($lamanweb->no_rujukan != null) ? $lamanweb->no_rujukan : ' - Data Tidak Wujud - ' }}</td>
                </tr>
                <tr>
                    <td><b>Tajuk</b></td>
                    <td>{{ ($lamanweb->tajuk != null) ? $lamanweb->tajuk : ' - Data Tidak Wujud - ' }}</td>
                </tr>
                <tr>
                    <td><b>Keterangan</b></td>
                    <td>{{ ($lamanweb->keterangan != null) ? $lamanweb->keterangan : ' - Data Tidak Wujud - ' }}</td>
                </tr>
                <tr>
                  <td><b>Kategori Saluran</b></td>
                  <td>
                    @php
                        $arr = explode(',',$lamanweb->kategori_saluran_id)
                    @endphp
                    |
                    @foreach ($arr as $saluran)
                        {{ ($saluran != null) ? $saluran : ' - Data Tidak Wujud - ' }} |
                    @endforeach
                </td>
                </tr>
                <tr>
                  <td><b>Kategori Maklumat</b></td>
                  <td>{{ ($lamanweb->kategori_maklumat_id != null ) ? $lamanweb->kategorimaklumat->name : ' - Data Tidak Wujud - ' }}</td>
                </tr>
                <tr>
                  <td><b>Jenis Kemaskini</b></td>
                  <td>{{ ($lamanweb->jenis_kemaskini_id != null) ? $lamanweb->jeniskemaskini->name : ' - Data Tidak Wujud - ' }}</td>
                </tr>
                <tr>
                  <td><b>Status</b></td>
                  <td>{{ ($lamanweb->status != null) ? $lamanweb->status : ' - Data Tidak Wujud - ' }}</td>
                </tr>
                <tr>
                  <td><b>Pemohonan Dibuat Oleh</b></td>
                  <td>{{ ($lamanweb->mohon_by != null) ? $lamanweb->mohon_by : ' - Data Tidak Wujud - ' }}</td>
                </tr>
                <tr>
                  <td><b>Tarikh Permohonan</b></td>
                  <td>{{ ($lamanweb->tarikh_mohon != null) ? $lamanweb->tarikh_mohon : ' - Data Tidak Wujud - ' }}</td>
                </tr>
                <tr>
                  <td><b>Dokumen Dimuat naik</b></td>
                  <td>
                    @php
                        $docs = explode(',',$lamanweb->uploaded_image)
                    @endphp
                    @foreach ($docs as $doc)
                    <a href="{{ url($doc) }}" download="{{ url($doc) }}" title="download">
                        <i class="fa fa-solid fa-file-arrow-down fa-2x"></i><small>&nbsp;&nbsp;{{ trim($doc,'assets/doc_upload/') }}</small><br>
                    </a>
                    @endforeach
                </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      {{-- END PERMOHONAN --}}

      {{-- BEGIN SOKONGAN --}}
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-dark">
          <th><b> Sokongan Laman Web </b></th>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap table-striped table-bordered">
            <thead>
              <tr>
                <th>Perkara</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="width: 30%"><b>Ulasan Pegawai / Pengarah</b></td>
                <td>{{ ($lamanweb->ulasan != null) ? $lamanweb->ulasan : ' - Data Tidak Wujud - ' }}</td>
              </tr>
              <tr>
                <td><b>Sokongan Dibuat Oleh</b></td>
                <td>{{ ($lamanweb->sokong_by != null) ? $lamanweb->sokong_by : ' - Data Tidak Wujud - ' }}</td>
              </tr>
              <tr>
                <td><b>Tarikh Disokong</b></td>
                <td>{{ ($lamanweb->tarikh_disokong != null) ? $lamanweb->tarikh_disokong : ' - Data Tidak Wujud - ' }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    {{-- END SOKONGAN --}}

    {{-- BEGIN KELULUSAN --}}
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-dark">
          <th><b> Kelulusan Laman Web </b></th>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap table-striped table-bordered">
            <thead>
                <th>Perkara</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="width: 30%"><b>Url</b></td>
                <td><a href="{{ $lamanweb->url }}">{{ ($lamanweb->url != null) ? $lamanweb->url : ' - Data Tidak Wujud - '  }}</a></td>
              </tr>
              <tr>
                <td><b>Tindakan Oleh</b></td>
                <td>{{ ($lamanweb->tindakan_by != null) ? $lamanweb->tindakan_by : ' - Data Tidak Wujud - ' }}</td>
              </tr>
              <tr>
                <td><b>Diluluskan Oleh</b></td>
                <td>{{ ($lamanweb->lulus_by != null) ? $lamanweb->lulus_by : ' - Data Tidak Wujud - ' }}</td>
              </tr>
              <tr>
                <td><b>Tarikh Diluluskan</b></td>
                <td>{{ ($lamanweb->tarikh_lulus != null) ? $lamanweb->tarikh_lulus : ' - Data Tidak Wujud - ' }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    {{-- END KELULUSAN --}}

  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection
