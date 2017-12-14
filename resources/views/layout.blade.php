<?php
/**
 * TESTE DE LARAVEL
 * CIATÉCNICA
 *
 * @author      Alexandre de Freitas Caetano <https://github.com/aledefreitas>
 */
?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Teste Laravel</title>

        <link href='/css/app.css' rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
        <script src="/js/app.js" type="text/javascript"></script>
    </body>
</html>
