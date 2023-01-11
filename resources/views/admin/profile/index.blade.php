@extends('admin.main_layout.layout')
@section('main.content')
<!-- Main content -->
<section class="content">
<div class="container-fluid">
{{-- <form action="" method="post">
@csrf --}}

<div class="row">

    <!-- /.col -->
    <div class="col-md-12">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link {{ (Route::currentRouteName() == 'profile.pengguna') ? 'active' : '' }}" href="{{ route('profile.pengguna',$pengguna->id) }}"><i class="fa fa-solid fa-user"></i>&nbsp;&nbsp; Profile</a></li>
              <li class="nav-item"><a class="nav-link {{ (Route::currentRouteName() == 'edit.profile.pengguna') ? 'active' : '' }}" href="{{ route('edit.profile.pengguna',$pengguna->id) }}"><i class="fa fa-solid fa-user-pen"></i>&nbsp;&nbsp;Ubah Profile</a></li>
              <li class="nav-item"><a class="nav-link {{ (Route::currentRouteName() == 'edit.password.pengguna') ? 'active' : '' }}" href="{{ route('edit.password.pengguna',$pengguna->id) }}"><i class="fa-solid fa-key"></i>&nbsp;&nbsp;Ubah Kata Laluan</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              @yield('content.profile')
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->

</div>

{{-- </form> --}}
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection
