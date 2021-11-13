<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Recuperar contraseña |  Sistema de gestión documental </title>
    <!-- Bootstrap CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">-->
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}"><link href="https://file.myfontastic.com/2kvqVNHh2m6skzzqSmN93Z/icons.css" rel="stylesheet">
    <link href="/css/site.css" rel="stylesheet">
  </head>
  <body>
<div id="login">
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-12">
           <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <img src="/no_logo.png" alt="" class="logo">
                </div>

                <div class="panel-body row justify-content-md-center">
                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                             <br> <br>
                                <button type="submit" class="btn btn-danger">
                                    Recuperar contraseña
                                </button>
                                
                            </div>
                        </div>

                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                            
                                <a href="/" class="col-md-12 btn btn-danger">
                                    Login
                                </a>
                                
                            </div>
                        </div>

                    </form>

                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>

                

    <script src="{{ asset('lib/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('lib/popper.js/dist/popper.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>


<!--
                
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  --> </body>
</html>
