<aside class="main-sidebar sidebar-dark-danger elevation-4" style="background:#146C94">
    <a href="{{route('/')}}" class="brand-link">
      <b>Digital Book</b>
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