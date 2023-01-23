@extends('admin.main_layout.layout')
@section('main.content')
{{-- {{ dd($lulus_lamanweb) }} --}}

    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="float-left"><strong>Halaman Kelulusan Aduan</strong></h3>
            </div>
        <div class="card-body">
            <table id="example3" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>No Rujukan</th>
                <th>Nama Pemohon</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Tarikh Mohon</th>
                <th>Tindakan</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($lulus_aduan as $key=>$lulus)
            <tr>
                <td>{{ $lulus->no_rujukan }}</td>
                <td>{{ $lulus->name }}</td>
                <td>{{ $lulus->keterangan }}</td>
                <td>{{ $lulus->status }}</td>
                <td>{{ $lulus->tarikh_mohon }}</td>
                <td class="text-center">
                    <a href="{{ route('edit.kelulusan.aduan',$lulus->id) }}"><span class="btn btn-info fa fa-edit" {{ ($lulus->status != 'baru') ? 'hidden' : '' }} title="Ubah"></span></a>
                    <a href="{{ route('permohonan.aduan.view',$lulus->id) }}"><span class="btn btn-warning fa fa-solid fa-eye" title="paparan penuh"></span></a>
                </td>
            </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th>No Rujukan</th>
                <th>Nama Pemohon</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Tarikh Mohon</th>
                <th>Tindakan</th>
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
@endsection