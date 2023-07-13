@extends('layouts.admin')
@section('title', 'Master Title')
@section('content')
<div class="container">
   <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-10 col-xd-4">
            <div class="card card-info card-outline">
                <div class="card-header">
                    Title
                    @can('create-masterTitle')
                    <div class="card-tools">
                        <button type="button" id="add_masterTitle" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addMasterTitle" style="float:right">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="datatable-bordered nowrap display" id="masterTitleTable">
                        <thead>
                            <tr>
                                <th style="text-align: center"></th>
                                <th style="text-align: center">Status</th>
                                <th style="text-align: center">Name</th>
                                <th style="text-align: center">Departement</th>
                                <th style="text-align: center">Division</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
       
   </div>
</div>
@include('masterTitle.masterTitle-add')
@include('masterTitle.masterTitle-edit')
@endsection
@push('custom-js')
    @include('masterTitle.masterTitle-js')
@endpush