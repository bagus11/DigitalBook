<aside class="main-sidebar sidebar-dark-danger elevation-4" style="background:#009241">
    <a href="{{route('/')}}" class="brand-link">
        <div class="row" style="width: 90%">
            <div class="col-4">
                <img src="{{asset('hseIcon.png')}}" width="70px" style="display:block" alt="">
            </div>
            <div class="col-6 mt-3">
                <b>DigitalBook</b>
            </div>
        </div>
    </a>
    <div class="sidebar">
        
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @php
                    $menus = DB::table('client_menus')->get();
                @endphp
                
                @foreach ($menus as $item)
                  @if ($item->type == 1)
                        <li class="nav-item">
                                <a href="{{$item->link}}" class="nav-link">
                                    <i class="nav-icon {{$item->icon}}"></i>
                                    <p>{{$item->name}}</p>
                                </a>
                        </li>
                    @elseif($item->type == 2)
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon {{$item->icon}}"></i>
                                <p>{{$item->name}}<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                @php
                                    $submenus = DB::table('client_menus')->where('parentMenu', $item->id)->get();
                                @endphp
                                @foreach ($submenus as $row)
                                    <li class="nav-item" style="width:100%">
                                        <a href="{{$row->link}}" class="nav-link ml-3">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{$row->name}}<i class="right fas fa-angle-left"></i></p>
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