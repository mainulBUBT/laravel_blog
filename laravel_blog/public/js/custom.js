$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', '#postForm', function(e){

        e.preventDefault();

        let formData = new FormData($('#postForm')[0]);

        $.ajax({
            type: 'POST',
            url: '/blogs',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
               if(data.status == 400){
                $('#error_list').html("");
                $('#error_list').removeClass('d-none');

                $.each(data.errors, function(key, err_value){
                    $('#error_list').append('<li>'+err_value+'</li>');
                });

               }
               else if( data.status == 200){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 3000
                  })
                  $('#postForm').find('input').val('');
                  $('#postForm').find('textarea').val('');
               }
            },
            error: function(data){
                console.log(data);
            }
        });
    });
});