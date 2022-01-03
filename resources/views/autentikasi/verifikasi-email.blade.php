
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
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('Coba refresh, tautan verifikasi telah dikirim ke email kamu') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <p class="card-text">
                                        Silakan periksa email kamu, untuk tautan verifikasi email.
                                        Jika kamu tidak menerima verifikasi email.
                                    </p>
                                    <button type="submit" class="btn btn-primary text-center">klik disini untuk memverifikasi email</button>
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
