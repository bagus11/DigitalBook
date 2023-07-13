@extends('layouts.admin')
@section('title', 'Digital Book')
@section('content')
<div class="container">
   <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-12 col-xd-4">
            <div class="card card-info card-outline">
                <div class="card-header">
                    Digital Book
                    @can('create-digitalBook')
                    <div class="card-tools">
                        <button type="button" id="add_digitalBook" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addDigitalBook" style="float:right">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="datatable-bordered nowrap display" id="digitalBookTable">
                        <thead>
                            <tr>
                                <th style="text-align: center"></th>
                                <th style="text-align: center"></th>
                                <th style="text-align: center">Status</th>
                                <th style="text-align: center">Request Code</th>
                                <th style="text-align: center">Division</th>
                                <th style="text-align: center">Department</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
       
   </div>
</div>
@include('digitalBook.digitalBook-add')
@include('digitalBook.digitalBook-editPIC')
@include('digitalBook.digitalBook-addDetail')
@include('digitalBook.digitalBook-editQueue')
@include('digitalBook.digitalBook-editDetail')
@include('digitalBook.digitalBook-detailLog')

@endsection
@push('custom-js')
    @include('digitalBook.digitalBook-js')
@endpush