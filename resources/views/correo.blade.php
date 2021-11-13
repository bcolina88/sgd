<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div style="width: 800px;margin: auto;position: relative;">
    <p align="center">
        <img src="http://186.30.87.133:8084/img/logo.png" alt="">
    </p>
    <p>
        {{Auth::user()->name}}:
    </p>
    <p>
        {{$mensaje}}
    <br><br><br>
    <p align="center">
        <a href="http://186.30.87.133:8084/modules/file/{{$file->id}}" style="
    background: #e30613;
    color: #fff;
    padding: 20px 50px;
    font-size: 17px;
    text-decoration: none;
" target="_blank">Descargar</a>
    </p>
</div>

</body>
</html>