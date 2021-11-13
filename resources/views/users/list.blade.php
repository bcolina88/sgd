@extends('layouts.app')

@section('content')
<div class="site-content">
        <!-- Content -->
        <div class="content-area p-y-1">
            <div class="container-fluid">

                <div class="box box-block bg-white">
                    <div class="alert alert-primary-outline alert-dismissible fade in" role="alert">

                        <strong>Para Crear un nuevo usuario haga click en el boton Crear usuario</strong>
                           <br><br>
                        <a href="/nuevoUsuario" class="btn btn-outline-primary btn-rounded w-min-sm m-b-0-25 waves-effect waves-light">
                            +  Crear usuario
                        </a>
                    </div>
                </div>

                <div class="box box-block bg-white">
                    <h3>Usuarios</h3>
                </div>

                <div class="box box-block bg-white scroll-auto">
                    <table class="table table-striped m-md-b-0">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cargo</th>
   		   						<th>Acciones</th>
                            </tr>
                        </thead>
   		   					<tbody>
   		   					@foreach($users as $user)
   		   						<tr>
   		   							<td>{{$user->name}}</td>
   		   							<td>{{$user->cargo}}</td>
   		   							<td>
   		   								<a href="/user/editar/{{$user->id}}"  class="icon"><i class="fa fa-edit"></i></a>
   		   								<a href="/user/borrar/{{$user->id}}"  class="icon"><i class="fa fa-trash"></i></a>
   		   							</td>
   		   						</tr>
   		   					@endforeach
   		   				</tbody>
                    </table>
                </div>

    </div>
</div>
</div>

@endsection