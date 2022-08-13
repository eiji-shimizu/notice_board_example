<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>notice board example</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
    </style>

</head>

<body>
    <h2>{{__('userRegistration')}}</h2>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <form action="/noticeboard/register" method="POST">
        <input type="text" name="name">
        <input type="text" name="email">
        <input type="text" name="password">
        <button type='submit'>{{__('userRegistration')}}</button>
        @csrf
    </form>
</body>

</html>