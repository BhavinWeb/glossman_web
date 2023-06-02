@props(['orderid'])

<a onclick="return confirm('{{ __('are_you_sure_to_mark_as_paid') }}')"
    href="{{ route('manual.payment.mark.paid', $orderid) }}">
    {{ __('mark_as_paid') }}
</a>
