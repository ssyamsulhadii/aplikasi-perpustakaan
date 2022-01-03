
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Perpustakaan | Masuk</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
</head>

<body>
    <div id="auth">
        <div class="row">
            <div class="container d-flex justify-content-center p-2">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <x-autentikasi.logo teks="Silakan isi inputan form untuk mendaftar sebagai anggota baru"/>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group position-relative has-icon-left mb-4">
                                <x-autentikasi.input-group type="text" placeholder="Nama Lengkap"  name="nama" icon="bi-pen" />
                                 <x-autentikasi.error-message error="nama" />
                             </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <x-autentikasi.input-group type="text" placeholder="Alamat Email"  name="email" icon="bi-envelope" />
                                 <x-autentikasi.error-message error="email" />
                             </div>
                             <div class="form-group position-relative has-icon-left mb-4">
                                <x-autentikasi.input-group type="password" placeholder="Password"  name="password" icon="bi-shield-lock" />
                                <x-autentikasi.error-message error="password" />
                            </div>
                             <div class="form-group position-relative has-icon-left mb-3">
                                <x-autentikasi.input-group value="" type="password" placeholder="Konfirmasi Password"  name="password_confirmation" icon="bi-shield-lock" />
                            </div>
                            <button class="btn btn-primary btn-block shadow-lg mt-1">Daftar</button>
                        </form>
                        <p class="text-gray-600 mt-2">Sudah mempunyai akun ! <a href="{{ route('login') }}" class="font-bold">masuk</a>.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
