<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>Hello World</title>
    @vite('resources/js/app.js') <!-- Laravel Vite directive -->
</head>
<body>
    <div id="app"></div> <!-- Vue will mount here -->
    <script src="{{ mix('js/app.js') }}"></script>


    <!-- Vite -->
    @vite('resources/js/app.js')
</body>
</html>
