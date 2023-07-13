<script>
    // Call Function
    getData()
    // Call Function

    // Operation
        // Add ISO
            $('#add_masterIso').on('click', function(){
                $('.message_error').html('')
                $('#isoName').val('')
                $('#isoDescription').val('')
            })
            $('#btnAddIso').on('click', function(){
                var data ={
                    'isoName':$('#isoName').val(),
                    'isoDescription':$('#isoDescription').val(),
                }
                saveHelper('addIso', data, 'masterIso')
            })
        // Add ISO

        // Update ISO
            $('#masterIsoTable').on('click', '.editMasterIso', function(){
                var id = $(this).data('id')
                $('.message_error').html('')
                $.ajax({
                    url: 'detailMasterIso',
                    type: "get",
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
                        $('#isoId').val(id)
                        $('#isoNameEdit').val(response.detail.name)
                        $('#isoDescriptionEdit').val(response.detail.description)
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to get data, please contact ICT Developer');
                    }
                });   
            })
            $('#btnUpdateIso').on('click', function(){
                var data ={
                    'id'                    :$('#isoId').val(),
                    'isoNameEdit'           :$('#isoNameEdit').val(),
                    'isoDescriptionEdit'    :$('#isoDescriptionEdit').val()
                }
               saveHelper('updateIso', data, 'masterIso')
            })

            $('#masterIsoTable').on('click','.is_checked', function(){
                var id = $(this).data('id')
                updateStatus('updateStatusIso',id) 
            })
        // Update ISO
    // Operation

    // Function
        // Get Data && Mapping
            function getData(){
                $.ajax({
                    url: 'getMasterIso',
                    type: "get",
                    dataType: 'json',
                    async: true,
                    beforeSend: function() {
                        SwalLoading('Please wait ...');
                    },
                    success: function(response) {
                        swal.close();
                       mappingISO(response.data)
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to get data, please contact ICT Developer');
                    }
                });   
            }

            function mappingISO(response){
                var data=''
                $('#masterIsoTable').DataTable().clear();
                $('#masterIsoTable').DataTable().destroy();
               
                for(i =0; i < response.length; i++){
                    data += `
                        <tr>
                            <td style="text-align:center"><input type="checkbox" class="is_checked" ${response[i].flg_active == 1 ?'checked':''} data-id="${response[i].id}"></td>
                            <td>${response[i].flg_active == 1 ?'active':'inactive'}</td>
                            <td>${response[i].name}</td>
                            <td style="text-align:center">
                                @can('update-masterIso')
                                    <button title="Detail" class="editMasterIso btn-sm btn btn-info rounded"data-id="${response[i]['id']}" data-toggle="modal" data-target="#editMasterIso">
                                        <i class="fas fa-solid fa-edit"></i>
                                    </button> 
                                @endcan
                            </td>
                        </tr>
                    `
                }
                $('#masterIsoTable > tbody:first').html(data);    
                $('#masterIsoTable').DataTable({
                    scrollX     : true,
                    scrollY     :280,
                }).columns.adjust()
            }
        // Get Data && Mapping
    // Function
</script>