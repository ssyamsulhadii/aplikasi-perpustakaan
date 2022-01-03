<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>
@livewireStyles
<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            @include('layouts.parsial.header')
            <div class="content-wrapper container">
                {{ $slot }}
            </div>
            @include('layouts.parsial.footer')
        </div>
    </div>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
    <script src="{{ asset('assets/js/mazer.js') }}"></script>
    <script src="{{ asset('assets/js/pages/horizontal-layout.js') }}"></script>
    @livewireScripts
    @stack('script')
    <script>

        window.addEventListener('pesan', event => {
            Toastify({
                text: event.detail.teks,
                duration: 2000,
                gravity: "bottom", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                backgroundColor: event.detail.background ?? "linear-gradient(to right, #00b09b, #96c93d)",
            }).showToast();
        });


// ini merupakan proses pengganti jquery $(docoument).ready{}
//  start ===>
        if (window.attachEvent) {
            window.attachEvent('onload', windowOnLoad);
        }
        else if (window.addEventListener)
            {window.addEventListener('load', windowOnLoad, false);
        }
        else {
            document.addEventListener('load', windowOnLoad, false);
        }
        function windowOnLoad(){
            Livewire.on('namaBaru', (nama) => {
                document.getElementById("namaHeader").innerHTML = nama;
            });

        }
// ===> end

    </script>

</body>

</html>
