<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/modules/izitoast/css/iziToast.min.css') }}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/components.css') }}">
    <style>
        .has-error > label, .has-error > div.d-block > label {
            color: #dd4b39;
        }

        .has-error > input, .has-error > input:focus {
            border-color: #dd4b39;
        }

        .help-block {
            color: #dd4b39;
        }
    </style>

    @stack('styles')
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>
<body>
<div id="app">
    <section class="section">
        @yield('content')
    </section>
</div>

<!-- General JS Scripts -->
<script src="{{ asset('/modules/jquery.min.js') }}"></script>
<script src="{{ asset('/modules/popper.js') }}"></script>
<script src="{{ asset('/modules/tooltip.js') }}"></script>
<script src="{{ asset('/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('/modules/moment.min.js') }}"></script>
<script src="{{ asset('/js/stisla.js') }}"></script>

<!-- JS Libraies -->
<script src="{{ asset('/modules/izitoast/js/iziToast.min.js') }}"></script>

<!-- Page Specific JS File -->
@stack('scripts')

<!-- Template JS File -->
<script src="{{ asset('/js/scripts.js') }}"></script>

<script>
    $(function() {
        @if(session('error'))
        iziToast.error({
            title: "{{ session('error') }}",
            position: 'topRight'
        });
        @endif

        @if(session('success'))
        iziToast.success({
            title: "{{ session('success') }}",
            position: 'topRight'
        });
        @endif
    });
</script>
</body>
</html>