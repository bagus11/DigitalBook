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
                    $menus = DB::connection('mysql2')->table('master_division')->get();
                @endphp
                @foreach ($menus as $item)
                    
                @endforeach
            </ul>
        </nav>
    </div>
</aside>