<!doctype html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/keyboard-icon-colored-symbol-premium-quality-isolated-keypad-element-in-trendy-style-700-151153012.ico')}}">

    <!-- Fontawesome -->
    <link type="text/css" href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Notyf -->
    <link type="text/css" href="{{asset('assets/vendor/notyf/notyf.min.css')}}" rel="stylesheet">

    <!-- Cropper -->
    <link rel="stylesheet" href="{{asset('assets/vendor/cropper/cropper.min.css')}}">

    <!-- App -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>
<body>
@yield('header')

@yield('content')

<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="container">
        <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <svg class="bi" width="30" height="24">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>
            <span class="text-muted">© 2021 Company, Inc</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-muted" href="#">
                    <svg class="bi" width="24" height="24">
                        <use xlink:href="#twitter"></use>
                    </svg>
                </a></li>
            <li class="ms-3"><a class="text-muted" href="#">
                    <svg class="bi" width="24" height="24">
                        <use xlink:href="#instagram"></use>
                    </svg>
                </a></li>
            <li class="ms-3"><a class="text-muted" href="#">
                    <svg class="bi" width="24" height="24">
                        <use xlink:href="#facebook"></use>
                    </svg>
                </a></li>
        </ul>
    </div>
</footer>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- Notyf -->
<script src="{{asset('assets/vendor/notyf/notyf.min.js')}}"></script>

<!-- Bootstrap -->
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>--}}

<!-- Cropper -->
<script src="{{asset('assets/vendor/cropper/cropper.min.js')}}"></script>

<!-- App -->
<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
