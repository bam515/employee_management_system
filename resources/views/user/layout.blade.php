<!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>직원 관리 시스템</title>
    <script src="https://code.jquery.com/jquery-3.6.4.js"
            integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
            crossorigin="anonymous"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</head>
<body class="bg-secondary">
<main>
    <div class="container">
        @yield('content')
    </div>
</main>
</body>
</html>
