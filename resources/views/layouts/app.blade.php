<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ToDoList</title>

    <!-- Стили Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous"
    >

    <!-- Иконка для информера "Alert danger" -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>

    <link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css">
    <script defer src="{{mix('js/app.js')}}" ></script>
</head>
<body>
    <nav class="navbar navbar-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                ToDoList
            </a>
            @yield('nav')
        </div>
    </nav>
    <div class="py-5">
        <div class="container @guest w-25 @endguest">
            @yield('form')
        <div>
    </div>
</body>
</html>
