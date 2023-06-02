@props([
    'recentProducts' => $recentProducts,
])
<div class="col-12">
    <div class="card">
        <div class="row d-flex items-center justify-content-between p-3 mt-1">
            <div class="col-9">
                {{ __('recent_products') }}
            </div>
            <div class="col-3">
                <form id="filterForm" action="{{ route('admin.dashboard') }}">
                    <select name="filter" id="filter" class="form-control w-100-p">
                        <option {{ request('filter') == 'trending' ? 'selected' : '' }} value="trending" selected>
                            {{ __('trending') }}
                        </option>
                        <option {{ request('filter') == 'best_rated' ? 'selected' : '' }} value="best_rated">
                            {{ __('best_rated') }}
                        </option>
                        <option {{ request('filter') == 'top_selling' ? 'selected' : '' }} value="top_selling">
                            {{ __('top_selling') }}
                        </option>
                    </select>
                </form>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <div class="table-responsive">
                <table class="table table-vcenter">
                    <thead class="text-center">
                        <tr>
                            <th class="w-1">{{ __('no') }}.</th>
                            <th>{{ __('image') }}</th>
                            <th>{{ __('title') }}</th>
                            <th>{{ __('total_orders') }}</th>
                            <th>{{ __('price') }}</th>
                            <th>{{ __('category') }}</th>
                            <th>{{ __('options') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @if ($recentProducts->count() > 0)
                            @foreach ($recentProducts as $product)
                                <tr>
                                    <td>
                                        <span class="text-muted">
                                            {{ $loop->index + 1 }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('module.product.show', $product->id) }}">
                                            <img width="55px" height="55px" src="{{ asset($product->image) }}"
                                                class="rounded" alt="Product Image">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('module.product.show', $product->id) }}">
                                            {{ Str::limit($product->title, 30, '...') }}
                                        </a>
                                    </td>
                                    <td>
                                        <span>
                                            {{ $product->total_orders }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($product->sale_price)
                                            {{ multiCurrency($product->sale_price) }}
                                            <del>{{ multiCurrency($product->price) }}</del>
                                        @else
                                            {{ multiCurrency($product->price) }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('category.wise.product', $product->category_id) }}">{{ $product->category->name }}
                                        </a>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('module.product.show', $product->id) }}"
                                            class="btn btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    <div class="empty py-5">
                                        <div class="empty-img">
                                            <img src="{{ asset('backend/image') }}/not-found.svg" height="128"
                                                alt="">
                                        </div>
                                        <h5 class="mt-4">{{ __('no_results_found') }}</h5>
                                        <p class="empty-subtitle text-muted">
                                            {{ __('there_is_no') }} {{ __('found_in_this_page') }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
