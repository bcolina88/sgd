<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Importacion</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    @if(Session::has("mensaje"))
        <script>
            alert({{Session::get("mensaje")}})
        </script>
    @endif
    <div class="container py-5">

        <h3>Importación modulo {{$module->name}}</h3>

        <div class="row justify-content-end">
            <div class="col-2">
                <a href="/import/{{$module->id}}/getTemplate" class="btn btn-primary">Descargar Plantilla</a>
            </div>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row">

                <div class="col-12">
                    <label for="">Importar archivo</label>
                    <input type="file" name="file" class="form-control">
                </div>

                <div class="col-12">
                    <label for="">Separador</label>
                    <input type="text" name="separador" class="form-control" value=",">
                </div>

            </div>

            <div class="row py-4">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary col-12">Comenzar la importación</button>
                </div>
            </div>
        </form>

    </div>

<script type="text/javascript" src="/lib/jquery/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="/lib/tether/js/tether.min.js"></script>
<script type="text/javascript" src="/lib/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>