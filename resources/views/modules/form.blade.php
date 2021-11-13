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
                    <h3>{{$module->name}}</h3>
                    <p class="font-90 text-muted m-b-1">
                        Cargar archivo {{$module->name}}
                    </p>
                    <form action="/save/new/{{$module->id}}" method="post" class="row" enctype="multipart/form-data">
                        {{ csrf_field() }}

                            @foreach($module->fields->sortBy("order") as $field)
                                <div class="form-group col-md-{{$field->size}} col-xs-12">
                                    <label for="name">{{$field->name}}</label>
                                    @include("modules.partial.".$field->typeField->name)
                                </div>
                            @endforeach


                        <div class="form-group col-md-12">
                            <input type="file" id='file' name="file" class="form-control dropify" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

