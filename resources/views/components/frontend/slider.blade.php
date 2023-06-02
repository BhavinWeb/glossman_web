@props(['sliders', 'offerstatus' => false])

<div class="col-xxl-{{ $offerstatus ? '8' : '12' }}">
    <div class="banner-area__slider">
        <div class="product-slider-01">
            @foreach ($sliders as $slider)
                <div class="single-slider">
                    <div class="banner-slider-content-01">
                        <div class="banner-content">
                            <h6 class="subtitle text-secondary-500 text-14 text-uppercase"><span
                                    class="line"></span>{{ $slider->sub_title }}</h6>
                            <h2 class="titel">{{ $slider->title }}</h2>
                            @if ($slider->details !== null)
                                <p class="text">{{ $slider->details }}
                                </p>
                            @endif
                            @if ($slider->button_text !== null)
                                <a class="btn btn-primary" href="{{ $slider->button_url }}">
                                    {{ $slider->button_text }}
                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.625 10H17.375" stroke="" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M11.75 4.375L17.375 10L11.75 15.625" stroke="" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                        <div class="banner-image-group">
                            <img src="{{ url($slider->image_url) }}" alt="x-box">
                            @if ($slider->price !== null)
                                <div class="price-tag">
                                    <span>{{ multiCurrency($slider->price) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
