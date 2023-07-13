@extends('layouts.admin')
@section('title', 'User Access')
@section('content')
<div class="container">
   <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-6 col-xd-4">
            <div class="card card-info card-outline">
                <div class="card-header">
                    Role User
                    <div class="card-tools">
                        <button type="button" id="add_roleUser" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addRoleUser" style="float:right">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="datatable-bordered nowrap display" id="roleUserTable">
                        <thead>
                            <tr>
                                <th style="text-align: center">Name</th>
                                <th style="text-align: center">Role</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-xd-4">
            <div class="card card-info card-outline">
                <div class="card-header">
                    Role Permission
                   <div class="card-tools">

                   </div>
                </div>
                <div class="card-body">
                    <table class="datatable-bordered nowrap display" id="roleTable">
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
@include('userAccess.roleUser-add')
@include('userAccess.roleUser-edit')
@include('userAccess.rolePermission-add')
@include('userAccess.rolePermission-delete')
@endsection
@push('custom-js')
    @include('userAccess.userAccess-js')
@endpush