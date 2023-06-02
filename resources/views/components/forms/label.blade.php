@props(['name', 'required' => true, 'for' => null, 'class' => 'text-danger', 'labelclass' => 'form-label-required'])

<label class="{{ $labelclass }}" for="{{ $for ? $for : $name }}">
    {{ __($name) }}

    @if ($required)
        <span class="{{ $class }}">*</span>
    @endif

    {{ $slot }}
</label>
