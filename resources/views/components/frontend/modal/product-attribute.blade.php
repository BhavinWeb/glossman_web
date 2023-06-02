<div class="modal fade" id="attributeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('variants') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('website.single.cart.quantity.update') }}" method="post"
                    id="attribute_modal_form">
                    @csrf
                    <input type="text" name="id" hidden id="attribute_modal_procuct_id">
                    <input name="quantity" value="1" hidden>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('close') }}</button>
                <button onclick="$('#attribute_modal_form').submit()" type="button" class="btn btn-primary">{{ __('add_to_cart') }}</button>
            </div>
        </div>
    </div>
</div>
