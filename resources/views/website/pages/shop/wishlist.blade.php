@extends('website.layouts.app')

@section('title', __('wishlist'))

@section('website-content')
    <!-- Breadrumb Section Start -->
    <x-frontend.breadcrumb>
        <x-svg.arrow-right />
        <span class="page-text text-secondary-500">{{ __('wishlist') }}</span>
    </x-frontend.breadcrumb>
    <!-- Breadrumb Section End -->
    <!-- Content Body Start -->
    <div class="wishlist-body">
        <div class="container">
            @if ($wishlists->count() > 0)
                <div id="wishlistcontent" class="wishlist-body__wrapper">
                    <h6 class="title">{{ __('wishlist') }}</h6>
                    <x-frontend.wishlist.table :wishlists="$wishlists" />
                </div>
            @else
                <x-frontend.not-found message="your_favorite_list_is_empty" button="add_product" />
            @endif
        </div>
    </div>
    <!-- Content Body End -->
@endsection
@section('frontend_scripts')
    <script>
        //  Wishlist
        function removeFavorite(index, product) {
            $.ajax({
                type: 'POST',
                url: '/customer/toggle/favorite/' + product,
                data: {
                    _token: '{{ csrf_token() }}',
                    product: product
                },
                success: function(data) {
                    $('#wishlisttr' + product).empty();
                    if (data.wishlists == 0) {
                        $('#wishlistcontent').empty();
                        $('#wishlistcontent').html(`
                            <div class="text-center">
                                No Data Found !
                            </div>
                        `);
                    }
                }
            });
        }
    </script>
@endsection
