@extends('admin.main_layout.layout')
@section('main.content')
{{-- {{ dd($mohon_lamanweb[0]->status) }} --}}




    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="float-left"><strong>Halaman Permohonan Laman Web</strong></h3>
                <a href="{{ route('add.permohonan.lamanweb') }}" class="btn btn-dark float-right" style="width: 178px"><small>Tambah Permohonan</small></a>
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
                @foreach ($mohon_lamanweb as $key=>$mohon)
            <tr>
                <td>{{ $mohon->tajuk }}</td>
                <td>{{ $mohon->keterangan }}</td>
                <td>{{ $mohon->status }}</td>
                <td>{{ $mohon->tarikh_mula }} - {{ $mohon->tarikh_tamat }}</td>
                <td class="text-center">
                    <a href="{{ route('edit.permohonan.lamanweb',$mohon->id) }}"><span class="btn btn-info fa fa-edit" {{ ($mohon->status != 'baru_r') ? 'hidden' : '' }} title="Ubah"></span></a>
                    <a href="{{ route('permohonan.lamanweb.view',$mohon->id) }}"><span class="btn btn-warning fa fa-solid fa-eye" title="paparan penuh"></span></a>
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