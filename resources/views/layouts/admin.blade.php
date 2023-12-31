
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Admin')</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/signature_pad@3.0.0/dist/signature-pad.css">
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
        @include('layouts.admin.navbar')
        @include('layouts.admin.sidebar')

        <div class="content-wrapper py-4">
            <input type="hidden" id="authId" value="{{auth()->user()->id}}">
            @yield('content')
        </div>


        <aside class="control-sidebar control-sidebar-dark overflow-auto">

            <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
            </div>
        </aside>
        @include('layouts.admin.footer')
        </div>
       
        <script src="{{asset('js/app.js')}}"></script>
       
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
        {{-- <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> --}}
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> 
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
        {{-- <script src="{{asset('js/chartjs-plugin-labels.js')}}"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js" 
        integrity="sha512-+UYTD5L/bU1sgAfWA0ELK5RlQ811q8wZIocqI7+K0Lhh8yVdIoAMEs96wJAIbgFvzynPm36ZCXtkydxu1cs27w==" crossorigin="anonymous" 
        referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

        <script>
            $(document).ready(function(){
                $(".select2").select2();
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                })
            });
            var url = window.location;
           // for sidebar menu entirely but not cover treeview
           $('ul.nav-sidebar a').filter(function() {
               return this.href == url;
           }).addClass('active');
       
           // for treeview
           $('ul.nav-treeview a').filter(function() {
               return this.href == url;
           }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('');
       
           // Swal Loading
           function SwalLoading(html = 'Loading ...', title = '') {
              return Swal.fire({
                  title: title,
                  html: html,
                  customClass: 'swal-wide',
                  timerProgressBar: true,
                  allowOutsideClick: false,
                  didOpen: () => {
                      Swal.showLoading()
                  }
              });
          }
       
          $(".select2").select2({ width: '300px', dropdownCssClass: "bigdrop" });
         
       </script>
       <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
       <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
       @include('helper.helper')
        @stack('custom-js')
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@3.0.0/dist/signature_pad.min.js"></script>
        <script src="{{ asset('js/signature.js') }}"></script>    
 
    </body>
</html>

<style>
.datatable-bordered{
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100% !important;
  font-size: 12px;
  overflow-x:auto !important;
  
  }
  .nav-sidebar{
    overflow-y: auto;
  }
  .dataTables_filter input { width: 300px }
  .datatable-bordered td, .datatable-bordered th {
  padding: 8px;
  }
  .datatable-bordered tr:nth-child(even){background-color: #fffff;}

  .datatable-bordered tr:hover {background-color: #fffff;}

  .datatable-bordered th {
  border: 1px solid #ddd;
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: center;
  background-color: white;
  color: black;
  overflow-x:auto !important;
  }

  ion-icon
    {
     zoom: 1.5;
     margin:auto
    }
.select2{
    width: 100% !important;
}
.select2-selection__rendered {
    line-height: 25px !important;  
}
.select2-container .select2-selection--single {
    height: 35px !important;
}
.select2-selection__arrow {
    height: 30px !important;
}
.dataTables_scrollHeadInner, .table{
     width:100%!important; 
}
.open\:bg-green-200[open] {
  --tw-bg-opacity: 1;
  background-color: rgb(187 247 208 / var(--tw-bg-opacity));
}
.open\:bg-red-600[open] {
  --tw-bg-opacity: 1;
  background-color: rgb(220 38 38 / var(--tw-bg-opacity));
}
.open\:bg-red-200[open] {
  --tw-bg-opacity: 1;
  background-color: rgb(254 202 202 / var(--tw-bg-opacity));

}
.open\:bg-amber-200[open] {
  --tw-bg-opacity: 1;
  background-color: rgb(253 230 138 / var(--tw-bg-opacity));
}
th.details-control {
  background-color: #04AA6D;
  color: white;
}
td.details-control {
background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
cursor: alias;
}
tr.shown td.details-control {
    background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
}

td.details-click {
    background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
    cursor: alias;
}
tr.shown td.details-click {
    background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
}

th.subdetails-control {
  background-color: #04AA6D;
  color: white;
}
td.subdetails-control {
background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
cursor: alias;
}
tr.shown td.subdetails-control {
    background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
}

td.subdetails-click {
    background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
    cursor: alias;
}
tr.shown td.subdetails-click {
    background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
}
.rating {
   position: relative;
   width: 180px;
   background: transparent;
   display: flex;
   justify-content: center;
   align-items: center;
   gap: .3em;
   padding: 5px;
   overflow: hidden;
   border-radius: 20px;
   box-shadow: 0 0 2px #b3acac;
}

.rating__result {
   position: absolute;
   top: 0;
   left: 0;
   transform: translateY(-10px) translateX(-5px);
   z-index: -9;
   font: 3em Arial, Helvetica, sans-serif;
   color: #ebebeb8e;
   pointer-events: none;
}

.rating__star {
   font-size: 1.3em;
   cursor: pointer;
   color: #dabd18b2;
   transition: filter linear .3s;
}

.rating__star:hover {
   filter: drop-shadow(1px 1px 4px gold);
}
.datatable-stepper{
  /* font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100% !important;
  font-size: 12px;
  overflow-x:auto !important; */
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  border-spacing: 0;
  font-size: 12px;
  width: 100% !important;
  border: 1px solid #ddd;
  
  }
  .datatable-stepper tr:nth-child(even){background-color: #fff;}

  .datatable-stepper tr:hover {background-color: #ffff;}

  .datatable-stepper th {
  border: 1px solid #ddd;
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: center;
  
  color: black;
  overflow-x:auto !important;
  }
  .datatable-stepper td, .datatable-stepper th {
        border: 1px solid #ddd;
        padding: 8px;
       
    }
    .dataTables_wrapper .dataTables_filter{
        float: right;
    }
    .dataTables_wrapper .dataTables_length{
        float: right;
    }
    div.dataTables_wrapper div.dataTables_filter input {
      width: 80% !important;  
      display: relative;
    }   
    .dataTables_length{
        float:left !important;
    }
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
                box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 12px !important;
        font-weight: bold !important;
        text-align: left !important;
    }
   
</style>