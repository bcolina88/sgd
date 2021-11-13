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
                <h5>Crear nuevo usuario</h5>
                <form action="/crearNuevoUsuario" method="post">
                   {{csrf_field()}}
                   <h6>Datos ingreso</h6>
                   
                   
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name='email' aria-describedby="emailHelp" placeholder="Email" value='{{old("email")}}'>

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
                                <option value="{{$rol->id}}">{{$rol->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="modules">Modulos (Que puede visualizar)</label>
                        <select class="form-control" id="modules" name="modules[]" multiple>
                            @foreach(\App\Http\Controllers\ModulesController::getModules() as $module)
                                <option value="{{$module->id}}">{{$module->name}}</option>
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
                                            <option value="{{$index}}">{{$empresa}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="cargo">Cargo</label>
                        <input type="text" class="form-control" id="cargo" name="cargo" aria-describedby="emailHelp" placeholder="Cargo"  value='{{old("cargo")}}'>

                    </div>

                    <div class="col-xs-12">
                        <h6>Datos personales</h6>
                    </div>

                   <div class="form-group col-md-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="name" aria-describedby="emailHelp" placeholder="Nombre"  value='{{old("name")}}'>

                    </div>
                   
                    <div class="form-group col-md-6">
                        <label for="genero">Genero</label>
                        <select class="form-control" id="genero" name="gender">
                            <option value=""></option>
                            <option value="1">Masculino</option>
                            <option value="2">Femenino</option>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="address" aria-describedby="emailHelp" placeholder="Dirección"  value='{{old("address")}}'>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" class="form-control" id="ciudad" name="city" aria-describedby="emailHelp" placeholder="Ciudad"  value='{{old("city")}}'>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="country">País</label>
                        <input type="text" class="form-control" id="country" aria-describedby="emailHelp" placeholder="Pais"  value='{{old("country")}}'>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="telefono1">Teléfono fijo</label>
                        <input type="number" class="form-control" id="telefono1" name="phone1" placeholder="Telefono fijo" aria-describedby="emailHelp"  value='{{old("phone1")}}'>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="telefono2">Teléfono móvil:</label>
                        <input type="number" class="form-control" id="telefono2" name="phone2" placeholder="Teléfono móvil" aria-describedby="emailHelp" value='{{old("phone2")}}'>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="type_doc">Tipo de documento</label>
                        <select class="form-control" id="type_doc" name="type_doc">
                            <option value=""></option>
                            <option value="1">Cédula de ciudadania</option>
                            <option value="2">Cédula de extranjeria</option>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="doc">Numero de documento de identidad</label>
                        <input type="text" class="form-control" id="doc" name="doc" aria-describedby="emailHelp" placeholder="Documento" value='{{old("doc")}}'>

                    </div>

                    <div class="form-group col-md-6">
                        <label for="nacimiento">Fecha de nacimiento</label>
                        <input type="text" class="form-control mydatepicker" id="nacimiento" name="birthday" aria-describedby="emailHelp"  value='{{old("birthday")}}'>

                    </div>

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