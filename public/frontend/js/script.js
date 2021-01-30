$(document).ready(function() {


    //Ajax setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /**
     * Sortting Product
     */
    $("#sort").on('change', function() {

        var sort = $(this).val();
        var url = $("#url").val();
        var fabric = get_fabric_filter("fabric");
        var sleeve = get_sleeve_filter("sleeve");
        var pattern = get_pattern_filter("pattern");
        var fit = get_fit_filter("fit");
        var ocassion = get_ocassion_filter("ocassion");
        // $('.bounce-loader').show();
        $.ajax({
            url: url,
            data: {
                fabric: fabric,
                pattern: pattern,
                sleeve: sleeve,
                fit: fit,
                ocassion: ocassion,
                sort: sort,
                url: url
            },
            success: function(data) {
                $('.filtter_product').html(data);
            },
            error: function() {
                console.log("Oops!");
            }
        }).done(function() {
            // hide spinner
            // $('.bounce-loader').hide();
        });


    });

    /**
     * Filter Fabric
     */
    $(".fabric").on('click', function() {

        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        var fabric = get_fabric_filter("fabric");
        var sleeve = get_sleeve_filter("sleeve");
        var pattern = get_pattern_filter("pattern");
        var fit = get_fit_filter("fit");
        var ocassion = get_ocassion_filter("ocassion");
        // $('.bounce-loader').show();
        $.ajax({
            url: url,
            data: {
                fabric: fabric,
                pattern: pattern,
                sleeve: sleeve,
                fit: fit,
                ocassion: ocassion,
                sort: sort,
                url: url
            },
            success: function(data) {
                $('.filtter_product').html(data);
            },
            error: function() {
                console.log("Oops!");
            }
        })
    });

    /**
     * Sleeve filter
     */
    $(".sleeve").on('click', function() {

        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        var fabric = get_fabric_filter("fabric");
        var sleeve = get_sleeve_filter("sleeve");
        var pattern = get_pattern_filter("pattern");
        var fit = get_fit_filter("fit");
        var ocassion = get_ocassion_filter("ocassion");
        // $('.bounce-loader').show();
        $.ajax({
            url: url,
            data: {
                fabric: fabric,
                pattern: pattern,
                sleeve: sleeve,
                fit: fit,
                ocassion: ocassion,
                sort: sort,
                url: url
            },
            success: function(data) {
                $('.filtter_product').html(data);
            },
            error: function() {
                console.log("Oops!");
            }
        })
    });


    /**
     * Pattern filter
     */
    $(".pattern").on('click', function() {

        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        var fabric = get_fabric_filter("fabric");
        var sleeve = get_sleeve_filter("sleeve");
        var pattern = get_pattern_filter("pattern");
        var fit = get_fit_filter("fit");
        var ocassion = get_ocassion_filter("ocassion");
        // $('.bounce-loader').show();
        $.ajax({
            url: url,
            data: {
                fabric: fabric,
                pattern: pattern,
                sleeve: sleeve,
                fit: fit,
                ocassion: ocassion,
                sort: sort,
                url: url
            },
            success: function(data) {
                $('.filtter_product').html(data);
            },
            error: function() {
                console.log("Oops!");
            }
        })
    });
    /**
     * Fit filter
     */
    $(".fit").on('click', function() {

        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        var fabric = get_fabric_filter("fabric");
        var sleeve = get_sleeve_filter("sleeve");
        var pattern = get_pattern_filter("pattern");
        var fit = get_fit_filter("fit");
        var ocassion = get_ocassion_filter("ocassion");
        // $('.bounce-loader').show();
        $.ajax({
            url: url,
            data: {
                fabric: fabric,
                pattern: pattern,
                sleeve: sleeve,
                fit: fit,
                ocassion: ocassion,
                sort: sort,
                url: url
            },
            success: function(data) {
                $('.filtter_product').html(data);
            },
            error: function() {
                console.log("Oops!");
            }
        })
    });
    /**
     * Ocassion filter
     */
    $(".ocassion").on('click', function() {

        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        var fabric = get_fabric_filter("fabric");
        var sleeve = get_sleeve_filter("sleeve");
        var pattern = get_pattern_filter("pattern");
        var fit = get_fit_filter("fit");
        var ocassion = get_ocassion_filter("ocassion");
        // $('.bounce-loader').show();
        $.ajax({
            url: url,
            data: {
                fabric: fabric,
                pattern: pattern,
                sleeve: sleeve,
                fit: fit,
                ocassion: ocassion,
                sort: sort,
                url: url
            },
            success: function(data) {
                $('.filtter_product').html(data);
            },
            error: function() {
                console.log("Oops!");
            }
        })
    });
    /**
     * get fabric filter
     */
    function get_fabric_filter() {
        var filter = [];
        $('.fabric:checkbox:checked').each(function() {
            filter.push($(this).val());
        });
        return filter;
    }


    /**
     * get Sleeve filter
     */
    function get_sleeve_filter() {
        var filter = [];
        $('.sleeve:checkbox:checked').each(function() {
            filter.push($(this).val());
        });
        return filter;
    }
    /**
     * get pattern filter
     */
    function get_pattern_filter() {
        var filter = [];
        $('.pattern:checkbox:checked').each(function() {
            filter.push($(this).val());
        });
        return filter;
    }

    /**
     * get Fit filter
     */
    function get_fit_filter() {
        var filter = [];
        $('.fit:checkbox:checked').each(function() {
            filter.push($(this).val());
        });
        return filter;
    }
    /**
     * get Ocassion filter
     */
    function get_ocassion_filter() {
        var filter = [];
        $('.ocassion:checkbox:checked').each(function() {
            filter.push($(this).val());
        });
        return filter;
    }

    /**
     * Get Attribute Price
     */
    $("#getPrice").change(function() {
        var size = $(this).val();
        if (size == "") {
            swal("NO..!", "Please select one of this size", "error");
        }
        var product_id = $(this).attr("product_id");
        $.ajax({
            url: '/get-product-price',
            "_token": "{{ csrf_token() }}",
            data: {
                size: size,
                product_id: product_id,
            },
            type: 'post',
            success: function(resp) {
                if (resp['discount_price'] > 0) {
                    $(".getAttPrice").html("Tk. " + resp['final_price'] + "<del class='old-price'> tk " + resp['proAttributePrice'] + "</del>");
                } else {
                    $(".getAttPrice").html("Tk. " + resp['proAttributePrice']);
                }
            },
            error: function() {}
        });
    })

    /**
     * Cart Item Update
     */
    $(document).on("click", ".btnItemUpdate", function() {
        if ($(this).hasClass('qtnMinus')) {
            var quantity = $(this).next().val();
            if (quantity <= 1) {
                swal("Oppss....!", "Item must be 1 or greater", "error");
            } else {
                new_qty = parseInt(quantity) - 1;
            }
        }
        if ($(this).hasClass('qtnPlus')) {
            var quantity = $(this).prev().val();
            new_qty = parseInt(quantity) + 1;
        }
        var cartid = $(this).data('cartid');
        $.ajax({
            url: "/update-cart-item-quantity",
            data: { cartid: cartid, quantity: new_qty },
            type: 'post',
            success: function(resp) {
                if (resp.status == false) {
                    swal("Oppss....!", "Requried quntity is not availble!", "error");
                } else {
                    $('#appentCartItem').html('').html(resp.view);
                    toastr.options = {
                        "closeButton": true,
                        'closeHtml': '<button>&#xd7;</button>',
                        "progressBar": true,
                        "showMethod": "slideDown",
                    }
                    toastr["success"]("Cart updated successfully!")
                }

            },
            error: function() {}
        });
        return false;
    });
    /** 
     *  Delete Cart Item 
     */
    $(document).on("click", ".btnItemDelete", function() {
        var cartid = $(this).data('cartid');
        swal({
            title: 'Are you sure?',
            text: 'Delete cart item',
            icon: 'warning',
            buttons: ["Cancel", "Delete!"],
        }).then(function(value) {
            if (value) {
                $.ajax({
                    url: "/delete-cart-item",
                    data: { cartid: cartid },
                    type: 'post',
                    success: function(resp) {
                        $('#appentCartItem').html('').html(resp.view);
                        toastr.options = {
                            "closeButton": true,
                            'closeHtml': '<button>&#xd7;</button>',
                            "progressBar": true,
                            "showMethod": "slideDown",
                        }
                        toastr["success"]("Item deleted successfully!")
                    },
                    error: function() {}
                });
                return false;
            }
        });

    });
});