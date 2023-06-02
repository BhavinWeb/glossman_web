<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name') }}</title>
    @include('website.layouts.partials.styles')
</head>

<body>
    <div class="error-body text-center">
        <div class="container">
            <div class="error-body__image-group">
                <img src="{{ asset($cms->page404_image) }}" alt="error" class="mw-100">
            </div>
            <div class="error-body__content">
                <h2 class="title">{{ $cms->page404_title }}</h2>
                <p class="text">{{ $cms->page404_subtitle }}</p>
                <div class="error-body__content--button-group">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">
                        <x-svg.arrow-left />
                        {{ __('go_back') }}
                    </a>
                    <a href="{{ route('website.index') }}" class="btn btn-outline-primary">
                        <x-svg.home />
                        {{ __('home') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
