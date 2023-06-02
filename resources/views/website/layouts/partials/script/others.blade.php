<script>
    $(".niceselect-selector").niceSelect();

    function fetchproductAttribute(productId) {
        $('#attribute_modal_procuct_id').val(productId);

        var url = "{{ route('website.product.attribute', ':id') }}";
        url = url.replace(':id', productId);

        $.ajax({
            url: url,
            type: "GET",
            dataType: 'json',
            success: function(res) {
                let product_attributes = res.data;

                if (res.success) {
                    $('#attributeModal').modal('show');
                    $('#attribute_modal_form .form-group').remove();

                    $.each(product_attributes, function(key, attributes) {
                        var options = [];

                        for (var i = 0, len = attributes.length; i < len; ++i) {
                            options.push(
                                `<option value="${attributes[i].value_id}">${attributes[i].value}</option>`
                            );
                        }

                        $("#attribute_modal_form").append(
                            `<div class="form-group my-2">
                                <label for="form-label">${key}</label>
                                <select name="value_id[]" id="${key}" class="form-select">
                                    ${options.join('')}
                                </select>
                            </div>`
                        );
                    });
                } else {
                    AddToCart(productId)
                }
            }
        });
    }

    /**
     * Replace all SVG images with inline SVG
     */
    $(document).ready(function() {
        $('img[class*="make-it-inline"]').each(function() {
            var $img = jQuery(this);
            var imgURL = $img.attr('src');
            var attributes = $img.prop("attributes");

            $.get(imgURL, function(data) {
                // Get the SVG tag, ignore the rest
                var $svg = jQuery(data).find('svg');

                // Remove any invalid XML tags
                $svg = $svg.removeAttr('xmlns:a');

                // Loop through IMG attributes and apply on SVG
                $.each(attributes, function() {
                    $svg.attr(this.name, this.value);
                });

                // Replace IMG with SVG
                $img.replaceWith($svg);
            }, 'xml');
        });
    });



    //  Wishlist
    function AddToFavorite(product) {
        $.ajax({
            type: 'POST',
            url: '/customer/toggle/favorite/' + product,
            data: {
                _token: '{{ csrf_token() }}',
                product: product
            },
            success: function(data) {
                if (data.data == true) {
                    $('#svg' + product).css("fill", '#333');
                    toastr.success("Product added to wishlist", 'Success!')
                } else {
                    $('#svg' + product).css("fill", '#fff');
                    toastr.success("Product removed from wishlist !", 'Success!')
                }
            }
        });
    }
</script>
