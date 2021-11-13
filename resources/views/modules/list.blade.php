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
                        Consulte y cargue los documentos de {{$module->name}}
                    </p>
                  
               <form action="" method="get"> 


                        @foreach($module->fields->sortBy("order") as $field)
                            <div class="form-group col-md-{{$field->size}} col-xs-12">
                                <label for="name">{{$field->name}}</label>
                                @include("modules.partial.".$field->typeField->name, ["val" => Request::get("field-".$field->id), "type" => "find"])
                            </div>
                        @endforeach

                       <button class="btn btn-primary btn-block"><i class="fa fa-search"></i> Buscar</button>
                       
                      <!--<button id="buscar" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Buscar</button>
                       --> 
                </form>

                </div>

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
                                        <a href="/edit/{{$module->id}}/{{ $file->id}}" class="icon"><i class="fa fa-edit"></i></a>
                                        @if(Auth::user()->role_id == 1)
                                            <a href="/delete/{{$file->id}}" class="icon"><i class="fa fa-trash"></i></a>
                                        @endif
                                        <a class="icon text-primary" data-toggle="modal" data-target="#share" data-doc="{{$file->id}}"><i class="fa fa-share"></i></a>
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
                            <button type="button" class="btn btn-danger col-xs-12">Numero de archivos: {{$files->total()}}</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="share" tabindex="-1" role="dialog" aria-labelledby="share" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Compartir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/sendMail" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Enviar a</label>
                                <input type="email" name="destino" class="form-control">
                            </div>
                            <div class="col-sm-12">
                                <label>Mensaje</label>
                                <textarea name="mensaje" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="doc" id="doc">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section("script")
    <script>



        $('#share').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var doc = button.data('doc')
            var modal = $(this)
            modal.find('#doc').val(doc)
        })



    </script>
@endsection