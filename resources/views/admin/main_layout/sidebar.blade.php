<!-- Brand Logo -->
<a href="{{ route('dashboard') }}" class="brand-link bg-warning">
    <img src="{{ asset('assets/mpk_logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><b>i-KILAS</b></span>
  </a>

  @php
  $prefix=trim(Request::route()->getPrefix(),'/');
  // $modelname = Request::route();
  $modelname = collect(request()->segments())->last();
  $modelname2 = Request::segment(2);
  $uriname = Request::route()->uri();
  @endphp

  <!-- Sidebar -->
  <div class="sidebar sidebar-dark-warning">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets/profile_image/default/default_profile.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    {{-- <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2 side">
      <ul class="nav nav-pills nav-sidebar flex-column  nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ ($uriname == 'dashboard') ? 'active' : '' }}">
            <i class="fa fa-solid fa-chart-line nav-icon"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">PENTADBIR</li>
        <li class="nav-item {{ ($prefix == 'pentadbiran') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ ($prefix == 'pentadbiran') ? 'active' : '' }}">
            {{-- <i class="nav-icon fa fa-file"></i> --}}
            <i class="fa fa-users-gear  nav-icon"></i>
            <p>
              Pentadbir
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('all.jabatan') }}" class="nav-link {{ ($modelname2 == 'jabatan') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p><small>Tambah Jabatan</small></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('all.jawatan') }}" class="nav-link {{ ($modelname2 == 'jawatan') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p><small>Tambah Jawatan</small></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.all.pengguna') }}" class="nav-link {{ ($modelname2 == 'pengguna') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p><small>Tambah Pengguna</small></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.all.kategorimaklumat') }}" class="nav-link {{ ($modelname2 == 'kategori maklumat') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p><small>Kategori Maklumat</small></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.all.kategorisaluran') }}" class="nav-link {{ ($modelname2 == 'kategori saluran') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p><small>Kategori Saluran</small></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.all.jenispengemaskinian') }}" class="nav-link {{ ($modelname2 == 'jenis pengemaskinian') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p><small>Jenis Pengemaskinian</small></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.all.jenisaduan') }}" class="nav-link {{ ($modelname2 == 'jenis aduan') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p><small>Jenis Aduan</small></p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">PROFIL</li>
        <li class="nav-item {{ ($prefix == 'pengguna') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ ($prefix == 'pengguna') ? 'active' : '' }}">
            <i class="fa-solid fa-user-gear nav-icon"></i>
            <p>
              Profil
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          @php
              $user = Auth::user()->id;
          @endphp
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('profile.pengguna',$user) }}" class="nav-link {{ ($prefix == 'pengguna') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p><small>Profil Pengguna</small></p>
              </a>
            </li>
          </ul>
        </li>
        
        <li class="nav-header">PERMOHONAN</li>
        <li class="nav-item {{ ($prefix == 'permohonan') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ ($prefix == 'permohonan') ? 'active' : '' }}">
            <i class="nav-icon fa-solid fa-file-contract"></i>
            <p>
              Permohonan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          @php
              $user = Auth::user()->id;
          @endphp
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('all.permohonan.lamanweb') }}" class="nav-link {{ ($prefix == 'permohonan') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p><small>Laman Web</small></p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p><small>Aduan</small></p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">SOKONGAN</li>
        <li class="nav-item {{ ($prefix == 'sokongan') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ ($prefix == 'sokongan') ? 'active' : '' }}">
            <i class="fa-solid fa-file-signature nav-icon"></i>
            <p>
              Sokongan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          @php
              $user = Auth::user()->id;
          @endphp
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('all.sokongan.lamanweb') }}" class="nav-link {{ ($prefix == 'sokongan') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p><small>Laman Web</small></p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p><small>Aduan</small></p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">KELULUSAN</li>
        <li class="nav-item {{ ($prefix == 'kelulusan') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ ($prefix == 'kelulusan') ? 'active' : '' }}">
            <i class="nav-icon fa-solid fa-file-circle-check"></i>
            <p>
              Kelulusan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          @php
              $user = Auth::user()->id;
          @endphp
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('all.kelulusan.lamanweb') }}" class="nav-link {{ ($prefix == 'kelulusan') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p><small>Laman Web</small></p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p><small>Aduan</small></p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">Laporan</li>
        <li class="nav-item">
          <a href="{{ route('all.laporan.lamanweb') }}" class="nav-link">
            <i class="nav-icon fa-solid fa-file-pdf"></i>
            <p>
              Laman Web
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Aduan
            </p>
          </a>
        </li>

        <li class="nav-item menu-open">
          <a href="{{ route('logout') }}" class="nav-link active text-white" style="background:#E60014">
            <i class="fa-solid fa-lock nav-icon"></i>
            <p>
              Log Keluar
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->