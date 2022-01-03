<nav class="main-navbar d-sm-block">
    <div class="container">
        <ul>
            <li
                class="menu-item">
                <a href="{{ route('pengguna') }}" class='menu-link {{ Request::is('pengguna') ? 'text-white' : 'text-warning' }}'>
                    <i class="bi bi-person-fill"></i>
                    <span>Pengguna</span>
                </a>
            </li>
            <li
                class="menu-item  has-sub">
                <a href="#" class='menu-link text-warning'>
                    <i class="bi bi-house-fill"></i>
                    <span>Beranda</span>
                </a>
                <div
                    class="submenu ">
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            <li
                                class="submenu-item  ">
                                <a href="table.html"
                                    class='submenu-link'>Daftar Buku</a>
                            </li>
                            <li
                                class="submenu-item  ">
                                <a href="table-datatable.html"
                                    class='submenu-link'>Tentang Kami</a>
                            </li>
                    </div>
                </div>
            </li>
            <li
                class="menu-item  has-sub">
                <a href="#" class='menu-link {{ Route::is('tambah-data*') ? 'text-white' : 'text-warning' }}'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Tambah Data</span>
                </a>
                <div
                    class="submenu ">
                    <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            <li
                                class="submenu-item  ">
                                <a href="{{ route('tambah-data.buku') }}"
                                    class='submenu-link'>Buku</a>
                            </li>
                            <li
                                class="submenu-item  ">
                                <a href="{{ route('tambah-data.kategori') }}"
                                    class='submenu-link'>Kategori</a>
                            </li>
                            <li
                                class="submenu-item  ">
                                <a href="{{ route('tambah-data.rak') }}"
                                    class='submenu-link'>Rak</a>
                            </li>
                    </div>
                </div>
            </li>
            <li
                class="menu-item  ">
                <a href="{{ route('anggota') }}" class='menu-link {{ Request::is('anggota') ? 'text-white' : 'text-warning' }}'>
                    <i class="bi bi-file-person-fill"></i>
                    <span>Anggota</span>
                </a>
            </li>
            <li
                class="menu-item  ">
                <a href="index.html" class='menu-link text-warning'>
                    <i class="bi bi-book-half"></i>
                    <span>Peminjaman Buku</span>
                </a>
            </li>
            <li
                class="menu-item  ">
                <a href="index.html" class='menu-link text-warning'>
                    <i class="bi bi-book-fill"></i>
                    <span>Pengembalian Buku</span>
                </a>
            </li>
            <li
                class="menu-item  text-warning">
                <a href="index.html" class='menu-link text-warning'>
                    <i class="bi bi-briefcase-fill"></i>
                    <span>Buku Saya</span>
                </a>
            </li>
            <li
                class="menu-item  ">
                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}" class='menu-link text-warning'>
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar </span>
                </a>
            </li>
        </ul>
    </div>
</nav>
