<script>
    function onChange(selectId, id){
        $('#'+selectId).on('change', function(){
            $('.message_error').html('')
            var x = $('#'+ selectId).val()
            $('#'+id).val(x)
        })
    }
    function saveHelper(url,data,route){
        $.ajax({
           
            url: url,
            type: "post",
            dataType: 'json',
            async: true,
            data: data,
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('.message_error').html('')
                toastr['success'](response.meta.message);
                window.location = route;
            },
            error: function(response) {
                $('.message_error').html('')
                swal.close();
                if(response.status == 500){
                    console.log(response)
                    toastr['error'](response.responseJSON.meta.message);
                    return false
                }
                if(response.status === 422)
                {
                    $.each(response.responseJSON.errors, (key, val) => 
                        {
                            $('span.'+key+'_error').text(val)
                        });
                }else{
                    toastr['error']('Failed to get data, please contact ICT Developer');
                }
            }
        });
    }
    function selectName(route, id, name){
            $.ajax({
            url: route,
            type: "get",
            dataType: 'json',
            async: true,
            success: function(response) {
                swal.close();
                $('#'+id).empty();
                $('#'+id).append('<option value ="">Choose '+ name +'</option>');
                $.each(response.data,function(i,data,param){
                    $('#'+id).append('<option value="'+data.id+'">' + data.name +'</option>');
                });
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
                }
            });
    }
    function selectDetailName(route,data,id, name){
            $.ajax({
            url: route,
            type: "get",
            data:data,
            dataType: 'json',
            async: true,
            beforeSend: function() {
                $('#'+id).prop('disabled', true);
                // $('#loading'+id).html('<i class="fa fa-spinner fa-spin"></i> Loading...');
            },
            success: function(response) {
                swal.close();
                $('#'+id).prop('disabled', false);
                $('#'+id).empty();
                $('#'+id).append('<option value ="">Choose '+ name +'</option>');
                $.each(response.data,function(i,data,param){
                    $('#'+id).append('<option value="'+data.id+'">' + data.name +'</option>');
                });
                
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
                }
            });
    }
    function getPostalCode(route,data,id){
            $.ajax({
            url: route,
            type: "get",
            data:data,
            dataType: 'json',
            async: true,
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                $('#'+id).val(response.detail.kd_pos);   
            },
            error: function(xhr, status, error) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
                }
            });
    }
    function updateStatus(route,id){
        $.ajax({
            url: route,
            type: "post",
            dataType: 'json',
            data:{
                'id':id
            },
            async: true,
            beforeSend: function() {
                SwalLoading('Please wait ...');
            },
            success: function(response) {
                swal.close();
                if(response.status ==200){
                    toastr['success'](response.message);
                    getData()
                }else{
                    toastr['error'](response.message);
                }
            },
            error: function(response) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });  
    }
    function postCallback(route,data,callback){
        $.ajax({
            url: route,
            type: "post",
            dataType: 'json',
            data:data,
            // async: true,
            // beforeSend: function() {
            //     SwalLoading('Please wait ...');
            // },
            success:callback,
            error: function(response) {
                swal.close();
                toastr['error']('Failed to get data, please contact ICT Developer');
            }
        });  
    }
    function getCallback(route,data,callback){
        $.ajax({
        url: route,
        type: "get",
        dataType: 'json',
        data:data,
        beforeSend: function() {
            SwalLoading('Please wait ...');
        },
        success: callback,
        error: function(xhr, status, error) {
            swal.close();
            toastr['error']('Failed to get data, please contact ICT Developer');
            }
        }); 
    }
    function getCallbackNoLoading(route,data,callback){
        $.ajax({
        url: route,
        type: "get",
        dataType: 'json',
        data:data,
        success: callback,
        error: function(xhr, status, error) {
            toastr['error']('Failed to get data, please contact ICT Developer');
            }
        }); 
    }
    function postAttachment(route,data,withFile,callback){
        $.ajax({
                url: route,
                type: 'POST',
                type: "post",
                dataType: 'json',
                async: true,
                processData: withFile,
                contentType: withFile,
                data: data,
                beforeSend: function() {
                    SwalLoading('Please wait ...');
                },
                success:callback,
                error: function(response) {
                    $('.message_error').html('')
                    swal.close();
                    if(response.status == 500){
                        console.log(response)
                        toastr['error'](response.responseJSON.meta.message);
                        return false
                    }
                    if(response.status === 422){
                        $.each(response.responseJSON.errors, (key, val) => 
                            {
                                $('span.'+key+'_error').text(val)
                            });
                    }else{
                        toastr['error']('Failed to get data, please contact ICT Developer');
                    }
                }
        });
    }
</script>