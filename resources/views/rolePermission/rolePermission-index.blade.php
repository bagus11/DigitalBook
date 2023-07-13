@extends('layouts.admin')
@section('title', 'Role & Permission')
@section('content')
<div class="container">
   <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-6 col-xd-4">
            <div class="card card-info card-outline">
                <div class="card-header">
                    Role
                    <div class="card-tools">
                        <button type="button" id="add_role" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addRoles" style="float:right">
                            <i class="fas fa-plus"></i>
                        </button>
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
        <div class="col-12 col-sm-12 col-md-6 col-xd-4">
            <div class="card card-info card-outline">
                <div class="card-header">
                    Permission
                    <div class="card-tools">
                        <button type="button" id="add_permission" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addPermission" style="float:right">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="datatable-bordered nowrap display" id="permissionTable">
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
@include('rolePermission.role-add')
@include('rolePermission.role-edit')
@include('rolePermission.permission-add')
@endsection
@push('custom-js')
    @include('rolePermission.rolePermission-js')
@endpush