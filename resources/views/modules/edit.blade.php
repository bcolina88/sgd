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
                    <form action="" method="post" class="row" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @foreach($module->fields->sortBy("order") as $field)
                            <div class="form-group col-md-6">
                                <label for="name">{{$field->name}}</label>
                                @php
                                    $value = $file->fields->where("fields_id", $field->id);
                                    $value = $value->count() > 0 ? $value->last()->value : "";
                                @endphp
                                @include("modules.partial.".$field->typeField->name, ["val" => $value])
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

