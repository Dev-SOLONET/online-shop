<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="{{ url('argon/assets/img/brand/blue.png') }}" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.stok.index') }}">
                <i class="ni ni-bag-17 text-primary"></i>
                <span class="nav-link-text">Stok Barang</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.barang.index')}}">
                <i class="ni ni-bag-17 text-primary"></i>
                <span class="nav-link-text">Barang</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.kategori.index') }}">
                <i class="ni ni-archive-2 text-primary"></i>
                <span class="nav-link-text">Kategori</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.transaksi.index') }}">
                <i class="ni ni-briefcase-24 text-primary"></i>
                <span class="nav-link-text">Penjualan</span>
              </a>
            </li>
        </div>
      </div>
    </div>
  </nav>