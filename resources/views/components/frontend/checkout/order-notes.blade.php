<div class="check-out-body__form--information">
    <div class="additional-information-block">
        <h6 class="title">{{ __('additional_information') }}</h6>
        <div class="additional-information-block__form">
            <form action="#" method="get">
                <div class="form-group">
                    <label for="note" class="form-label">{{ __('order_notes') }}
                        <span>({{ __('optional') }})</span></label>
                    <textarea name="notes" id="note" cols="30" rows="10"
                        placeholder="{{ __('notes_about_your_order') }}, {{ __('e_g') }} {{ __('special_notes_for_delivery') }}"></textarea>
                </div>
            </form>
        </div>
    </div>
</div>
