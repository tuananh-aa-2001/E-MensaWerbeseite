<!doctype html>
<html lang="de">
<head>
    <title>{{ $title }} - @yield('title')</title>
</head>
<body>
<header>
    <div style="background-color: cadetblue">
        @section('header')
        @show
    </div>
</header>
<section class="main-content">
    @section('main-content')
    @show
</section>
<footer>
    @section('footer')
    @show
</footer>
</body>
</html>

<?php
