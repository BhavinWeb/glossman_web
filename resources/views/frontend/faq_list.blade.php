@extends('frontend.layouts.main')
  @section('meta_data')
    @php
        $data = metaData('faq');
        @endphp

        <meta name="title" content="{{ $data->title }}">
        <meta name="description" content="{{ $data->description }}">

        <meta property="og:image" content="{{ $data->image_url }}" />
        <meta property="og:site_name" content="{{ config('app.name') }}">
        <meta property="og:title" content="{{ $data->title }}">
        <meta property="og:url" content="{{url()->current()}}">
        <meta property="og:type" content="article">
        <meta property="og:description" content="{{ $data->description }}">

        <meta name=twitter:card content=summary_large_image />
        <meta name=twitter:site content="{{ config('app.name') }}" />
        <meta name=twitter:url content="{{url()->current()}}" />
        <meta name=twitter:title content="{{ $data->title }}" />
        <meta name=twitter:description content="{{ $data->description }}" />
        <meta name=twitter:image content="{{ $data->image_url }}" />
    @endsection
@section('css')
<style type="text/css">
</style>
@endsection
@section('content')
<div id="footer" style="padding-bottom: 0;">
   <div id="">
      <div class="container clearfix">
         <div class="common-breadcrumbs gap-2 d-flex flex-column">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb h7">
                  <li class="text-uppercase"><a href="{{URL::to('/')}}">HOME</a></li>
                  <li class="text-uppercase px-4">|</li>
                  <li class="text-uppercase" aria-current="page">FAQ</li>
               </ol>
            </nav>
            <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">FAQ</h1>
         </div>
      </div>
   </div>
</div>
<div class="mt-5">
   <div class="container">
      <div class="row mb-5">
         <div class="accordion" id="accordionExample">
         @foreach($faq as $faq_data)
            <div class="accordion-item mt-4">
               <h2 class="accordion-header" id="heading{{$faq_data->id}}">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$faq_data->id}}" aria-expanded="false" aria-controls="collapse{{$faq_data->id}}">
                  {{$faq_data->question}}
                  </button>
               </h2>
               <div id="collapse{{$faq_data->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$faq_data->id}}" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                     {{$faq_data->answer}}
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </div>
</div>
@endsection
@section('javascript')
@endsection
