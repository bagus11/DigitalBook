<script>
    // Call Function
        getData()
    // Call Function

    // Operation
        // Add Division 
            $('#btnAddMasterDivision').on('click', function(){
                var data={
                    'divisionName':$('#divisionName').val()
                }
                saveHelper('addMasterDivision',data,'masterDivision');
            })
            $('#add_masterDivision').on('click', function(){
                $('.message_error').html('')
                $('#divisionName').val('')
            })
        // Add Division 

        // Edit Division
            $('#masterDivisionTable').on('click','.editMasterDivision', function(){
                $('.message_error').html('')
                var id = $(this).data('id');
                $('#divisionId').val(id)
                $.ajax({
                    url: 'detailMasterDivision',
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
                        $('#divisionNameEdit').val(response.detail.name)
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to get data, please contact ICT Developer');
                    }
                });   
            })
            $('#btnUpdateMasterDivision').on('click',function(){
                var data={
                    'id':$('#divisionId').val(),
                    'divisionNameEdit':$('#divisionNameEdit').val()
                }
                saveHelper('updateMasterDivision', data, 'masterDivision')
            })
        // Edit Division

        // Delete Division
            $('#masterDivisionTable').on('click','.deleteMasterDivision', function(){
                var id = $(this).data('id');
                $.ajax({
                    url: 'deleteMasterDivision',
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
                        if(response.status ==200){
                            getData()
                            toastr['success'](response.message);
                        }else{
                            toastr['error'](response.message);
                        }
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to get data, please contact ICT Developer');
                    }
                });   
            })
        // Delete Division
    // Operation

    // Function
        // Get Data && Mapping
            function getData(){
                $.ajax({
                    url: 'getMasterDivision',
                    type: "get",
                    dataType: 'json',
                    async: true,
                    beforeSend: function() {
                        SwalLoading('Please wait ...');
                    },
                    success: function(response) {
                        swal.close();
                        mappingDivision(response.data)
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to get data, please contact ICT Developer');
                    }
                });   
            }

            function mappingDivision(response){
                var data=''
                $('#masterDivisionTable').DataTable().clear();
                $('#masterDivisionTable').DataTable().destroy();
                for(i =0; i < response.length; i++){
                    data += `
                        <tr>
                            <td>${response[i].name}</td>
                            <td style="text-align:center">
                                @can('update-masterDivision')
                                    <button title="Detail" class="editMasterDivision btn-sm btn btn-info rounded"data-id="${response[i]['id']}" data-toggle="modal" data-target="#editMasterDivision">
                                        <i class="fas fa-solid fa-edit"></i>
                                    </button> 
                                @endcan
                                @can('delete-masterDivision')
                                    <button title="Detail" class="deleteMasterDivision btn-sm btn btn-danger rounded"data-id="${response[i]['id']}">
                                        <i class="fas fa-solid fa-trash"></i>
                                    </button> 
                                @endcan
                            </td>
                        </tr>
                    `
                }
                $('#masterDivisionTable > tbody:first').html(data);    
                $('#masterDivisionTable').DataTable({
                    scrollX     : true,
                    scrollY     :280,
                    // searching   :false
                }).columns.adjust()
            }
        // Get Data && Mapping
    // Function
</script>