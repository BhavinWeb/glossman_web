@props([
    'count' => 0
])
<ul class="keyword">
    <li class="key-text">{{ __('active_filters') }}:</li>
    @if(request('title') !== null)
        <li>
            <span>{{ request('title') }}</span>
            <x-frontend.filter-remove name="title" />
        </li>
    @endif
    @if(request('date') !== null)
        <li>
            <span>{{ request('date') }}</span>
            <x-frontend.filter-remove name="date" />
        </li>
    @endif
    @if(request('items') !== null)
        <li>
            <span>{{ request('items') }}</span>
            <x-frontend.filter-remove name="items" />
        </li>
    @endif
</ul>
@if (request('name') || request('date') || request('items'))
    <div class="results-found">
        <span class="number">{{ $count }}</span>
        <span class="text">{{ __('results_found') }}.</span>
    </div>
@endif
