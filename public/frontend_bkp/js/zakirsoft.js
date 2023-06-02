"use strict";

function productQuickView(productId) {
    $.ajax({
        type: 'GET',
        url: '/products/quick/' + productId,
        success: function (data) {
            $('#productViewModal').modal('show');

            $('#product-modal-data').append(
                `<div class="row">
                <div class="col-xl-6">
                    <div class="slider-area">
                        <div class="product-slider--03">
                            <div class="single-slider">
                                <img src="{{ asset('frontend') }}/image/product/mac.png" alt="mac">
                            </div>
                        </div>
                        <div class="silde-wrap">
                            <div class="product-slider--03__nav">
                                <div class="single-slide">
                                    <div class="small-prduct">
                                        <img src="{{ asset('frontend') }}/image/product/gallery/01.png"
                                            alt="product">
                                    </div>
                                </div>
                            </div>
                            <div class="product-slider--03__control-buttons">
                                <button class="button button--prev">
                                    <x-svg.arrow-long-left stroke="white" />
                                </button>
                                <button class="button button--next">
                                    <x-svg.arrow-long-right stroke="white" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="slider-content">
                        <div class="slider-content__ratting">
                            <ul>
                                <li>
                                    <x-svg.star width="20" height="20" />
                                <li class="rating-text">4.7 Star Rating</li>
                                <li class="feedback-text">(21,671 User feedback)</li>
                            </ul>
                        </div>
                        <div class="slider-content__title">
                            <h6>${data.title}</h6>
                        </div>
                        <div class="slider-content__fact">
                            <ul>
                                <li>Sku: <span>${data.sku}</span></li>
                                <li>Availability: <span class="stock">In Stock</span></li>
                                <li>Brand: <span>${data.brand.name}</span></li>
                                <li>Category: <span>${data.category.name}</span></li>
                            </ul>
                        </div>
                        <div class="slider-content__price-block">
                            <div class="price">
                                ${productQuickViewPrice(data.sale_price, data.price)}
                            </div>
                            <div class="offer-badge">
                                <span class="badge">21% OFF</span>
                            </div>
                        </div>
                        <div class="slider-content__form">
                            <div class="slider-content__form--color">
                                <h6 class="title">Color</h6>
                                <div class="choose-color">
                                    <div class="form-check">
                                        <input class="form-check-input space-gray" type="radio"
                                            name="flexRadioDefault" checked>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input sliver" type="radio" name="flexRadioDefault">
                                    </div>
                                </div>
                            </div>
                            <div class="slider-content__form--size">
                                <h6 class="title">Size</h6>
                                <div class="selectbox">
                                    <select class="nice-select">
                                        <option data-display="14-inch Liquid Retina XDR display">14-inch Liquid
                                            Retina XDR display</option>
                                        <option value="1">13-inch Liquid Retina XDR display</option>
                                        <option value="2">16-inch Liquid Retina XDR display</option>
                                    </select>
                                </div>
                            </div>
                            <div class="slider-content__form--memory">
                                <h6 class="title">Memory</h6>
                                <div class="selectbox">
                                    <select class="nice-select">
                                        <option data-display="16GB unified memory">16GB unified memory</option>
                                        <option value="1">32GB unified memory</option>
                                        <option value="2">64GB unified memory</option>
                                    </select>
                                </div>
                            </div>
                            <div class="slider-content__form--storage">
                                <h6 class="title">Storage</h6>
                                <div class="selectbox">
                                    <select class="nice-select">
                                        <option data-display="1TV SSD Storage">1TV SSD Storage</option>
                                        <option value="1">2TV SSD Storage</option>
                                        <option value="2">4TV SSD Storage</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="slider-content__button-group">
                            <div class="product-quantity-count">
                                <button class="button-count quantity-decrease">
                                    <x-svg.minus />
                                </button>
                                <input type="number" class="number-product quantity-one">
                                <button class="button-count quantity-increase">
                                    <x-svg.plus />
                                </button>
                            </div>
                            <div class="product-add-button">
                                <a class="btn btn-primary" href="#">Add to card
                                    <x-svg.cart width="25" height="24" stroke="white" />
                                </a>
                            </div>
                            <div class="product-buy-button">
                                <a class="btn btn-outline-primary" href="#">Buy now
                                </a>
                            </div>
                        </div>
                        <div class="slider-content__content">
                            <div class="content-one">
                                <a href="#">
                                    <x-svg.love stroke="#475156" />
                                    Add to Wishlist
                                </a>
                                <a href="#">
                                    <x-svg.sync />
                                    Add to Compare
                                </a>
                            </div>
                            <div class="content-two">
                                <ul>
                                    <li class="text">Share product:</li>
                                    <li class="copy"><a href="#">
                                            <x-svg.copy />
                                        </a></li>
                                    <li class="fb"><a href="#">
                                            <x-svg.facebook-circle />
                                        </a></li>
                                    <li><a href="#">
                                            <x-svg.twitter-circle />
                                        </a></li>
                                    <li><a href="#">
                                            <x-svg.pinterest-circle />
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="slider-content__payment-method">
                            <p>100% Guarantee Safe Checkout</p>
                            <img src="{{ asset('frontend') }}/image/payment-method.png" alt="payment-method.png">
                        </div>
                    </div>
                </div>
            </div>`
            );
        }
    });
}

function productQuickViewPrice(sale_price, price) {
    if (sale_price) {
        return '<span>$' + sale_price + '</span>'
        '<del>$' + price + '</del>';
    } else {
        return '<span>$' + price + '</span>'
    }
}
