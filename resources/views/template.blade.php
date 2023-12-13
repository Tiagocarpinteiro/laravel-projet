<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mama le plus bo</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/app.css') }}" />
</head>

<body>

<header>
    <h1>Mon super album</h1>
    <nav>
        <a href="/">Home</a>
        <a href="/albums">Albums</a>
    </nav>
</header>

<main>
    @yield("content")
</main>

</body>

</html>
