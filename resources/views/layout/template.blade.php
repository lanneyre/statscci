<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Stats Formation CCI</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/menu.css" rel="stylesheet">
    <link href="css/content.css" rel="stylesheet">


</head>

<body>
    <header>
        @include('layout.header')
        <section class="logo">
            <a href="{{ route('home') }}"><img src="/storage/logo.png" alt="Statistique CCI"></a>
        </section>
    </header>

    <main>
        @include('layout.msg')

        @yield('main')
    </main>
</body>

</html>
