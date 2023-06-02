@extends('website.layouts.app')

@section('meta')
    @php
    $data = metaData('home');
    @endphp

    <meta name="title" content="{{ $postDetails->title }}">
    <meta name="description" content="{!! $postDetails->short_description ?? $postDetails->title !!}">

    <meta property="og:image" content="{{ $postDetails->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $postDetails->title }}">
    <meta property="og:url" content="{{ route('website.post.details', $postDetails->slug) }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{!! $postDetails->short_description ?? $postDetails->title !!}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('website.post.details', $postDetails->slug) }}" />
    <meta name=twitter:title content="{{ $postDetails->title }}" />
    <meta name=twitter:description content="{!! $postDetails->short_description ?? $postDetails->title !!}" />
    <meta name=twitter:image content="{{ $postDetails->image_url }}" />
@endsection

@section('title')
    {{ $postDetails->title }} {{ __('details') }}
@endsection

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <a class="d-flex align-items-center text-gray-600" href="{{ route('website.post') }}">
            {{ __('posts') }}
        </a>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ $postDetails->title }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Blog Body Start -->
    <div class="blog-detail-body">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 order-2 order-lg-1">
                    <div class="blog-detail-body__image-group">
                        <img src="{{ asset($postDetails->image) }}" alt="blog" class="w-100">
                    </div>
                </div>
                <div class="col-lg-4 col-md-10 order-lg-2 order-1">
                    <div class="blog-detail-body__filter">
                        <div class="blog-detail-body__filter--search-box">
                            <div class="search-box">
                                <h2 class="title">{{ __('search') }}</h2>
                                <form id="Searchform" onchange="this.submit();" action="{{ route('website.post') }}">
                                    <div class="form-group">
                                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                                            class="form-control" placeholder="{{ __('search_for_anything') }}...">
                                        <div class="icon">
                                            <x-svg.search />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="blog-detail-body__filter--catagory">
                            <div class="category-block-02">
                                <h6 class="title">{{ 'category' }}</h6>
                                <form id="SearchCategoryForm" onchange="this.submit();"
                                    action="{{ route('website.post') }}" method="get">
                                    @foreach ($blog_categories as $category)
                                        <div class="form-check">
                                            <input class="form-check-input" name="category" value="{{ $category->slug }}"
                                                type="checkbox" id="flexCheckChecked{{ $category->id }}"
                                                @if (request('category') == $category->slug) checked @endif>
                                            <label class="form-check-label individual"
                                                for="flexCheckChecked{{ $category->id }}">
                                                <a
                                                    href="{{ route('website.post', 'category=' . $category->slug) }}">{{ $category->name }}</a>
                                            </label>
                                        </div>
                                    @endforeach
                                </form>
                            </div>
                        </div>
                        <div class="blog-detail-body__filter--bloglist">
                            <h2>{{ __('latest_blogs') }}</h2>
                            @foreach ($latest_posts as $post)
                                <div class="single-item">
                                    <div class="caard-block-list">
                                        <div class="card-image">
                                            <img src="{{ asset($post->image) }}" alt="img" height="80px" width="100px">
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
                <div class="col-lg-8 col-md-10 order-lg-1 order-3">
                    <div class="blog-detail-body__content">
                        <div class="meta-box">
                            <div class="user-one">
                                <x-svg.category-sm />
                                <span>{{ $postDetails->category->name }}</span>
                            </div>
                            <div class="user-tow">
                                <x-svg.user-sm-round />
                                <span>{{ $postDetails->author->full_name }}</span>
                            </div>
                            <div class="date">
                                <x-svg.calendar-sm-round />
                                <span>@formatDate($postDetails->created_at)</span>
                            </div>
                            <div class="chat">
                                <x-svg.comment-sm-round />
                                <span>{{ $postDetails->commentsCount() }}</span>
                            </div>
                        </div>
                        <div class="section-title-block">
                            <h2 class="titler">{{ $postDetails->title }}</h2>
                        </div>
                        <div class="blog-detail-body__content--avatar-info">
                            <div class="avatar">
                                <div class="image">
                                    <img src="{{ asset($postDetails->author->image_url) }}" alt="avatar"
                                        class="w-100">
                                </div>
                                <div class="content">
                                    <h6 class="name">{{ $postDetails->author->full_name }}</h6>
                                </div>
                            </div>
                            <ul class="social">
                                <li><a class="whatsappcolor"
                                        href="whatsapp://send?text={{ $post->title }} Link: {{ route('website.post.details', $post->slug) }}">
                                        <x-svg.whatsapp-circle />
                                    </a></li>
                                <li><a class="facebookcolor"
                                        href="https://www.facebook.com/sharer/sharer.php?u={{ route('website.post.details', $post->slug) }}">
                                        <x-svg.facebook-circle-white />
                                    </a></li>
                                <li><a class="twittercolor"
                                        href="https://twitter.com/intent/tweet?url={{ route('website.post.details', $post->slug) }}&text={{ $post->title }}">
                                        <x-svg.twitter-circle-white />
                                    </a></li>
                                <li><a class="linkedinkcolor"
                                        href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('website.post.details', $post->slug) }}">
                                        <x-svg.linkedin-circle-white />
                                    </a></li>
                                <li><a class="pinterestcolor"
                                        href="https://pinterest.com/pin/create/button/?url={{ route('website.post.details', $post->slug) }}&media=&description={{ $post->title }}">
                                        <x-svg.pinterest-circle-white />
                                    </a></li>
                                <li><a class="copycolor" href="" onclick="event.preventDefault(); copyToClipboard();">
                                        <x-svg.link-circle-white />
                                    </a></li>
                            </ul>
                        </div>
                        <p class="texts">{!! $postDetails->short_description !!}
                        </p>
                        {!! nl2br($postDetails->description) !!}
                        <div class="blog-detail-body__content--comment-box">
                            <div class="comment-form-01">
                                <h6 class="title">{{ __('leave_a_comment') }}</h6>
                                <form method="post" action="{{ route('website.post.comment.add', $postDetails->id) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-textarea">
                                                <label class="form-label"
                                                    for="Description">{{ __('description') }}</label>
                                                <textarea name="body" id="Description" cols="30" rows="10" placeholder="{{ __('share_your_thoughts') }}" required></textarea>
                                                <x-forms.error name="body" class="d-block" />
                                            </div>
                                        </div>
                                        @auth
                                            <div class="col-12">
                                                <div class="form-button">
                                                    <button type="submit" class="btn btn-primary">@lang('post_comment')</button>
                                                </div>
                                            </div>
                                        @endauth
                                        @guest
                                            <h6 class="title">{{ __('login_to_comment') }}</h6>
                                        @endguest
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="blog-detail-body__content--comment" id="post-comments">
                            <div class="comment-block-01">
                                <h6 class="title">{{ __('comments') }}</h6>
                                <div class="comment-block-01__wrapper">
                                    @forelse($postDetails->comments as $comment)
                                        <div class="comment-area comment_count">
                                            <div class="avatar">
                                                <img src="{{ asset($comment->user->image_url) }}" alt="avatar">
                                            </div>
                                            <div class="content">
                                                <div class="content__doc">
                                                    <h6 class="name">{{ $comment->user->first_name }}</h6>
                                                    <span class="dot"></span>
                                                    <p class="date">@formatDate($comment->created_at)</p>
                                                </div>
                                                <p class="text">{!! nl2br($comment->body) !!}</p>
                                                <br>
                                                <a href="" id="replies-{{ $comment->id }}"
                                                    onclick="event.preventDefault();showHideForm('reply-{{ $comment->id }}')">{{ __('reply') }}</a>
                                                <form id="reply-{{ $comment->id }}"
                                                    action="{{ route('website.post.reply.add', $postDetails->id) }}"
                                                    class="rt-mb-50 d-none" method="post">
                                                    @csrf
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-textarea form-group">
                                                                <label class="form-label"
                                                                    for="Description-{{ $comment->id }}">{{ __('reply_description') }}</label>
                                                                <textarea class="form-control" name="body" id="Description-{{ $comment->id }}" cols="20" rows="3"
                                                                    placeholder="{{ __('share_your_thoughts') }}..."></textarea>
                                                            </div>
                                                        </div>
                                                        @auth
                                                            <div class="col-12 pt-2">
                                                                <div class="form-button form-group">
                                                                    <button type="submit"
                                                                        class="btn btn-primary form-control">{{ __('post_reply') }}</button>
                                                                </div>
                                                            </div>
                                                        @endauth
                                                        @guest
                                                            <h6 class="title">{{ __('login_to_reply') }}</h6>
                                                        @endguest
                                                    </div>
                                                </form>
                                                @if (count($comment->replies) > 0)
                                                    @foreach ($comment->replies as $reply)
                                                        <div class="comment-area">
                                                            <div class="avatar">
                                                                <img src="{{ asset($reply->user->image_url) }}"
                                                                    alt="avatar">
                                                            </div>
                                                            <div class="content">
                                                                <div class="content__doc">
                                                                    <h6 class="name">
                                                                        {{ $reply->user->first_name }}
                                                                    </h6>
                                                                    <span class="dot"></span>
                                                                    <p class="date">
                                                                        @formatDate($reply->created_at)</p>
                                                                </div>
                                                                <p class="text">{!! nl2br($reply->body) !!}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                                <div class="comment-btn pt-4">
                                    <button class="btn btn-outline-primary" id="load_more">
                                        <x-svg.sync />
                                        {{ __('load_more') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Body End -->
@endsection

@section('frontend_scripts')
    <script>
        function showHideForm(id) {
            var value = document.getElementById(id).style.display;
            if (value == 'none') {
                document.getElementById(id).classList.add('d-none');
            } else {
                document.getElementById(id).classList.remove('d-none');
            }
        }

        function copyToClipboard(text) {
            var inputc = document.body.appendChild(document.createElement("input"));
            inputc.value = window.location.href;
            inputc.focus();
            inputc.select();
            document.execCommand('copy');
            inputc.parentNode.removeChild(inputc);
            alert("{{ __('url_copied') }}.");
        }
    </script>

    <script>
        var divLength = $('.comment_count').length;
        var x = 5;
        $('div.comment_count').slice(x, divLength).hide();
        $('#load_more').on('click', function(e) {
            e.preventDefault();
            x = x + 5;
            $('div.comment_count').slice(3, x).slideDown();

            var hiddendivLength = $("div.comment_count:hidden").length;
            hiddendivLength == 0 ? $("#load_more").hide() : $("#load_more").show();
        });
    </script>
@endsection

@section('frontend_styles')
    <style>
        .facebookcolor {
            color: #3B5998 !important;
        }

        .twittercolor {
            color: #1DA1F2 !important;
        }

        .linkedinkcolor {
            color: #3b5998 !important;
        }

        .whatsappcolor {
            color: #25D366 !important;
        }

        .pinterestcolor {
            color: #CB2027 !important;
        }

        .copycolor {
            color: #77878F !important;
        }
    </style>
@endsection
