@extends('layouts.admin')
@section('title', 'Master Division')
@section('content')
<div class="container">
   <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-10 col-xd-4">
            <div class="card card-info card-outline">
                <div class="card-header">
                    Division
                    @can('create-masterDivision')
                    <div class="card-tools">
                        <button type="button" id="add_masterDivision" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addMasterDivision" style="float:right">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="datatable-bordered nowrap display" id="masterDivisionTable">
                        <thead>
                            <tr>
                                <th style="text-align: center">Name</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
       
   </div>
</div>
@include('masterDivision.masterDivision-add')
@include('masterDivision.masterDivision-edit')
@endsection
@push('custom-js')
    @include('masterDivision.masterDivision-js')
@endpush