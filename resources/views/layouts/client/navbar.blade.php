<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="/" class="navbar-brand">
            <div class="row">
                <div class="col">
                    <img src="{{asset('hseIcon.png')}}" width="70px" style="display:block" alt="">
                </div>
                <div class="col mt-3" style="margin-left: -30px">
                    <b>
                        Digital Book
                    </b>
                </div>
            </div>
            {{-- <span class="brand-text font-weight-light">DigitalBook</span> --}}
        </a>
        {{-- <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> --}}
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            @php
                $menus = DB::table('client_menus')->where(
                    [
                        'parentMenu' => 2,
                        'type'       => 3
                    ]
                )->get();
            @endphp
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item  p-2">
                    <a href="/" class="nav-link">Home</a>
                </li>
                @foreach ($menus as $item)
                    <li class="nav-item dropdown p-2">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{$item->name}}</a>
                        @php
                            $submenus = DB::table('client_menus')->where('parentSubmenus',$item->id)->whereIn('type',[4,5])->get();
                        @endphp
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            @foreach ($submenus as $row)
                            @if ($row->type == 4)
                                <li><a href="{{$row->link}}" class="dropdown-item">{{$row->name}}</a></li>
                                <li class="dropdown-divider"></li>
                            @else                            
                                <li class="dropdown-submenu">
                                    @php
                                        $subSubmenus = DB::table('client_menus')->where('parentSubSubmenus', $row->id)->whereIn('type',[4,5,6,7])->get();
                                    @endphp
                                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">{{$row->name}}</a>
                                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu dropdown-menu-left border-0 shadow">
                                        @foreach ($subSubmenus as $col)
                                        @if ($col->type == 6)
                                            <li><a href="{{$col->link}}" class="dropdown-item">{{$col->name}}</a></li>
                                            <li class="dropdown-divider"></li>
                                        @else
                                        <li class="dropdown-submenu">
                                            <a id="dropdownSubMenu4" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">{{$col->name}}</a>
                                            <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu dropdown-menu-left border-0 shadow">
                                                @php
                                                    $level4 = DB::table('client_menus')->where('parentSubSubSubmenus', $col->id)->get();
                                                @endphp
                                                @foreach ($level4 as $subCol)
                                                <li><a href="{{$subCol->link}}" class="dropdown-item">{{$subCol->name}}</a></li>
                                                <li class="dropdown-divider"></li>
                                                @endforeach
                                            
                                            </ul>
                                        </li>
                                        @endif
                                      
                                      
                                        @endforeach
                                  
                                    </ul>
                                </li>
                                <li class="dropdown-divider"></li>
                            @endif
                            
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>