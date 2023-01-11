@extends('admin.main_layout.layout')
@section('main.content')
{{-- {{ dd($lulus_lamanweb) }} --}}

    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="float-left"><strong>Halaman Kelulusan Laman Web</strong></h3>
            </div>
        <div class="card-body">
            <table id="example3" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>Tajuk</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Tarikh Mula - Tamat</th>
                <th>Tindakan</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($lulus_lamanweb as $key=>$lulus)
            <tr>
                <td>{{ $lulus->tajuk }}</td>
                <td>{{ $lulus->keterangan }}</td>
                <td>{{ $lulus->status }}</td>
                <td>{{ $lulus->tarikh_mula }} - {{ $lulus->tarikh_tamat }}</td>
                <td class="text-center">
                    <a href="{{ route('edit.kelulusan.lamanweb',$lulus->id) }}"><span class="btn btn-info fa fa-edit" {{ ($lulus->status != 'disokong') ? 'hidden' : '' }} title="Ubah"></span></a>
                    <a href="{{ route('permohonan.lamanweb.view',$lulus->id) }}"><span class="btn btn-warning fa fa-solid fa-eye" title="paparan penuh"></span></a>
                </td>
            </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th>Tajuk</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Tarikh Mula - Tamat</th>
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