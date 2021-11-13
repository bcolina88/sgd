@extends('layouts.app')

@section("css")
    <style>
        .selectEmpresa{
            display: none;
        }
        .selectEmpresa.active{
            display: block;
        }
    </style>
@endsection

@section('content')
<div class="site-content">
    <!-- Content -->
    
    @include("messages")
    <div class="content-area p-y-1">



        <div class="container-fluid">

            <div class="box box-block bg-white">
                <h5>Editar nuevo usuario</h5>
                <form action="/user/edit" method="post">
                   {{csrf_field()}}
                   <h6>Datos ingreso</h6>
                   
                   
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name='email' aria-describedby="emailHelp" placeholder="Email" value='{{$user->email}}'>

                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name='password' aria-describedby="emailHelp" placeholder="Contraseña">

                    </div>

                    <div class="form-group col-md-6">
                        <label for="rol">Rol</label>
                        <select class="form-control" id="rol" name="rol">
                            <option value=""></option>
                            @foreach(App\Roles::all() as $rol)
                                <option value="{{$rol->id}}" {{$user->role_id == $rol->id ? "selected" : ""}}>{{$rol->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="modules">Modulos (Que puede visualizar)</label>
                        <select class="form-control" id="modules" name="modules[]" multiple>
                            @foreach(\App\Http\Controllers\ModulesController::getModules() as $module)
                                <option value="{{$module->id}}" {{\App\Http\Controllers\UserController::seeModule($module->id, $user->id) ? "selected" : ""}}>{{$module->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <div class="row">
                            @foreach(\App\Http\Controllers\ModulesController::getModules() as $module)
                                <div class="col-md-4 selectEmpresa" id="empresa{{$module->id}}">
                                    <label>Empresas {{$module->name}} (Que puede visualizar)</label>
                                    <select class="form-control" name="empresas[{{$module->id}}][]" multiple style="overflow: auto;">
                                        @foreach(json_decode($module->fields->where("name", "Empresa")->last()->data) as $index => $empresa)
                                            <option value="{{$index}}" {{\App\Http\Controllers\UserController::seeModuleEmpresa($module->id, $index, $user->id) ? "selected" : ""}}>{{$empresa}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="form-group col-md-12">
                        <label for="cargo">Cargo</label>
                        <input type="text" class="form-control" id="cargo" name="cargo" aria-describedby="emailHelp" placeholder="Cargo"  value='{{$user->cargo}}'>

                    </div>
                   
                   <h6>Datos personales</h6>
                   
                   <div class="form-group col-md-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="name" aria-describedby="emailHelp" placeholder="Nombre"  value='{{$user->name}}'>

                    </div>
                   
                    <div class="form-group col-md-6">
                        <label for="genero">Genero</label>
                        <select class="form-control" id="genero" name="gender">
                            <option value=""></option>
                            <option value="1"  @if($user->gender == 1) selected @endif>Masculino</option>
                            <option value="2"  @if($user->gender == 2) selected @endif>Femenino</option>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="address" aria-describedby="emailHelp" placeholder="Dirección"  value='{{$user->address}}'>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" class="form-control" id="ciudad" name="city" aria-describedby="emailHelp" placeholder="Ciudad"  value='{{$user->city}}'>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="country">País</label>
                        <input type="text" class="form-control" id="country" aria-describedby="emailHelp" placeholder="Pais"  value='{{$user->country}}'>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="telefono1">Teléfono fijo</label>
                        <input type="number" class="form-control" id="telefono1" name="phone1" placeholder="Telefono fijo" aria-describedby="emailHelp"  value='{{$user->phone1}}'>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="telefono2">Teléfono móvil:</label>
                        <input type="number" class="form-control" id="telefono2" name="phone2" placeholder="Teléfono móvil" aria-describedby="emailHelp" value='{{$user->phone2}}'>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="type_doc">Tipo de documento</label>
                        <select class="form-control" id="type_doc" name="type_doc">
                            <option value=""></option>
                            <option value="1" @if($user->type_identification == 1) selected @endif>Cédula de ciudadania</option>
                            <option value="2" @if($user->type_identification == 2) selected @endif>Cédula de extranjeria</option>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="doc">Numero de documento de identidad</label>
                        <input type="text" class="form-control" id="doc" name="doc" aria-describedby="emailHelp" placeholder="Documento" value='{{$user->identification}}'>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="nacimiento">Fecha de nacimiento</label>
                        <input type="text" class="form-control mydatepicker" id="nacimiento" name="birthday" aria-describedby="emailHelp"  value='{{$user->birthday}}'>

                    </div>
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <button type="submit" class="btn btn-primary btn-block">Crear usuario</button>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endsection

@section("script")
    <script>
        jQuery(document).ready(function(){
            var data = jQuery("#modules").val()
            for(var x in data){
                jQuery("#empresa"+data[x]).addClass("active")
            }

            jQuery("#modules").on("change", function(){
                jQuery(".selectEmpresa.active").removeClass("active")
                var data = jQuery(this).val()
                for(var x in data){
                    jQuery("#empresa"+data[x]).addClass("active")
                }

            })
        })

    </script>
@endsection