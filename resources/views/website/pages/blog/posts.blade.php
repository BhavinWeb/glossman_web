@extends('website.layouts.app')

@section('meta')
    @php
    $data = metaData('posts');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{ route('website.post') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('website.post') }}" />
    <meta name=twitter:title content="{{ $data->title }}" />
    <meta name=twitter:description content="{{ $data->description }}" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection

@section('title', __('blog'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('blog') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Blog Body Start -->
    <div class="blog-body">
        <form id="Form" onchange="this.submit();" action="{{ route('website.post') }}" method="get">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-10">
                        <div class="blog-body__filter">
                            <div class="blog-body__filter--catagory">
                                <div class="category-block-02">
                                    <h6 class="title">{{ __('category') }}</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flexCheckChecked8"
                                            {{ request('category') ? '' : 'active' }} value="all" name="category">
                                        <label class="form-check-label fontcheck" for="flexCheckChecked8">
                                            {{ __('all') }}
                                        </label>
                                    </div>
                                    @foreach ($blog_categories as $category)
                                        <div class="form-check">
                                            <input class="form-check-input" name="category" value="{{ $category->slug }}"
                                                type="checkbox" id="flexCheckChecked{{ $category->id }}"
                                                @if (request('category') == $category->slug) checked @endif>
                                            <label class="form-check-label individual"
                                                for="flexCheckChecked{{ $category->id }}">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="blog-body__filter--bloglist">
                                <h2>{{ __('latest_posts') }}</h2>
                                @foreach ($latest_posts as $post)
                                    <div class="single-item">
                                        <div class="caard-block-list">
                                            <div class="card-image">
                                                <img src="{{ asset($post->image) }}" alt="img" height="80px"
                                                    width="100px">
                                            </div>
                                            <div class="card-body">
                                                <a href="{{ route('website.post.details', $post->slug) }}">
                                                    <h3 class="title">{{ $post->title }}</h3>
                                                </a>
                                                <span class="meta">@formatDate($post->created_at)</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-10">
                        <div class="blog-body__searchsortbox">
                            <div class="search-box">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{ request('keyword') }}"
                                        name="keyword" placeholder="{{ __('search_for_anything') }}...">
                                    <div class="icon">
                                        <x-svg.search />
                                    </div>
                                </div>
                            </div>
                            <div class="sort-box">
                                <p>{{ __('sort_by') }}:</p>
                                <div class="selectbox">
                                    <select class="nice-select" name="sortBy">
                                        <option value="latest" @if (request('sortBy') == 'latest') selected @endif>
                                            {{ __('latest') }}
                                        </option>
                                        <option value="oldest" @if (request('sortBy') == 'oldest') selected @endif>
                                            {{ __('oldest') }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="blog-body__card">
                            <div class="row card-row">
                                @forelse ($posts as $post)
                                    <div class="col-xl-6">
                                        <div class="card-news">
                                            <div class="card-image">
                                                <a href="{{ route('website.post.details', $post->slug) }}">
                                                    <img src="{{ asset($post->image) }}" alt="news"
                                                        class="w-100">
                                                </a>
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="card-body__meta">
                                                    <div class="user-block">
                                                        <x-svg.user-sm-round />
                                                        <span>{{ $post->author->full_name }}</span>
                                                    </div>
                                                    <div class="date-block">
                                                        <x-svg.calendar-sm-round />
                                                        <span>@formatDate($post->created_at)</span>
                                                    </div>
                                                    <div class="comment-block">
                                                        <x-svg.comment-sm-round />
                                                        <span>{{ $post->commentsCount() }}</span>
                                                    </div>
                                                </div>
                                                <a href="{{ route('website.post.details', $post->slug) }}">
                                                    <h2 class="title">{{ $post->title }}</h2>
                                                </a>
                                                <p class="text">{{ $post->short_description }}</p>
                                                <a class="btn btn-outline-primary"
                                                    href="{{ route('website.post.details', $post->slug) }}">
                                                    {{ __('read_more') }}
                                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3.625 10H17.375" stroke="" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M11.75 4.375L17.375 10L11.75 15.625" stroke=""
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <x-frontend.not-found message="no_posts_found" :showbutton="false" />
                                @endforelse
                            </div>
                        </div>
                        {!! $posts->links('vendor.pagination.frontend') !!}
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Blog Body End -->
@endsection
