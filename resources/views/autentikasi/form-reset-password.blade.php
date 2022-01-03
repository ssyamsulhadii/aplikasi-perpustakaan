
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
                <div class="col-lg-6 col-md-6 col-sm-8">
                    <div class="card shadow">
                        <div class="row p-4">
                            <div class="col-lg-3 col-md-4 col-12 text-center">
                                <img class="card-img-top img-fluid" src="{{ asset('assets/images/logo/logo-disperpus.png') }}" alt="Logo" style="width: 100px">
                            </div>
                            <div class="col-lg-9 col-md-8 col-12">
                                <h4 class="card-title">Dinas Kearsipan dan Perpustakaan Kota kapuas</h4>
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ request()->token }}">
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
                                    <button type="submit" class="btn btn-primary text-center">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
