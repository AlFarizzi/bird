<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    foreach ($data as $key => $value) {
        echo "<p>$value->id, $value->nama,, $value->alamat</p>";
    }

?>
    <form action="/post" method="post">
        <input type="text" name="name" id="">
        <input type="email" name="email" id="">
        <input type="password" name="password" id="">

        <button type="submit">tekan</button>
    </form>
</body>
</html>