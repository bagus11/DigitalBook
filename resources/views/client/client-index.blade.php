@extends('layouts.client')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="row justify-content-end">
        <div class="col-12">
            <div class="card collapsed-card">
                <div class="card-header bg-secondaryClient">
                    Search
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6">
                                    <div class="row">
                                        
                                        <div class="col-3 col-sm-3 col-md-3">
                                            <p><input type="checkbox" class="is_checked form-check-input" id="divisionCheck"> Division</p>
                                        </div>
                                        <div class="col-4 col-sm-4 col-md-3">
                                            <p><input type="checkbox" class="is_checked form-check-input" id="departementCheck"> Department</p>
                                        </div>
                                        <div class="col-2 col-sm-2 col-md-3">
                                            <p><input type="checkbox" class="is_checked form-check-input" id="isoCheck"> ISO</p>
                                        </div>
                                        <div class="col-3 col-sm-3 col-md-3">
                                            <p><input type="checkbox" class="is_checked form-check-input" id="locationCheck"> Location</p>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-3 py-1" id="divisionContainer">
                            <select name="selectDivision" class="select2" id="selectDivision"></select>
                            <input type="hidden" class="form-control" id="divisionId">
                        </div>
                        <div class="col-6 col-sm-6 col-md-3 py-1" id="departementContainer">
                            <select name="selectDepartement" id="selectDepartement" class="select2">
                                <option value="">Choose Division First</option>
                            </select>
                            <input type="hidden" class="form-control" id="departementId">
                        </div>
                        <div class="col-6 col-sm-6 col-md-3 py-1" id="isoContainer">
                            <select name="selectIso" id="selectIso" class="select2"></select>
                            <input type="hidden" class="form-control" id="isoId">
                        </div>
                        <div class="col-6 col-sm-6 col-md-3 py-1" id="locationContainer">
                            <select name="selectLocation" class="select2" id="selectLocation"></select>
                            <input type="hidden" class="form-control" id="locationId">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn bg-primaryClient btn-sm" type="button" style="float: right">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
         <div class="col-12">
             <div class="card card-danger card-outline">
                 <div class="card-header">
                    List
                 </div>
                 <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" id="contentContainer">
                            </ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-8">
                            <div id="detailContainer">

                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="card-footer"></div>
             </div>
         </div>
    </div>
    
 </div>
@endsection
@push('custom-js')
    @include('client.client-js')
@endpush