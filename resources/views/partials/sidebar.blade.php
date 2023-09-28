@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li>
                <img style="height: 40px; width: auto;" src="{{ asset('images/hhs.png') }}">
                <span class="brand">Fundación Helvex</span>
            </li>
            @can('gestion_usuarios')
            <li class="{{ $request->segment(2) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/admin/home') }}">
                    <i class="fas fa-lg fa-grip-horizontal"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-lg fa-table"></i>
                    <span class="title">@lang('global.forms-generate.title')</span>
                    <span class="pull-right-container">
                        <i class="fas fa-lg fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'programs' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.programs.index') }}">
                            <i class="fas fa-lg fa-briefcase"></i>
                            <span class="title">
                                Programas
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'landings' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.landings') }}">
                            <i class="fas fa-lg fa-briefcase"></i>
                            <span class="title">
                                Landings
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'applications' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.applications.index') }}">
                            <i class="fas fa-lg fa-briefcase"></i>
                            <span class="title">
                                Aplicantes
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-lg fa-users"></i>
                    <span class="title">@lang('global.user-management.title')</span>
                    <!-- <span class="pull-right-container">
                        <i class="fas fa-lg fa-angle-left pull-right"></i>
                    </span> -->
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fas fa-lg fa-user"></i>
                            <span class="title">
                                @lang('global.users.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fas fa-lg fa-lock"></i>
                            <span class="title">
                                @lang('global.permissions.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fas fa-lg fa-briefcase"></i>
                            <span class="title">
                                @lang('global.roles.title')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @cannot('gestion_usuarios')
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-lg fa-briefcase"></i>
                    <span class="title">@lang('global.applications.title')</span>
                    <span class="pull-right-container">
                        <i class="fas fa-lg fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $request->segment(2) == 'home' ? 'active active-sub' : '' }}">
                        <a href="{{ url('admin/home') }}">
                            <i class="fas fa-lg fa-wrench"></i>
                            <span class="title">@lang('global.applications.title')</span>
                        </a>
                    </li>
                    @cannot('evaluar_usuarios')
                    @cannot('auditar_usuarios')
                    @cannot('corporativo_usuarios')                    
                    @if (is_countable($formsall) && count($formsall) > 0)
                        <?php $contador=1; ?>
                        @foreach ($formsall as $form)
                            <li class="{{ $request->segment(2) == 'formulario' ? 'active active-sub' : '' }}">
                                <a href="{{ url('admin/formulario',['idformulario' => $form->idFormulario,'idprograma' => $form->Programa_idPrograma])}}">
                                    <i class="fas fa-lg fa-wrench"></i>
                                    <span class="title">Formulario <?php echo $contador; ?></span>
                                </a>
                            </li>
                            <?php $contador=$contador+1; ?>
                        @endforeach
                    @endif
                    @endcan
                    @endcan
                    @endcan
                </ul>
            </li>
            @endcan
            <!-- NUEVA SECCIÓN -->
            <li class="{{ $request->segment(2) == 'biblioteca' ? 'active' : '' }}">
                <a href="{{ url('admin/biblioteca')}}">
                    <i class="fas fa-lg fa-image"></i>
                    <span class="title">Biblioteca</span>
                </a>
            </li>
            <!-- /NUEVA SECCIÓN -->
            <li class="{{ $request->segment(2) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fas fa-lg fa-key"></i>
                    <span class="title">Cambiar contraseña</span>
                </a>
            </li>
            <li>
                <!--a href="#logout" onclick="$('#logout').submit();">
                    <i class="fas fa-lg fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a-->
                <a href="{{ url('helvex/logout')}}">
                    <i class="fas fa-lg fa-times"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
        <div style="color: rgb(0, 123, 255); position:absolute; bottom: 10px; margin-left: 10px;">
            Dudas sobre la convocatoria:<br>
            <a href="mailto:hola@helvex.com.mx">hola@helvex.com.mx</a><br>
            <div style="position: absolute;">
                <a href="https://www.facebook.com/startupmexico"><img src="{{ asset('images/facebook.png') }}" style="float: left; width: 20px; height: 20px; margin-right: 10px;"></a>
            </div><br>
            <p><a href="tel:91800780w123">9180 0780 ext 123</a></p><br>
            Soporte técnico:<br>
            <a href="mailto:hola@startupmexico.com">hola@startupmexico.com</a><br>
            <p><a href="tel:5545130805">55 4513 0805</a></p>
        </div>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('global.logout')</button>
{!! Form::close() !!}