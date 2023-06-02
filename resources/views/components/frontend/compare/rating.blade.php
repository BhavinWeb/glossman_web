@props([
    'rating' => null,
    'rated' => null,
])

<td class="rating">
    <ul>
        @php
            $leftValue = 5 - $rating;
        @endphp
        @for ($i = 0; $i < $rating; $i++)
            <x-svg.star height="18" width="18" />
        @endfor
        @if ($leftValue > 0)
            @for ($i = 0; $i < $leftValue; $i++)
                <x-svg.null-star />
            @endfor
        @endif
        <li class="text">({{ $rated }})</li>
    </ul>
</td>
