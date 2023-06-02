@extends('frontend.layouts.main')
@section('css')

@endsection
@section('content')
<div id="footer" style="padding-bottom: 0;">
    <div class="container clearfix">
        <div class="common-breadcrumbs gap-2 d-flex flex-column">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb h7">
                    <li class="text-uppercase"><a href="#">HOME</a></li>
                    <li class="text-uppercase px-4">|</li>
                    <li class="text-uppercase" aria-current="page">Privacy Policy</li>
                </ol>
            </nav>
            <h1 class="text-uppercase py-0 d-flex align-items-center display-6 fw-bold">Privacy Policy</h1>
        </div>
    </div>
</div>
<div class="container mt-5 mb-5">
<div class>{!! html_entity_decode($data) !!}</div>
</div>


@endsection
