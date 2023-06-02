@props([
    'product' => null
])

<div class="col-lg-3 col-md-4 col-xs-6 col-10 justify-content-center">
    <div onclick="RemoveFromBrowse('{{ $product->product->id }}')" class="text-center">
        <x-svg.close-circle/>
    </div>
    <div class="card-product card-product--05 ">
        <div class="card-image ">
            <img src="{{ $product->product->image_url }}" alt="card">
        </div>
        <div class="card-body p-0">
            <ul class="rating">
                @php
                    $leftValue = 5 - $product->product->avg_rating;
                @endphp
                @for ($i = 0; $i < $product->product->avg_rating; $i++)
                    <li>
                        <x-svg.star height="18" width="18" />
                    </li>
                @endfor
                @if ($leftValue > 0)
                    @for ($i = 0; $i < $leftValue; $i++)
                        <li>
                            <x-svg.null-star />
                        </li>
                    @endfor
                @endif
                <li>({{ $product->product->total_rated }})</li>
            </ul>
            <h6 class="title">
                {{ Str::limit($product->product->title, 48, '...') }}
            </h6>
            <p class="price-valu">{{ multiCurrency($product->product->price) }}</p>
        </div>
    </div>
</div>
