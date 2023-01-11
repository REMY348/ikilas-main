@extends('admin.profile.index')

@section('content.profile')
    
<!-- Profile Image -->
<div class="row justify-content-center">
  <div class="col-8">
<div class="card card-dark card-outline">
  <div class="card-body box-profile">
    <div class="text-center">
      <img class="profile-user-img img-fluid img-circle"
           src="{{ asset('assets/profile_image/default/default_profile.png') }}"
           alt="User profile picture">

    </div>

    <h3 class="profile-username text-center">{{ $pengguna->name }}</h3>

    <h1 class="profile-username text-center"><small>{{ ($pengguna->jawatan_id == NULL) ? '(Tiada Rekod Jawatan)' : $pengguna->jawatan->name }}</small></h1>

    <p class="text-muted text-center">{{ $pengguna->email }}</p>

    <ul class="list-group list-group-unbordered mb-3">
      <li class="list-group-item">
        <b>No. Telefon</b> <span class="float-right badge-pill badge-dark"><small></small>{{ ($pengguna->no_tel == NULL) ? 'Tiada Rekod No. Telefon' : $pengguna->no_tel}}</span>
      </li>
      <li class="list-group-item">
        <b>Jantina</b> <span class="float-right badge-pill badge-dark">{{ ($pengguna->jantina == NULL) ? 'Tiada Rekod Jantina' : $pengguna->jantina}}</span>
      </li>
      <li class="list-group-item">
        <b>No. Kad Pengenalan</b> <span class="float-right badge-pill badge-dark">{{ ($pengguna->no_kp == NULL) ? 'Tiada Rekod No. Kad Pengenalan' : $pengguna->no_kp}}</span>
      </li>
      <li class="list-group-item">
        <b>Jabatan</b> <span class="float-right badge-pill badge-dark">{{ ($pengguna->jabatan == NULL) ? 'Tiada Rekod Jabatan' : $pengguna->jabatan->name}}</span>
      </li>
      <li class="list-group-item">
        <b>Peranan</b> <span class="float-right badge-pill badge-dark">{{ ($pengguna->role == NULL) ? 'Tiada Rekod Peranan' : $pengguna->role}}</span>
      </li>
    </ul>
  </div>
  <!-- /.card-body -->
</div>
</div>
</div>
<!-- /.card -->

@endsection
