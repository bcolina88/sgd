@extends('layouts.app')

@section('content')

<div class="site-content">

    <div class="content-area p-y-1">
        <div class="container-fluid">
            <div class="row row-md m-b-1">

                <div class="col-xs-12">
                    <div class="row">
                       <!-- @php
                            $modules = \App\Http\Controllers\ModulesController::getModules();
                            $rows = ceil(($modules->count()+1)/4)*12;
                            $size = floor($rows/($modules->count()+1));
                        @endphp
                        @foreach($modules as $module)

                            <div class="col-lg-{{$size}} col-md-{{$size}} col-sm-{{$size}} col-xs-12">
                                <div class="box box-block bg-white tile tile-1 m-b-2">
                                    <div class="t-icon right">
                                        <span class="bg-primary"></span>
                                        <i class="{{$module->icon}}"></i>
                                    </div>
                                    <div class="t-content">
                                        <h6 class="text-uppercase m-b-1">{{$module->name}}</h6>
                                        <h1 class="m-b-1">{{\App\Http\Controllers\ModulesController::totalFilesModule($module->id)}}</h1>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-lg-{{$size}} col-md-{{$size}} col-sm-{{$size}} col-xs-12">
                            <div class="box box-block bg-white tile tile-1 m-b-2">
                                <div class="t-icon right"><span class="bg-primary"></span><i class="fa fa-users"></i></div>
                                <div class="t-content">
                                    <h6 class="text-uppercase m-b-1">Usuarios</h6>
                                    <h1 class="m-b-1">{{$usersTotal}}</h1>

                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>


                <div class="col-md-4 col-xs-12">
                    <div class="box bg-white user-1">
                        <div class="u-img img-cover" style="background-image: url(img/photos-1/4.jpg);"></div>
                        <div class="u-content">
                            <div class="avatar box-64">
       
                                <img class="b-a-radius-circle shadow-white" src="{{is_null(Auth::user()->avatar) ? '/img/Sin_foto.png' : '/avatar/'.Auth::id() }}" alt="" id='previewAvatar'>
                                <i class="status bg-success bottom right"></i>
                            </div>
                            <h5><a class="text-black" href="#">{{Auth::user()->name}}</a></h5>
                            <p class="text-muted p-b-0-5">{{Auth::user()->cargo}}</p>
                            <div class="text-xs-center p-b-0-5">
                                <a href="/perfil" class="btn btn-outline-primary btn-rounded m-r-0-5">Editar perfil <i class="ti-plus m-l-0-5"></i></a>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <div class="box box-block bg-white">
                    @if(Auth::user()->role_id != 3)
                            <div class="clearfix m-b-1">
                                <h5 class="pull-xs-left">Estadisticas de cargue de documentos</h5>
                                <div class="clearfix m-b-1">

                                    <div class="pull-xs-right">

                                    </div>
                                </div>
                                <div id="multiple" class="chart-container"></div>
                            </div>
                    @else
                        <h5 class="m-b-1">Documentos cargados</h5>
                        <canvas id="bar" class="chart-container"></canvas>
                    @endif
                    </div>
                </div>               
                
            </div>
            @if(Auth::user()->role_id != 3)
            <div class="box box-block bg-white">
                <div class="row">
                    <div class="col-md-6 m-b-1 m-md-b-0">
                        <h5 class="m-b-1">Actividad mensual</h5>
                        <canvas id="line" class="chart-container"></canvas>
                    </div>
                    <div class="col-md-6">
                        <h5 class="m-b-1">Documentos cargados</h5>
                        <canvas id="bar" class="chart-container"></canvas>
                    </div>
                </div>
            </div>
            @endif

            @if(Auth::user()->role_id == 1)
            <div class="row row-md">
                <div class="col-md-6">
                    <div class="box box-block bg-white">
                        <div class="clearfix m-b-1">
                            <h5 class="pull-xs-left">Actividad de los usuarios</h5>
                            <div class="pull-xs-right">
                                
                            </div>
                        </div>
                        <div class="management m-b-1">
                          <!--  @foreach($activities as $activity)
                                <div class="m-item">
                                    <div class="mi-title">
                                        {{$activity->user->name}}<br>
                                        {!! $activity->activity !!}
                                    </div>
                                    
                                        <div class="pull-md-right">
                                            <span class="font-90 text-muted">{{$activity->created_at}}</span>
                                        </div>
                                    </div>
                            @endforeach  -->
                            
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <p  class="text-center" align="center">
                                    <a href="/listActivities">Ver más</a>
                                </p>
                            </div>
                        </div>
                        
                    </div>

                </div>


                <div class="col-md-6">
                    <div class="box box-block bg-white">
                        <div class="clearfix m-b-1">
                            <h5 class="pull-xs-left">Usuarios</h5>
                            <div class="pull-xs-right">
                                
                            </div>
                        </div>
                        <div class="management m-b-1">
                          <!--  @foreach($activities as $activity)
                                <div class="m-item">
                                    <div class="mi-title">
                                        {{$activity->user->name}}<br>
                                        {!! $activity->activity !!}
                                    </div>
                                    
                                        <div class="pull-md-right">
                                            <span class="font-90 text-muted">{{$activity->created_at}}</span>
                                        </div>
                                    </div>
                            @endforeach  -->
                            
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <p  class="text-center" align="center">
                                    <a href="/listaUsuarios">Ver más</a>
                                </p>
                            </div>
                        </div>
                        
                    </div>

                </div>



               <!-- <div class="col-md-6">
                    <div class="card">
                        <div class="card-block b-b clearfix">
                            <h5 class="pull-xs-left">Usuarios</h5>
                            <div class="pull-xs-right">
                                
                            </div>
                        </div>
                        
                       @foreach($users as $user)
                        <div class="items-list">
                            <div class="il-item">
                                <a class="text-black" href="#">
                                    <div class="media">
                                        <div class="media-left">
                                            <div class="avatar box-48">
                                                <img class="b-a-radius-circle" src="/avatar/{{$user->id}}" alt="">
                                                <i class="status bg-success bottom right"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading">{{$user->name}}</h6>
                                            <span class="text-muted">{{$user->cargo}}</span>
                                        </div>
                                    </div>
                                    <div class="il-icon"><i class="fa fa-angle-right"></i></div>
                                </a>
                            </div>
                            
                        @endforeach 
                            
    
                        </div>
                        <div class="card-block">
                            <button type="submit" class="btn btn-primary btn-block">Users management</button>
                        </div>
                    </div>
                </div> -->




            </div>
            @endif



    <div class="clearfix"></div>
    
</div>
<script>
    var informe1 = JSON.parse('{!! $informe1 !!}');
    var informe2 = JSON.parse('{!! $informe2 !!}');
    var informe3 = JSON.parse('{!! $informe3 !!}');
</script>
</div>
</div>
@endsection