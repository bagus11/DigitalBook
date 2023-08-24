@extends('layouts.admin')
@section('title', 'Master HSE Page')
@section('content')
<div class="container">
   <div class="row justify-content-center">
        <div class="col-12">
            <div class="card card-info card-outline">
                <div class="card-header">
                    HSE Page
                   
                </div>
                <div class="card-body">
                    <table class="datatable-bordered nowrap display" id="masterHSETable">
                        <thead>
                            <tr>
                               <th></th>
                               <th>Menu</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
       
   </div>
</div>

@include('masterHSE.masterHSE-addSubmenus')
@endsection
@push('custom-js')
 @include('masterHSE.masterHSE-js')
@endpush