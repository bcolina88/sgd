@extends('layouts.app')

@section('content')
<div class="site-content">
    <!-- Content -->
    <form action="/editar/userAuth" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="content-area p-y-1">
        <div class="container-fluid">
            <div class="row row-md m-b-1">
                <div class="col-md-12">
                    <div class="box bg-white user-1">
                        <div class="u-img img-cover" style="background-image: url(img/photos-1/4.jpg);"></div>
                        <div class="u-content">
                            <div class="avatar box-128">
                                <img class="b-a-radius-circle shadow-white" src="{{is_null(Auth::user()->avatar) ? '/img/Sin_foto.png' : '/avatar/'.Auth::id() }}" alt="" id='previewAvatar'>
                                <i class="status bg-success bottom right"></i>
                            </div>
                            <h5><a class="text-black" href="#">{{Auth::user()->name}}</a></h5>
                            <p class="text-muted p-b-0-5">{{Auth::user()->cargo}}</p>
                            <div class="text-xs-center p-b-0-5">
                                <label class="btn btn-outline-primary btn-rounded m-r-0-5" for="avatar">Cargar foto de perfil <i class="ti-plus m-l-0-5"></i></label>
                                <input type="file" name="avatar" style='display:none' id='avatar' capture>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>



        <div class="container-fluid">

            <div class="box box-block bg-white">
                <h5>Complete su perfil</h5>
                <p class="font-90 text-muted m-b-1">Para Opegin es muy importante tener su informacion actualizada</p>

                <div class="form-group col-md-6">
                        <label for="gender">Genero</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="1" @if(Auth::user()->gender == 1) selected @endif>Masculino</option>
                            <option value="2" @if(Auth::user()->gender == 2) selected @endif>Femenino</option>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" aria-describedby="emailHelp" placeholder="Ingrese su dirección" value="{{Auth::user()->address}}">

                    </div>

                    <div class="form-group col-md-6">
                        <label for="city">Ciudad</label>
                        <input type="text" class="form-control" id="city" name="city" aria-describedby="emailHelp" placeholder="Ingrese su ciudad" value="{{Auth::user()->city}}">

                    </div>

                    <div class="form-group col-md-6">
                        <label for="country">País</label>
                        <input type="text" class="form-control" id="country" name="country" aria-describedby="emailHelp" placeholder="Ingrese su pais"  value="{{Auth::user()->country}}">

                    </div>

                    <div class="form-group col-md-6">
                        <label for="phone1">Teléfono fijo</label>
                        <input type="number" class="form-control" id="phone1" name="phone1" aria-describedby="emailHelp"  value="{{Auth::user()->phone1}}">

                    </div>

                    <div class="form-group col-md-6">
                        <label for="phone2">Teléfono móvil:</label>
                        <input type="number" class="form-control" id="phone2" name="phone2" aria-describedby="emailHelp"  value="{{Auth::user()->phone2}}">

                    </div>

                    <div class="form-group col-md-6">
                        <label for="type_doc">Tipo de documento</label>
                        <select class="form-control" id="type_doc" name="type_doc">
                            <option value=""></option>
                            <option value="1" @if(Auth::user()->type_identification == 1) selected @endif>Cédula de ciudadania</option>
                            <option value="2" @if(Auth::user()->type_identification == 2) selected @endif>Cédula de extranjeria</option>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="doc">Numero de documento de identidad</label>
                        <input type="text" class="form-control" id="doc" name="doc" aria-describedby="emailHelp" placeholder="Ingrese su ciudad"  value="{{Auth::user()->identification}}">

                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="birthday">Fecha de nacimiento</label>
                        <input type="text" class="form-control mydatepicker" id="birthday" name="birthday"  aria-describedby="emailHelp"   value="{{Auth::user()->birthday}}">

                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="birthday">Contraseña</label>
                        <input type="password" class="form-control" id="pass" name="pass" value="">

                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Completar perfil</button>
            </div>
            
        </div>
    </div>
    </form>
</div>
@endsection