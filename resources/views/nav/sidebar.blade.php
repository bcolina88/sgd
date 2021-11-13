<!-- Sidebar -->
<div class="site-sidebar-overlay"></div>
<div class="site-sidebar">
    <a class="logo" href="/">
        <img src="/no_logo.png" class="img-fluid">
    </a>
    <div class="custom-scroll custom-scroll-light">

        <ul class="sidebar-menu">

        <li>
                <a href="/" class="waves-effect  waves-light">
                    <span class="s-icon"><i class=" ti-dashboard"></i></span>
                    <span class="s-text">Inicio</span>
                </a>
          </li>

            <li>
                <a href="/perfil" class="waves-effect  waves-light">
                    <span class="s-icon"><i class="ti-user"></i></span>
                    <span class="s-text">Perfil</span>
                </a>
            </li>


            @foreach(\App\Http\Controllers\ModulesController::getModules() as $module)
                @if(\App\Http\Controllers\UserController::seeModule($module->id) || Auth::user()->role_id == 1)
                <li class="with-sub">
                    <a href="#" class="waves-effect  waves-light">
                        <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                        <span class="s-icon"><i class="{{$module->icon}}"></i></span>
                        <span class="s-text">{{$module->name}}</span>
                    </a>
                    <ul>
                        @if(Auth::user()->role_id != 3)
                            <li><a href="/nuevo/{{$module->id}}">Crear nuevo archivo</a></li>
                        @endif
                        <li><a href="/list/{{$module->id}}">Archivos digitalizados</a></li>
                        @if(Auth::user()->role_id == 1)
                            @foreach($module->fields->where("admin", 1) as $field)
                                <li><a href="/editField/{{$field->id}}">{{$field->name}}</a></li>
                            @endforeach
                        @endif
                        @if(Auth::user()->role_id == 1)
                            <li><a href="/trash/{{$module->id}}">Papelera de reciclaje</a></li>
                        @endif

                    </ul>
                </li>
                @endif
            @endforeach
            
            @if(Auth::user()->role_id == 1)
            <li class="with-sub">
                <a href="#" class="waves-effect  waves-light">
                    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                    <span class="s-icon"><i class="fa fa-users"></i></span>
                    <span class="s-text">Usuarios</span>
                </a>
                <ul>
                    <li><a href="/nuevoUsuario">Crear usuario</a></li>
                    <li><a href="/listaUsuarios">Buscar usuario</a></li>
                </ul>
            </li>
            @endif


            <li>
                <a href="{{ route('logout') }}" class="waves-effect  waves-light"  onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    <span class="s-icon"><i class="ti-power-off"></i></span>
                    <span class="s-text">Cerrar sesión</span>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </a>
            </li>

        </ul>
    </div>
</div>