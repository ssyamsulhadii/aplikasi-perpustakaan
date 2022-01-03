<header class="mb-3">
    <div class="header-top pt-2 pb-2">
        <div class="container">
            <div>
                <img src="{{ asset('assets/images/logo/logo-disperpus.png') }}" alt="Logo" width="55px" height="60px" srcset="">
                <div class="text-left d-lg-inline h4 d-none">
                    Dinas Kearsipan dan Perpustakaan
                </div>
            </div>
            <div class="header-top-right">
                <div class="dropdown">
                    <a href="#" class="user-dropdown d-flex dropend" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-md2">
                            <img src="{{ auth()->user()->profil_gambar }}" alt="Avatar">
                        </div>
                        <div class="text">
                            <h6 class="user-dropdown-name" id="namaHeader">{{ auth()->user()->nama }}</h6>
                            <p class="user-dropdown-status text-sm text-muted">{{ auth()->user()->string_level }}</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item" href="{{ route('profil') }}">Profil Saya</a></li>
                      <li><a class="dropdown-item" href="{{ route('ganti-password') }}">Ganti Password</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                          <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}">Keluar</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- Burger button responsive -->
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </div>
        </div>
    </div>
    @include('layouts.parsial.navbar')

</header>
