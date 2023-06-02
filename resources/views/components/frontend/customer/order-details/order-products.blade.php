@props([
    'order' => [],
])
<div class="shopping-card-body__wrapper--table">
    <table class="{{ $order->orderProducts->count() ? 'w-100-p':'' }}">
        <thead>
            <tr>
                <th width="40%">{{ __('products') }}</th>
                <th width="15%">{{ __('price') }}</th>
                <th width="10%">{{ __('quantity') }}</th>
                <th width="15%">{{ __('subtotal') }}</th>
                <th width="20%">{{ __('rating') }}</th>
            </tr>
        </thead>
        <tbody>
            @if ($order->orderProducts->count() > 0)
                @foreach ($order->orderProducts as $product)
                    {{-- {{ $product->attributes }} --}}
                    <tr>
                        <td class="products" data-label="Products">
                            <div class="product-wrapper">
                               <a href="{{ route('website.product.detail', $product->product->slug) }}">
                                <img src="{{ $product->product->image_url }}" alt="image">
                               </a>
                                <div class="content">
                                    <span class=" text-uppercase pb-2 text-secondary text-14">
                                        {{ $product->product->category->name }}
                                    </span>
                                    <h6 class="text">
                                        <a href="{{ route('website.product.detail', $product->product->slug) }}">
                                            {{ Str::limit($product->product->title, 76, '...') }}
                                            @if ($product->attributes && count($product->attributes))
                                                (<b>
                                                    @foreach ($product->attributes as $attribute)
                                                        {{ $attribute['attribute'] }}: {{ $attribute['value'] }}
                                                        @if (!$loop->last),@endif
                                                    @endforeach
                                                </b>)
                                            @endif
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </td>
                        <td class="price" data-label="Price">
                            <span class="price-wraper">
                                <span class="main-price text-14 text-gray-900">
                                    {{ multiCurrency($product->product->price) }}
                                </span>
                            </span>
                        </td>
                        <td class="product-quantity" data-label="Quantity">
                            <span class="text-14 text-gray-700">x{{ $product->quantity }}</span>
                        </td>
                        <td class="sub-total" data-label="Sub-Total">
                            {{ multiCurrency($order->total_price) }}
                        </td>
                        <td class="sub-total">
                            <button class="btn btn-primary btn-sm" type="button"
                                onclick="leaveRating({{ $order->id }},{{ $product->product->id }}, {{ $product->product->review != false ? $product->product->review['id'] : 0 }})">
                                @if ($product->product->review != false)
                                    {{ __('view_rating') }}
                                @else
                                    {{ __('leave_a_rating') }}
                                @endif

                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center products" data-label="Products">
                        <div class="text-center p-4">
                            {{ __('nothing_found') }}
                        </div>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

{{-- Rating Modal --}}
<div class="modal modal-three fade" id="ratingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="billing-address-box">
                <div class="form">
                    <form action="{{ route('website.customer.order.product.rating') }}" method="post">
                        @csrf
                        <input type="hidden" id="review_order_id" name="order_id">
                        <input type="hidden" id="review_product_id" name="product_id">
                        <div class="form-group" id="ratingsection">
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('feedback') }}</label>
                            <textarea id="comment" class="form-control" cols="30" rows="10" placeholder="{{ __('write_down_your_feedback_about_our_product_services') }}"
                                name="comment"></textarea>
                        </div>
                        <div class="form-button">
                            <button class="btn btn-primary" type="submit" id="review-title"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('frontend_styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.rateyo.min.css') }}">
    <style>
        .btn-sm {
            padding: 0.25rem 0.5rem !important;
            font-size: 0.8125rem !important;
            border-radius: 0.2rem !important;
        }

    </style>
@endpush

@push('frontend_scripts')
    <script src="{{ asset('frontend/js/jquery.rateyo.min.js') }}"></script>
    <script>

        function leaveRating(orderId, productId, oldreview) {

            $('#review_order_id').val(orderId);
            $('#review_product_id').val(productId);
            $('#ratingModal').modal('show');

            if(oldreview != 0){
                $('#review-title').html('Update Review');
                $.ajax({
                    url: "{{ route('website.customer.get.order.product.rating') }}",
                    type: "POST",
                    data: {
                        data: oldreview,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(data) {

                        $("#ratingsection").html(`
                            <label class="form-label">Rating</label>
                            <div id="rateYo"></div>
                            <input type="hidden" value="${data.stars}" name="stars" id="rating"
                                class="form-control @error('stars') is-invalid @enderror">
                            @error('stars')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        `);
                        $("#rateYo").rateYo({
                            starWidth: '30px',
                            fullStar: true,
                            mormalFill: 'yellow',
                            ratedFill: 'orange',
                            rating: data.stars,
                            onSet: function(rating, rateYoInstance) {
                                $('#rating').val(rating);
                            }
                        });
                        $('#comment').val(data.comment);
                    }
                });
            }else{

                $("#ratingsection").html(`
                    <label class="form-label">Rating</label>
                    <div id="rateYo"></div>
                    <input type="hidden" name="stars" id="rating"
                        class="form-control @error('stars') is-invalid @enderror">
                    @error('stars')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                `);
                $("#rateYo").rateYo({
                    starWidth: '30px',
                    fullStar: true,
                    mormalFill: 'yellow',
                    ratedFill: 'orange',
                    onSet: function(rating, rateYoInstance) {
                        $('#rating').val(rating);
                    }
                });
                $('#comment').val('');
                $('#review-title').html('Publish Review');
            }
            }
    </script>
@endpush
