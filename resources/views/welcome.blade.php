<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>

<h1 class="text-3xl font-bold underline">
    Hello world!
</h1>
<label>
    <input type="checkbox" checked> Browser default
</label>
<label>
    <input type="checkbox" class="accent-pink-500" checked> Customized
</label>
</body>
</html>
