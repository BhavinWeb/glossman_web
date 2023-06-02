@props([
    'ordersAmount' => 0,
    'productsAmount' => 0,
    'productsAmount' => 0,
    'usersAmount' => 0,
    'brandsAmount' => 0,
    'categoriesAmount' => 0,
    'totalEarnings' => 0,
    ])
<div class="row">
    <div class="col-sm-4">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1">
                <i class="fas fa-money-bill"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">{{ __('earnings') }}</span>
                <span class="info-box-number"> {{ multiCurrency($totalEarnings) }} </span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1">
                <i class="fas fa-cart-arrow-down"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">{{ __('orders') }}</span>
                <span class="info-box-number">{{ $ordersAmount }}</span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-primary elevation-1">
                <i class="fab fa-product-hunt"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">{{ __('product') }}</span>
                <span class="info-box-number"> {{ $productsAmount }} </span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">{{ __('customers') }}</span>
                <span class="info-box-number"> {{ $usersAmount }} </span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="info-box">
            <span class="info-box-icon bg-primary elevation-1">
                <i class="fab fa-bimobject"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">{{ __('brands') }}</span>
                <span class="info-box-number">
                    {{ $brandsAmount }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-info elevation-1">
                <i class="fab fa-codiepie"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">{{ __('categories') }}</span>
                <span class="info-box-number"> {{ $categoriesAmount }} </span>
            </div>
        </div>
    </div>
    <div class="clearfix hidden-md-up"></div>
</div>
