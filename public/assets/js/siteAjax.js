$(function () {

    base_url = location.origin+'/';

    $('.deleteAjax').click(function () {
        
        token       = $(this).data('token');
        deleteID    = $(this).data('id');
        self        = this;

        routeUrl    =  $(this).data('type');

        switch(routeUrl){
            case 'deleteChildProduct':
                sendUrl = 'child-product';
            break;
            case 'deleteProduct':
                sendUrl = 'products';
            break;
            case 'deleteServer':
                sendUrl = 'servers';
            break;
        }

        deleteAjax(sendUrl);
    });

    $('.import_form').submit(function (e) {

        e.preventDefault();
        
        var url = $(this).attr('action');
        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');

        $('.ajax-errors').removeClass('alert alert-danger');
        $('.ajax-errors').html('');


        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: $(this).serialize(),
            success: function(response) {
                if (response.status == 'success') {
                    window.location.href = base_url+'products';
                }
            },
            error: function(data){
                var errors = data.responseJSON;
                var div    = $('.ajax-errors').addClass('alert alert-danger').append('<ul></ul>');

                $.each(errors, function(element, error) {

                    div.append('<li>'+error+'</li>');

                });
            }

        });

    })

});

function deleteAjax(url){
    
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
                    url: base_url+url+'/'+deleteID,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {deleteID: deleteID, _token: token},
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


}







































