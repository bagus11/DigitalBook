@extends('layouts.admin')
@section('title', 'Master Signature')
@section('content')
<div class="container">
   <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-10 col-xd-4">
            <div class="card card-info card-outline">
                <div class="card-header">
                    Master Signature
                </div>
                <div class="card-body">
                    <table class="datatable-bordered nowrap display" id="signature_table">
                        <thead>
                            <tr>
                                <th style="text-align: center">NIK</th>
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
@endsection
@push('custom-js')
    @include('approval.signature.master_signature-js')
@endpush