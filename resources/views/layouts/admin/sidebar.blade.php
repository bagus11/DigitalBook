<aside class="main-sidebar sidebar-dark-danger elevation-4" style="background-color:#19A7CE">
    <a href="{{route('home')}}" class="brand-link">
      <b>Admin</b>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{URL::asset('profile.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @php
                    $menus = DB::table('menus')
                        ->join('permissions', 'permissions.name','=','menus.permissionName')
                        ->join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                        ->join('roles', 'roles.id','role_has_permissions.role_id')
                        ->join('model_has_roles', 'model_has_roles.role_id', 'roles.id')
                        ->select('menus.*')
                        ->where('status',1)
                        ->where('model_has_roles.model_id', auth()->user()->id)
                        ->get();
                @endphp
                @foreach ($menus as $item)
                    @if($item->type == 1)
                        <li class="nav-item">
                            <a href="{{$item->link}}" class="nav-link">
                                <i class="nav-icon {{$item->icon}}"></i>
                                <p>{{$item->name}}</p>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            @php
                                $submenus = DB::table('submenus')->select('submenus.*')
                                        ->join('permissions','permissions.name','=','submenus.permissionName')
                                        ->join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                                        ->join('roles', 'roles.id','role_has_permissions.role_id')
                                        ->join('model_has_roles', 'model_has_roles.role_id', 'roles.id')
                                        ->where('submenus.idMenu', $item->id)
                                        ->where('submenus.status', 1)
                                        ->where('model_has_roles.model_id', auth()->user()->id)
                                        ->get();
                            @endphp
                             <a href="#" class="nav-link">
                                <i class="nav-icon {{$item->icon}}"></i>
                                <p>{{$item->name}}<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach ($submenus as $row)
                                    <li class="nav-item" style="width:100%">
                                        <a href="{{$row->link}}" class="nav-link ml-3">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{$row->name}}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>   
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
</aside>