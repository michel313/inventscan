$(function () {

    var base_url = location.origin+'/';

    $('.delProduct').click(function () {

        var token       = $(this).data('token');
        var product_id  = $(this).data('id');
        var self        = this;

        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {

                if (isConfirm) {

                    $.ajax({
                        url: base_url+'products/'+product_id,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {product_id: product_id, _token: token},
                        success: function(response) {

                            if (response.status == 'success') {

                                $(self).closest("tr").remove();

                                swal("Deleted!", "Your imaginary file has been deleted.", "success");
                            }
                        }
                    });

                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }

            });

    });
});

