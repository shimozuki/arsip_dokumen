<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">siArsip</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
        <li><a class="nav-link" href="/dashboard"><i class="fas fa-tachometer-alt"></i> <span>Home</span></a></li>
      </li>
      @if (auth()->user()->role == 2)
      <li class="menu-header">Informasi Desa</li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-import"></i><span>Informasi Desa</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="/program">Program Tahunan</a></li>
            <li><a class="nav-link" href="/bansos">Penerima Bantuan</a></li>
          </ul>
        </li>
      </li>
      <li class="menu-header">Dokumen</li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-import"></i><span>Serah Terima</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="/serahTerima">My Data</a></li>
            <!-- <li><a class="nav-link" href="/serahTerima/create">Tambah Data</a></li> -->
          </ul>
        </li>
      </li>
      @endif
      @if (auth()->user()->role == 1)
      <li class="menu-header">Arsip</li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-import"></i><span>Data Arsip</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="/dataArsip">List Data</a></li>
            <li><a class="nav-link" href="/dataArsipImport">List Data Import</a></li>
            <li><a class="nav-link" href="/dataArsip/create">Tambah Data Arsip</a></li>
          </ul>
        </li>
      </li>
      @endif
      @if (auth()->user()->role == 1)
        <li class="menu-header">Jenis Dokumen</li>
            <li><a class="nav-link" href="/jenisDokumen"><i class="far fa-file-code"></i><span>Jenis Dokumen</span></a></li>
        </li>
      @endif
      @if (auth()->user()->role == 1)
        <li class="menu-header">Peminjaman Dokumen</li>
            <li><a class="nav-link" href="/peminjaman"><i class="far fa-file-code"></i><span>Data Peengajuan</span></a></li>
        </li>
      @endif
      @if (auth()->user()->role == 0)
        <li class="menu-header">Data Users</li>
            <li><a class="nav-link" href="/users/list"><i class="far fa-file-code"></i><span>Data Users</span></a></li>
        </li>
      @endif
      @if (auth()->user()->role == 1)
        <li class="menu-header">Rak</li>
            <li><a class="nav-link" href="/rak"><i class="fas fa-archive"></i><span>Data Rak</span></a></li>
        </li>
      @endif
      @if (auth()->user()->role == 1)
      
      <li class="menu-header">Dusun</li>
      <li class="nav-item dropdown">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-home"></i><span>Data Dusun</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="/perusahaan">List Dusun</a></li>
            <li><a class="nav-link" href="/get/programtahunan">Program Tahunan</a></li>
            <li><a class="nav-link" href="/bansos">Penerima Bansos</a></li>
          </ul>
        </li>
      </li>
      @endif
    
    </ul>

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <form action="{{ route('logout') }}" method="post">
          @csrf
          <button type="submit" class="btn btn-primary btn-lg btn-block btn-icon-split"><i class="fas fa-sign-out-alt"></i>Logout</button>
        </form> 
      </div>
  </aside>