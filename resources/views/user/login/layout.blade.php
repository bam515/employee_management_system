<!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <title>직원 관리 시스템 - 로그인</title>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</head>
<body>
@include('user.include.header')
<main>
    <div class="container">
        @yield('content')
    </div>
</main>
@include('user.include.footer')
</body>
</html>
