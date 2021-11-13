@extends('layouts.app')

@section('content')
    <div class="site-content">
        <!-- Content -->
        <div class="content-area p-y-1">
            <div class="container-fluid">


                <div class="box box-block bg-white">
                    <h3>Listado actividades</h3>
                    <p class="font-90 text-muted m-b-1">
                        Consulte actividad de usuarios
                    </p>
                </div>

                <div class="box box-block bg-white scroll-auto">
                    <table class="table table-striped m-md-b-0">
                        <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Actividades</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($activities as $activity)
                            <tr>
                                <td>
                                    {{$activity->user->name}}
                                </td>
                                <td>{!! $activity->activity !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        {{ $activities->render("pagination::bootstrap-4") }}
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection