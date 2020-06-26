    $(document).ready(function () {
        $('.ajaxModal').click(function () {
            
            var lexikonID = $(this).data('id');

            // AJAX request
            $.ajax({
                url: './inc/loadModal.inc.php',
                type: 'POST',
                data: {
                    lexikonID: lexikonID
                },
                success: function (response) {
                    //Add response in Modal body
                    $('#showModal .modal-content').html(response);
                    console.log(response);
                    //Display Modal
                    $('#showModal').modal('show');
                }
            });
        });
    });