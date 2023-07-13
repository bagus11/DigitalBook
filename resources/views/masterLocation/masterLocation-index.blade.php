@extends('layouts.admin')
@section('title', 'Master Location')
@section('content')
<div class="container">
   <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-10 col-xd-4">
            <div class="card card-info card-outline">
                <div class="card-header">
                    Location
                    
                </div>
                <div class="card-body">
                    <table class="datatable-bordered nowrap display" id="masterLocationTable">
                        <thead>
                            <tr>
                                <th style="text-align: center">Name</th>
                                <th style="text-align: center">City</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
       
   </div>
</div>
@include('masterLocation.masterLocation-edit')
@endsection
@push('custom-js')
    @include('masterLocation.masterLocation-js')
@endpush