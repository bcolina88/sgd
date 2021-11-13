@extends('layouts.app')

@section('content')
    <div class="site-content">
        <!-- Content -->
        <div class="content-area p-y-1">
            <div class="container-fluid">
                @if(Auth::user()->role_id != 3)
                    <div class="box box-block bg-white">
                        <div class="alert alert-primary-outline alert-dismissible fade in" role="alert">

                            <strong>Para subir un documento al sistema de gestión documental de {{env("APP_NAME")}} haga click en el boton subir documento</strong>
                            <br><br>
                            <a href="/nuevo/{{$module->id}}" class="btn btn-outline-primary btn-rounded w-min-sm m-b-0-25 waves-effect waves-light">
                                +     Subir documento
                            </a>
                        </div>
                    </div>
                @endif

                <div class="box box-block bg-white">
                    <h3>{{$module->name}}</h3>
                    <p class="font-90 text-muted m-b-1">
                        Recupere los documentos de {{$module->name}}
                    </p>
                </div>

                @if(Request::route()->uri != "rh")
                    <div class="box box-block bg-white scroll-auto">
                        <table class="table table-striped m-md-b-0">
                            <thead>
                            <tr>
                                @foreach($module->fields->sortBy("order") as $field)
                                    @if($field->typeField->name != "radio_toggle")
                                        <th>{{$field->name}}</th>
                                    @endif
                                @endforeach
                                <th>Archivo</th>
                                @if(Auth::user()->role_id != 3)
                                    <th>Acciones</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($files as $file)
                                <tr>
                                    @foreach($module->fields->sortBy("order") as $field)
                                    @if($field->typeField->name == "select")
                                        @php
                                            $d = json_decode($field->data, true);
                                            $field = $file->fields->where("fields_id", $field->id);
                                        @endphp
                                        @if($field->count() > 0 && !is_null($field->last()->value))
                                            <td>{{$d[$field->last()->value-1]}}</td>
                                        @else
                                            <td></td>
                                        @endif
                                    @elseif($field->typeField->name == "radio_toggle")

                                    @else
                                        @php
                                        $field = $file->fields->where("fields_id", $field->id);
                                        @endphp
                                        @if($field->count() > 0)
                                            <td>{{$field->last()->value}}</td>
                                        @else
                                            <td></td>
                                        @endif
                                    @endif

                                @endforeach
                                    <td>
                                        <a href="/modules/file/{{ $file->id }}" target="_blank" class="btn btn-primary">Ver archivo</a>
                                    </td>
                                    @if(Auth::user()->role_id != 3)
                                        <td>
                                            @if(Auth::user()->role_id == 1)
                                                <a href="/recycle/{{$file->id}}" class="icon"><i class="fa fa-recycle"></i></a>
                                            @endif
                                        </td>
                                    @endif
                                </tr>

                            @endforeach
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-xs-9">
                                {{ $files->render("pagination::bootstrap-4") }}
                            </div>
                            <div class="col-xs-3">
                                <br>
                                <button type="button" class="btn btn-success col-xs-12">Numero de archivos: {{$files->total()}}</button>
                            </div>
                        </div>

                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection