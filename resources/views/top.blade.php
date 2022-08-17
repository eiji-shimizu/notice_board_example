<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>notice board example</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
    </style>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}" defer></script>
</head>

<body>
    <div id="app">
        <h2>{{__('top')}}</h2>
        <header-component></header-component>
        <hello-component></hello-component>
    </div>
</body>

</html>