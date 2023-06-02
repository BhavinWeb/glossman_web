<div class="news-section-01 bg-gray-50">
    <div class="container">
        <div class="news-section-01__title-block">
            <h2 class="title">{{ __('latest_posts') }}</h2>
        </div>
        <div class="row card-row justify-content-center">
            @foreach ($latestNews as $news)
                <div class="col-xl-4 col-sm-10 col-lg-6 col-md-6 col-xs-11">
                    <div class="card-news">
                        <div class="card-image">
                            <a href="{{ route('website.post.details', $news->slug) }}">
                                <img src="{{ asset($news->image_url) }}" alt="news" class="w-100">
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body__meta">
                                <div class="user-block">
                                    <x-svg.user-sm-round />
                                    <span>{{ $news->author->first_name }}</span>
                                </div>
                                <div class="date-block">
                                    <x-svg.calendar-sm-round />
                                    <span>@formatDate($news->created_at)</span>
                                </div>
                                <div class="comment-block">
                                    <x-svg.comment-sm-round />
                                    <span>{{ $news->commentsCount() }}</span>
                                </div>
                            </div>
                            <a href="{{ route('website.post.details', $news->slug) }}">
                                <h2 class="title">{{ $news->title }}</h2>
                            </a>
                            <p class="text">{{ $news->short_description }}</p>
                            <a class="btn btn-outline-primary"
                                href="{{ route('website.post.details', $news->slug) }}">
                                {{ __('read_more') }}
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.625 10H17.375" stroke="" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M11.75 4.375L17.375 10L11.75 15.625" stroke="" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
