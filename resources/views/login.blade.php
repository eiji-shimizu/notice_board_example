<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>notice board example</title>

    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css">

</head>

<body>
    <div class="center_container">
        <div class="contents_area">
            <h2>{{__('login')}}</h2>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <form action="login" method="POST">
                <label for="email">{{__('email')}}</label><br>
                <input type="text" name="email"><br>
                <label for="password">{{__('password')}}</label><br>
                <input type="password" name="password"><br>
                <button type='submit'>{{__('login')}}</button>
                @csrf
            </form>
        </div>
    </div>
</body>

</html>