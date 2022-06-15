<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{asset('assets/css/semantic.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.min.css')}}">
    @yield('meta')
    @yield('css')
    <title>@yield('title')</title>
</head>


<body>
    @yield('content')
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/js/semantic.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    @yield('script')

</body>

</html>