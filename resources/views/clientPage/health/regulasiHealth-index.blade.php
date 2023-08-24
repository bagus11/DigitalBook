@extends('layouts.client')
@section('title', $data->title)
@section('content')
 <!-- slider Area Start-->

 <div class="slider-area" style="background-image: url({{ asset($data->Attachment) }}); height:400px;margin-top:-25px">
  {{-- <h3 style="margin: auto">{{$data->title}}</h3> --}}
</div>
<div class="mt-4 container">
    <h1><b>{{$data->title}}</b></h1>
    <br>
    <div class="row mt-2">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
               <p style="card-text">
                    <?= $data->description ?>
               </p>
            </div>
          </div>
        </div>
    </div>
</div>

<!-- slider Area End-->
@endsection
@push('custom-js')
  
@endpush