<script>
    // Call Function
        getData()
    // Call Function

    // Operation
        // Add Title
            $('#add_masterTitle').on('click', function(){
                $('.message_error').html('')
                selectName('getMasterDepartement','selectDepartement','Departement')
            })
            onChange('selectDepartement','departementId')
            $('#btnAddMasterTitle').on('click', function(){
                var data ={
                    'titleName':$('#titleName').val(),
                    'departementId':$('#departementId').val()
                }
                saveHelper('addMasterTitle',data,'masterTitle')
            })
        // Add Title

        // Update Title
            $('#masterTitleTable').on('click','.editMasterTitle', function(){
                $('.message_error').html('')
                selectName('getMasterDepartement','selectDepartementEdit','Departement')
                var id = $(this).data('id')
                $('#titleId').val(id)
                $.ajax({
                    url: 'detailMasterTitle',
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
                        $('#titleNameEdit').val(response.detail.name)
                        $('#departementIdEdit').val(response.detail.departement_id)
                        $('#selectDepartementEdit').val(response.detail.departement_id)
                        $('#selectDepartementEdit').select2().trigger('change');
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to get data, please contact ICT Developer');
                    }
                });   
            })
            $('#masterTitleTable').on('click','.is_checked', function(){
                var id = $(this).data('id')
                updateStatus('updateStatusMasterTitle',id) 
            })
            onChange('selectDepartementEdit','departementIdEdit')

            $('#btnUpdateMasterTitle').on('click', function(){
                var data = {
                    'id'                :$('#titleId').val(),
                    'titleNameEdit'     :$('#titleNameEdit').val(),
                    'departementIdEdit' :$('#departementIdEdit').val(),
                }
                saveHelper('updateMasterTitle', data, 'masterTitle')
            })
        // Update Title
    // Operation

    // Function
        //Get Data & Mapping Data
            function getData(){
                $.ajax({
                    url: 'getMasterTitle',
                    type: "get",
                    dataType: 'json',
                    async: true,
                    beforeSend: function() {
                        SwalLoading('Please wait ...');
                    },
                    success: function(response) {
                        swal.close();
                        mappingTitle(response.data)
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to get data, please contact ICT Developer');
                    }
                });   
            }    
            function mappingTitle(response){
                var data=''
                $('#masterTitleTable').DataTable().clear();
                $('#masterTitleTable').DataTable().destroy();
               
                for(i =0; i < response.length; i++){
                    data += `
                        <tr>
                            <td style="text-align:center"><input type="checkbox" class="is_checked" ${response[i].flg_aktif == 1 ?'checked':''} data-id="${response[i].id}"></td>
                            <td style="text-align:center">${response[i].flg_aktif == 1 ?'active':'inactive'}</td>
                            <td>${response[i].name}</td>
                            <td>${response[i].departement_relation.name}</td>
                            <td>${response[i].departement_relation.division_relation.name}</td>
                            <td style="text-align:center">
                                @can('update-masterTitle')
                                    <button title="Detail" class="editMasterTitle btn-sm btn btn-info rounded"data-id="${response[i]['id']}" data-toggle="modal" data-target="#editMasterTitle">
                                        <i class="fas fa-solid fa-edit"></i>
                                    </button> 
                                @endcan
                                @can('delete-masterTitle')
                                    <button title="Detail" class="deleteMasterDivision btn-sm btn btn-danger rounded"data-id="${response[i]['id']}">
                                        <i class="fas fa-solid fa-trash"></i>
                                    </button> 
                                @endcan
                            </td>
                        </tr>
                    `
                }
                $('#masterTitleTable > tbody:first').html(data);    
                $('#masterTitleTable').DataTable({
                    scrollX     : true,
                    scrollY     :280,
                    // searching   :false
                }).columns.adjust()
            }
        //Get Data & Mapping Data    
    // Function
</script>