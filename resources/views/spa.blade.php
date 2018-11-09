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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <script>
        window.adminUrl = '{{ config('bradmin.admin_url') }}';
        window.logoUrl = '{{ config('bradmin.logo') }}';
        window.logoMiniUrl = '{{ config('bradmin.logo_mini') }}';
    </script>
    <script src="{{ asset('packages/bradmin/js/ckeditor/ckeditor.js') }}"></script>

    <link src="{{ asset('packages/bradmin/js/datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet">

    <link href="{{ asset('packages/bradmin/js/dropzone/dropzone.min.css') }}" rel="stylesheet">
    <script src="{{ asset('packages/bradmin/js/dropzone/dropzone.min.js') }}"></script>

    <link href="{{ asset('packages/bradmin/js/jquery-ui/jquery-ui.css') }}" rel="stylesheet">


    <link href="{{ asset('packages/bradmin/js/insertMedia/insertMedia.css') }}" rel="stylesheet">


    <title>{{ config('bradmin.title') }}</title>
</head>
<body>
<div id="app">
    <app></app>
</div>
<script src="{{ asset('packages/bradmin/js/app.js') }}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="{{ asset('packages/bradmin/js/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('packages/bradmin/js/insertMedia/insertMedia.js') }}"></script>
<script src="{{ asset('packages/bradmin/js/datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('packages/bradmin/js/datepicker/locales/bootstrap-datepicker.ru.min.js') }}"></script>
</body>
</html>