<!-- Header -->

<div class="site-header">
    <nav class="navbar navbar-light">
        <ul class="nav navbar-nav">
            <li class="nav-item m-r-1 hidden-lg-up">
                <a class="nav-link collapse-button" href="#">
                    <i class="ti-menu"></i>
                </a>
            </li>
        </ul>
        <ul class="nav navbar-nav pull-xs-right">
            
            <!--<li class="nav-item dropdown">
                <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
                    <i class="ti-bell"></i>
                    <span class="tag tag-danger top">10</span>
                </a>
                <div class="dropdown-messages dropdown-tasks dropdown-menu dropdown-menu-right animated slideInUp">

                </div>
            </li> -->
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
                    <div class="avatar box-32">
                        <img class="b-a-radius-circle shadow-white" src="{{is_null(Auth::user()->avatar) ? '/img/Sin_foto.png' : '/avatar/'.Auth::id() }}" alt="" id='previewAvatar'>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right animated flipInY">

                    <a class="dropdown-item  text-black" href="/perfil">
                        <i class="ti-user m-r-0-5 text-black"></i> Perfil
                    </a>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item text-black" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="ti-power-off m-r-0-5"></i> Cerrar sesión</a>
                </div>
            </li>
            <li class="nav-item hidden-md-up">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapse-1">
                    <i class="ti-more"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link site-sidebar-second-toggle active" href="#" data-toggle="collapse">
                    <i class="ti-arrow-left"></i>
                </a>
            </li>

        </ul>
        <div class="navbar-toggleable-sm collapse" id="collapse-1">
            <div class="header-form pull-md-left m-md-r-1">

            </div>

        </div>
    </nav>
</div>




<!--<div class="site-sidebar-second custom-scroll custom-scroll-dark">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab-2" role="tab">Actividad</a>
        </li>
        
    </ul>
    <div class="tab-content">
        
        <div class="tab-pane active" id="tab-2" role="tabpanel">
            <div class="sidebar-activity animated fadeIn">
                <div class="notifications">
                   <!-- @foreach(App\Http\Controllers\Opegin::myActivity() as $activity)
                        <div class="n-item">
                            <div class="media">
                                <div class="media-left">
                                    <div class="avatar box-48">
                                        <img class="b-a-radius-circle" src="/avatar/{{Auth::id()}}" alt="">
                                        <span class="n-icon bg-danger"><i class="ti-pin-alt"></i></span>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="n-text">
                                        {!! $activity->activity !!}
                                    </div>
                                    <div class="text-muted font-90">{{$activity->created_at}}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach                 </div>
            </div>
        </div>
        
        
    </div>
</div>-->





<div class="modal fade" id="bienvenida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bienvenido/a</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Bienvenido al gestor documental
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrarBienvenida()">Cerrar</button>
        <button type="button" class="btn btn-primary"  data-dismiss="modal" onclick="cerrarBienvenida()">Aceptar</button>
      </div>
    </div>
  </div>
</div>