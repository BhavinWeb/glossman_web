<script>
    let currency = '{{ config('zakirsoft.currency') }}'
    let symbol = '{{ config('zakirsoft.currency_symbol') }}'
    let position = '{{ config('zakirsoft.currency_symbol_position') }}'

    cartCount();
    cartItems();
    cartSubtotal();

    // Cart
    function AddToCart(productId) {
        $.ajax({
            type: 'POST',
            url: "{{ route('website.cart.add') }}",
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId
            },
            success: function(data) {
                if (data.success) {
                    cartCount()
                    cartItems();
                    cartSubtotal();

                    toastr.success(data.message, 'Success!')
                } else {
                    toastr.error(data.message, 'Error!')
                }
            }
        });
    }

    function removeFromCart(cartId) {
        $.ajax({
            type: 'POST',
            url: "{{ route('website.cart.remove.ajax') }}",
            data: {
                _token: '{{ csrf_token() }}',
                cart_id: cartId
            },
            success: function(data) {
                $('#cart_item_' + cartId).remove();

                if (data.success) {
                    $('.cartCount').html(data.count)
                    if (data.count == 0) {
                        $('#cartsItems').append(
                            `<p class="text-center">No items found</p>`
                        )
                    }

                    cartSubtotal();
                    cartCount();
                    toastr.success(data.message, 'Success!')
                } else {
                    toastr.error(data.message, 'Error!')
                }
            }
        });
    }

    function cartItems() {
        $.ajax({
            type: 'GET',
            url: "{{ route('website.cart.item') }}",
            success: function(data) {
                if (Object.keys(data.items).length) {
                    $("#cartsItems").children().remove();

                    $.each(data.items, function(index, value) {
                        let currency = '{{ config('zakirsoft.currency') }}'
                        let symbol = '{{ config('zakirsoft.currency_symbol') }}'
                        let position = '{{ config('zakirsoft.currency_symbol_position') }}'

                        let price = value.attributes.sale_price ? value.attributes.sale_price :
                            value.price

                        let formatPrice = position == 'left' ? symbol + ' ' + price : price + ' ' + symbol

                        $('#cartsItems').append(
                            `<div class="product-todo" id="cart_item_${value.id}">
                                <div class="card-image">
                                    <img height="80px" width="80px" src="${value.attributes.image}" alt="product">
                                </div>
                                <div class="card-content">
                                    <p class="text">
                                        ${value.name}
                                    </p>
                                    <div class="price-box">
                                        <span class="count">${value.quantity} x</span>
                                        <span class="price">${formatPrice}</span>
                                    </div>
                                </div>
                                <div class="close-btn" onclick="removeFromCart(${value.id})">
                                    <button>
                                        <x-svg.close />
                                    </button>
                                </div>
                            </div>`
                        )
                    });
                } else {
                    $('#cartsItems').append(
                        `<p class="text-center">No items found</p>`
                    )
                }

            }
        });
    }

    function cartCount() {
        $.ajax({
            type: 'GET',
            url: "{{ route('website.cart.count') }}",
            success: function(data) {
                if (data.success) {
                    $('.cartCount').html(data.count)
                }
            }
        });
    }

    function cartSubtotal() {
        $.ajax({
            type: 'GET',
            url: "{{ route('website.cart.subtotal') }}",
            success: function(data) {
                if (data.success) {
                    if (position == 'left') {
                        $("#cartSubtotal").html(`${symbol} ${data.subtotal} ${currency}`)
                    }else{
                        $("#cartSubtotal").html(`${currency} ${data.subtotal} ${symbol}`)
                    }
                }
            }
        });
    }

    function AddToCompare(product) {
        $.ajax({
            url: `/add/to/compare/${product}`,
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(data) {
                window.location.replace("/compare");
            }
        });
    }
</script>
