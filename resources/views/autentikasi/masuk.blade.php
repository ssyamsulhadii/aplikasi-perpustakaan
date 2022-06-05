
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
            <div class="container d-flex justify-content-center p-4">
                <div class="col-lg-4 col-md-6 col-sm-8">
                        <x-autentikasi.logo teks="Silakan isi inputan form untuk masuk kewebsite"/>
                        @if (session()->has('pesan'))
                            <div class="alert alert-light-info p-2 text-center" role="alert">
                                <strong>
                                    {{ session()->get('pesan') }}
                                </strong>
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group position-relative has-icon-left mb-4">
                               <x-autentikasi.input-group type="text" placeholder="Alamat Email"  name="email" icon="bi-envelope" />
                                <x-autentikasi.error-message error="email" />
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <x-autentikasi.input-group type="password" placeholder="Password"  name="password" icon="bi-shield-lock" />
                                <x-autentikasi.error-message error="password" />
                            </div>
                            <button type="submit" class="btn btn-primary btn-block shadow-lg mt-2">Masuk</button>
                        </form>
                        <p class="text-gray-600 mt-2">Belum mempunyai akun ? <a href="{{ route('register') }}" class="font-bold">daftar</a>.</p>
                        {{-- <p class="text-gray-600 mt-2"><a href="{{ route('password.request') }}" class="font-bold">Lupa password</a>.</p> --}}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
