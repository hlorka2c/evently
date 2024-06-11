<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Evently</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body style="padding: 16px;">
        <div class="container">
            @if (auth()->check())
                {{ auth()->user()->name }}
            @endif
            @if (!auth()->check())
                <a href='/login'>Войти</a>
                <a href='/register'>Регистрация</a>
            @else
                <a href='/logout'>Выйти</a>
            @endif
        </div>
        <div id="app">
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>

<style>
.container {
    max-width: 600px;
    margin: auto;
    width: 100%;
    margin-bottom: 20px;
}
</style>
