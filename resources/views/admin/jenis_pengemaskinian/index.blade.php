@extends('admin.main_layout.layout')
@section('main.content')


    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="float-left"><strong>Halaman Jenis Pengemaskinian</strong></h3>
                <a href="{{ route('admin.add.jenispengemaskinian') }}" class="btn btn-dark float-right" style="width: 178px"><small>Tambah Jenis Kemaskini</small></a>
            </div>
        <div class="card-body">
            <table id="example3" class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th style="width: 10%">No.</th>
                <th style="width: 70%">Nama</th>
                <th>Tindakan</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($jenis as $key=>$jenis)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $jenis->name }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.edit.jenispengemaskinian',$jenis->id) }}"><span class="btn btn-info fa fa-edit" title="Ubah"></span></a>
                    {{-- <a href=""><span class="btn btn-danger fa fa-trash-alt" title="Hapus"></span></a> --}}
                </td>
            </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th>No.</th>
                <th>Nama</th>
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