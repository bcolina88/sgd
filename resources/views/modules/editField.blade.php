@extends('layouts.app')

@section('content')
    <div class="site-content">
        <div class="content-area p-y-1">
            <div class="container-fluid">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="box box-block bg-white">
                    <div class="alert alert-primary-outline alert-dismissible fade in" role="alert">

                        <strong>Para crear una nueva</strong>
                        <br><br>
                        <a href="/newRow/{{$field->id}}" class="btn btn-outline-primary btn-rounded w-min-sm m-b-0-25 waves-effect waves-light">
                            +  Crear nueva {{$field->name}}
                        </a>
                    </div>
                </div>


                <div class="box box-block bg-white">
                    <h3>{{$field->name}}</h3>
                    <p class="font-90 text-muted m-b-1">
                        Editar {{$field->name}}
                    </p>

                    <table class="table table-striped m-md-b-0">
                        <thead>
                        <tr>
                            <th>Valor</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $disable = $field->data_disable == null ? [] : json_decode($field->data_disable, true);
                            @endphp
                            @foreach(json_decode($field->data, true) as $key => $row)
                                <tr @if(array_search($key, $disable) !== false) class="disable" @endif>
                                    <td>{{$row}}</td>
                                    <td>
                                        @if(array_search($key, $disable) !== false)
                                            <a href="/recycle/{{$field->id}}/{{$key}}" class="icon" ><i class="fa fa-recycle"></i></a>
                                        @else
                                            <a href="{{$field->id}}/{{$key}}" class="icon" ><i class="fa fa-edit"></i></a>
                                            <a href="/delete/{{$field->id}}/{{$key}}" class="icon" ><i class="fa fa-trash"></i></a>
                                        @endif

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

