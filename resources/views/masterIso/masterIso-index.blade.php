@extends('layouts.admin')
@section('title', 'Master ISO')
@section('content')
<div class="container">
   <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-10 col-xd-4">
            <div class="card card-info card-outline">
                <div class="card-header">
                    ISO
                    @can('create-masterIso')
                    <div class="card-tools">
                        <button type="button" id="add_masterIso" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addMasterIso" style="float:right">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="datatable-bordered nowrap display" id="masterIsoTable">
                        <thead>
                            <tr>
                                <th style="text-align: center"></th>
                                <th style="text-align: center">Status</th>
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
@include('masterIso.masterIso-add')
@include('masterIso.masterIso-edit')
@endsection
@push('custom-js')
    @include('masterIso.masterIso-js')
@endpush