<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel=stylesheet>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link href="{{ asset('packages/bradmin/css/app.css') }}" rel="stylesheet">
    <script>
        window.adminUrl = '{{ config('bradmin.admin_url') }}';
        window.logoUrl = '{{ config('bradmin.logo') }}';
        window.logoMiniUrl = '{{ config('bradmin.logo_mini') }}';
    </script>
    <title>{{ config('bradmin.title') }}</title>
</head>
<body>
<div id="app">
    <app></app>
</div>
<script src="{{ asset('packages/bradmin/js/app.js') }}"></script>
</body>
</html>