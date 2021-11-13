@extends('layouts.app')

@section('content')
    <div class="site-content">
        <div class="content-area p-y-1">
            <div class="container-fluid">
                <div class="box box-block bg-white">
                    <h3>{{$field->name}}</h3>
                    <p class="font-90 text-muted m-b-1">
                        Crear una {{$field->name}}
                    </p>
                    <form action="" method="post" class="form-group" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group col-md-12">
                            <label for="type">Valor</label>
                            <input type="text" id='type' name="value" class="form-control" value="{{$row}}" required>
                        </div>


                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
