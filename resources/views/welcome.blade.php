<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Task Manager - Welcome Page')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/media/image/favicon.png')}}"/>

    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{asset('vendors/bundle.css')}}" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="{{asset('assets/css/app.min.css')}}" type="text/css">
</head>
<body class="bg-white h-100-vh pt-0">

<div class="container h-100-vh">
    <div class="row align-items-md-center h-100-vh">
        <div class="col-lg-5 d-none d-lg-block">
            <img class="img-fluid" src="{{asset('assets/media/svg/mean_at_work.svg')}}" alt="image">
        </div>
        <div class="col-lg-6 offset-lg-1 text-center text-lg-left">
            <h2 class="display-4">Welcome To Task Manager!</h2>
            <p class="text-muted">Please click proceed.</p>
            <a href="{{route('task.index')}}" class="btn btn-primary">Proceed </a>
        </div>
    </div>
</div>

<!-- Plugin scripts -->
<!-- App scripts -->
<script src="{{asset('assets/js/app.min.js')}}"></script>
</body>
</html>
