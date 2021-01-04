<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Hai</h1>
    <form action="/post" method="post">
        <input type="text" name="name" id="">
        <input type="text" name="email" id="">
        <input type="text" name="password" id="">
        <button type="submit">Send</button>
    </form>
    @foreach ($data as $item)
        <p>{{$item->name}}</p>
    @endforeach
</body>
</html>