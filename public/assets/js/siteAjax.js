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

        $('.create_import').prop('disabled',true).prepend('<i class=" animate-spinner  fa fa-spinner" aria-hidden="true"></i>');



        e.preventDefault();
        
        var url = $(this).attr('action');
        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');

        $('.ajax-errors').removeClass('alert alert-danger').html('');


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

    });


    var nextEvent = true;
    $('.export-page a').click(function (e) {

        e.preventDefault();

        var path      = $('#path option:selected').val();
        var token     = $('.token').val();
        var myUrl     = $(this).attr('href');
        var currThis  = $(this);

        if(nextEvent == true){

            nextEvent = false;

            $(this).append('<i class="animate-spinner  fa fa-spinner" aria-hidden="true"></i>');
            //
            // $('.export-page a').attr('disabled','disabled');

            $.ajax({
                url: myUrl,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    _token:token,
                    path:path
                },
                success: function(response) {

                    nextEvent = true;

                    if(response.status == 'success'){

                        if(response.data != undefined){

                            var ifr = $('<iframe />').attr('src', 'http://inventscan.dev/assets/exports-xls/'+response.data).hide().appendTo($('.download'))
                            setTimeout(function () {ifr.remove();}, 5000);

                        }

                        currThis.find('i').remove();

                        $('.export-page a').removeAttr('disabled');

                    }else if(response.status == 'error'){

                        alert('Error ,Please Try Again')

                    }
                }
            });

        }



    })

});

function deleteAjax(url){
    
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
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







































