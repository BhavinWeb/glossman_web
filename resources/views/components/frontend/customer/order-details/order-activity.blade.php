@props([
    'activities' => [],
])
<ul class="order-activity">
    @foreach ($activities as $activity)
        <li>
            @if ($activity->data['order']['order_status'] == 'pending')
                <span class="icon bg-warning-50">
                    <x-svg.order-placed />
                </span>
            @endif
            @if ($activity->data['order']['order_status'] == 'processing')
                <span class="icon bg-primary-50">
                    <x-svg.packaging />
                </span>
            @endif
            @if ($activity->data['order']['order_status'] == 'on_the_way')
                <span class="icon bg-secondary-50">
                    <x-svg.road />
                </span>
            @endif
            @if ($activity->data['order']['order_status'] == 'delivered')
                <span class="icon bg-success-50">
                    <x-svg.delivered />
                </span>
            @endif
            @if ($activity->data['order']['order_status'] == 'cancelled')
                <span class="icon bg-danger-50">
                    <x-svg.close-circle />
                </span>
            @endif
            <span class="text-wrapper">
                <span class="text">
                    {{ $activity->data['title'] }}
                </span>
                <span class="date">
                    {{ formatDate($activity->created_at, 'd M, Y H:i A') }}
                </span>
            </span>
        </li>
    @endforeach
</ul>
