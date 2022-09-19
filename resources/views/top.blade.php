<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>notice board example</title>

    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css">

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}" defer></script>
</head>

<body>
    <div id="app">
        <h2>{{__('top')}}</h2>
        <header-component></header-component>
        <br>
        <item-list-component></item-list-component>
        <modal-component component-name='add-item-component' flag-name='isAddItemShow'></modal-component>
    </div>
</body>

</html>