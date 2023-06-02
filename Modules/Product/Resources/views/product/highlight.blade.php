{{-- highlight Modal --}}
<div class="modal fade" id="highlightModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('module.product.highlight') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('highlight') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="productId" id="product-for-highlight">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="text-lg">
                                {{ __('featured') }}
                            </div>
                            <div class="">
                                <x-forms.switch-input button="button1" oldvalue="oldalue" name="featured"
                                    onText="{{ __('yes') }}" offText="{{ __('no') }}" value="1"
                                    :checked="0" />
                            </div>
                        </div>
                        <hr>
                        <div class="mt-2 d-flex justify-content-between">
                            <div class="text-lg">
                                {{ __('hot') }}
                            </div>
                            <div class="">
                                <x-forms.switch-input button="button2" oldvalue="oldalue" name="hot"
                                    onText="{{ __('yes') }}" offText="{{ __('no') }}" value="1"
                                    :checked="0" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal" aria-label="Close">
                        {{ __('close') }}
                    </button>
                    <button type="submit" class="btn btn-success">
                        {{ __('update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
