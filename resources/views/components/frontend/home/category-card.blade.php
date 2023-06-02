@props([
    'category' => $category,
])

<a href="{{ route('website.product', ['category' => $category->slug]) }}" class="single-item">
    <div class="card-product card-product--02 ">
        <div class="card-image ">
            <img src="{{ $category->image }}" alt="{{ __('category_image') }}" class="mw-100">
        </div>
        <div class="card-body p-0">
            <h6 class="title">{{ $category->name }}</h6>
        </div>
    </div>
</a>
