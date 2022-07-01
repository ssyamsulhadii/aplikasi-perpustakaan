<nav class="main-navbar">
    <div class="container">
        <ul>
            <li
                class="menu-item ">
                <a href="{{ route('list-buku') }}" class='menu-link {{ Request::is('list-buku') ? 'text-white' : 'text-warning' }}'>
                    <i class="bi bi-house"></i>
                    <span>List Buku</span>
                </a>
            </li>
            @auth
                @if (auth()->user()->level_admin)
                <li
                    class="menu-item">
                    <a href="{{ route('pengguna') }}" class='menu-link {{ Request::is('pengguna') ? 'text-white' : 'text-warning' }}'>
                        <i class="bi bi-person"></i>
                        <span>Pengguna</span>
                    </a>
                </li>
                @endif
            @endauth

            @auth
                @if (auth()->user()->level_admin_buku)
                    <li
                        class="menu-item  has-sub">
                        <a href="#" class='menu-link {{ Route::is('tambah-data*') ? 'text-white' : 'text-warning' }}'>
                            <i class="bi bi-grid"></i>
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
                @endif
            @endauth

            @auth
                @if (auth()->user()->level_admin_transaksi)
                    <li
                        class="menu-item  ">
                        <a href="{{ route('anggota') }}" class='menu-link {{ Request::is('anggota') ? 'text-white' : 'text-warning' }}'>
                            <i class="bi bi-file-person"></i>
                            <span>Anggota</span>
                        </a>
                    </li>
                    <li
                        class="menu-item  ">
                        <a href="{{ route('peminjaman-buku') }}" class='menu-link {{ Request::is('peminjaman-buku') ? 'text-white' : 'text-warning' }}'>
                            <i class="bi bi-card-text"></i>
                            <span>Peminjaman Buku</span>
                        </a>
                    </li>
                    <li
                        class="menu-item  ">
                        <a href="{{ route('pengembalian-buku') }}" class='menu-link {{ Request::is('pengembalian-buku') ? 'text-white' : 'text-warning' }}'>
                            <i class="bi bi-card-checklist"></i>
                            <span>Pengembalian Buku</span>
                        </a>
                    </li>
                @endif
            @endauth

            @auth
                @if (auth()->user()->level_admin)
                    <li class="menu-item  text-warning">
                        <a href="{{ route('admin.laporan') }}" class='menu-link text-warning {{ Route::is('admin.laporan') ? 'text-white' : 'text-warning' }}'>
                            <i class="bi bi-file-earmark-text"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->level_id == 4)
                    <li class="menu-item  text-warning">
                        <a href="{{ route('list-buku-saya') }}" class='menu-link text-warning {{ Route::is('list-buku-saya') ? 'text-white' : 'text-warning' }}'>
                            <i class="bi bi-briefcase"></i>
                            <span>Buku Saya</span>
                        </a>
                    </li>
                    <li class="menu-item  text-warning">
                        <a href="{{ route('cetak.kartu-anggota', ['user'=>auth()->user()->id]) }}" class='menu-link text-warning' target="blank">
                            <i class="bi bi-person-bounding-box"></i>
                            <span>Cetak Kartu Anggota</span>
                        </a>
                    </li>
                @endif
            @endauth

            @auth
                    <li
                    class="menu-item  ">
                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}" class='menu-link text-warning'>
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Keluar </span>
                    </a>
                </li>
            @endauth

            @guest
                <li class="menu-item  ">
                    <a class='menu-link text-warning' href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Masuk </span>
                    </a>
                </li>
                <li class="menu-item  ">
                    <a class='menu-link text-warning' href="{{ route('register') }}">
                        <i class="bi bi-pencil"></i>
                        <span>Daftar </span>
                    </a>
                </li>
            @endguest
        </ul>
    </div>
</nav>
