<script>
    // Call Function
        getData()
    // Call Function

    // Opertaion
        // Add Master Departement
            $('#add_masterDepartement').on('click', function(){
                $('.message_error').html('')
                selectName('getMasterDivision','selectDivision','Division')
            })
            onChange('selectDivision','divisionId')

            $('#btnAddMasterDepartement').on('click', function(){
                var data ={
                    'divisionId'                :$('#divisionId').val(),
                    'departementInitial'        :$('#departementInitial').val(),
                    'departementName'           :$('#departementName').val()
                }
                saveHelper('addMasterDepartement',data,'masterDepartement')
            })
        // Add Master Departement
        // Update Master Departement
            $('#masterDepartementTable').on('click','.editMasterDepartement', function(){
                $('.message_error').html('')
                var id = $(this).data('id');
                selectName('getMasterDivision','selectDivisionEdit', 'Division')
                $('#divisionId').val(id)
                $.ajax({
                    url: 'detailMasterDepartement',
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
                        console.log(response.detail)
                        $('#departmentId').val(id)
                        $('#departementNameEdit').val(response.detail.name)
                        $('#departementInitialEdit').val(response.detail.initial)
                        $('#selectDivisionEdit').val(response.detail.division_relation.id)
                        $('#selectDivisionEdit').select2().trigger('change');
                        $('#divisionEditId').val(response.detail.division_relation.id)
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to get data, please contact ICT Developer');
                    }
                });   
            })
            onChange('selectDivisionEdit','divisionEditId')
            $('#btnUpdateMasterDepartement').on('click', function(){
                var data ={
                    'id'                    :$('#departmentId').val(),
                    'departementNameEdit'   :$('#departementNameEdit').val(),
                    'departementInitialEdit'   :$('#departementInitialEdit').val(),
                    'divisionEditId'        :$('#divisionEditId').val()
                }
                saveHelper('updateMasterDepartement',data,'masterDepartement')
            })

            // Update Flag Active 
            $('#masterDepartementTable').on('click','.is_checked', function(){
                var id = $(this).data('id')
                updateStatus('updateStatusMasterDepartement',id)
            })
            // Update Flag Active 
        // Update Master Departement

    // Opertaion

    // Function
      // Get Data && Mapping
            function getData(){
                $.ajax({
                    url: 'getMasterDepartement',
                    type: "get",
                    dataType: 'json',
                    async: true,
                    beforeSend: function() {
                        SwalLoading('Please wait ...');
                    },
                    success: function(response) {
                        swal.close();
                        mappingDepartement(response.data)
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to get data, please contact ICT Developer');
                    }
                });   
            }

            function mappingDepartement(response){
                var data=''
                $('#masterDepartementTable').DataTable().clear();
                $('#masterDepartementTable').DataTable().destroy();
                for(i =0; i < response.length; i++){
                    data += `
                        <tr>
                            <td style="text-align:center"><input type="checkbox" class="is_checked" ${response[i].flg_aktif == 1 ?'checked':''} data-id="${response[i].id}"></td>
                            <td style="text-align:center">${response[i].flg_aktif == 1 ? 'active':'inactive'}</td>
                            <td>${response[i].name}</td>
                            <td>${response[i].division_relation.name}</td>
                            <td style="text-align:center">
                                @can('update-masterDepartement')
                                    <button title="Detail" class="editMasterDepartement btn-sm btn btn-info rounded"data-id="${response[i]['id']}" data-toggle="modal" data-target="#editMasterDepartement">
                                        <i class="fas fa-solid fa-edit"></i>
                                    </button> 
                                @endcan
                                @can('delete-masterDepartement')
                                    <button title="Detail" class="deleteMasterDivision btn-sm btn btn-danger rounded"data-id="${response[i]['id']}">
                                        <i class="fas fa-solid fa-trash"></i>
                                    </button> 
                                @endcan
                            </td>
                        </tr>
                    `
                }
                $('#masterDepartementTable > tbody:first').html(data);    
                $('#masterDepartementTable').DataTable({
                    scrollX     : true,
                    scrollY     :280,
                    // searching   :false
                }).columns.adjust()
            }
        // Get Data && Mapping
    // Function


    // Testing

    // Testing
</script>
