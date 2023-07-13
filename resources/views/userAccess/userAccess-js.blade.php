<script>
    // Call Function
        getData()
    // Call Function

    // Operation
        // Add Role User
            $('#add_roleUser').on('click', function(){
                $('.message_error').html('')
                $('#userId').val('')
                $('#roleId').val('')
                selectName('getRole','selectRole','Role')
                selectName('getUser','selectUser','User')
            })
            onChange('selectRole','roleId')
            onChange('selectUser','userId')

            $('#btnAddRoleUser').on('click', function(){
                var data={
                    'userId':$('#userId').val(),
                    'roleId':$('#roleId').val()
                }
                saveHelper('addRoleUser',data,'userAccess')
            })
        // Add Role User

        // Edit Role User
            $('#roleUserTable').on('click','.editRoleUser', function(){
                var id = $(this).data('id');
                selectName('getUser','selectUserEdit','User')
                selectName('getRole','selectRoleEdit','User')
                $.ajax({
                    url: 'detailRoleUser',
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
                        $('#userIdEdit').val(id)
                        $('#selectUserEdit').val(id)
                        $('#selectUserEdit').select2().trigger('change');
                        $('#roleIdEdit').val(response.detail.role_id)
                        $('#selectRoleEdit').val(response.detail.role_id)
                        $('#selectRoleEdit').select2().trigger('change');
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to delete record, please contact ICT Developer');
                    }
                });   
                
            })
            onChange('selectRoleEdit','roleIdEdit')
            onChange('selectUserEdit','userIdEdit')
            
            $('#btnUpdateRoleUser').on('click', function(){
                var data={
                    'roleIdEdit':$('#roleIdEdit').val(),
                    'userIdEdit':$('#userIdEdit').val(),
                }
                saveHelper('updateRoleUser',data,'userAccess')
            })
        // Edit Role User

        // Edit Role Permission
            // Add Role Permission
                $('#roleTable').on('click','.addPermission', function(){
                    var id = $(this).data('id');
                    $.ajax({
                        url: 'getRolePermissionDetail',
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
                            $('#roleIdPermissionAdd').val(id)
                            mappingInactive(response.inactive)
                        },
                        error: function(response) {
                            swal.close();
                            toastr['error']('Failed to delete record, please contact ICT Developer');
                        }
                    });   
                })

                $('#btnAddRolePermission').on('click', function(){
                    var checkArray = [];
                    var lengthParsed = 0;
                    var rolePermissionInactiveTable = $('#rolePermissionInactiveTable').dataTable();
                    var rowcollection =  rolePermissionInactiveTable.$("input:checkbox[name=check]:checked",{"page": "all"});
                    rowcollection.each(function(){
                        checkArray.push($(this).data("name"));
                    });

                    lengthParsed = checkArray.length;
                    if(lengthParsed == 0)
                    {
                        toastr['error']('Cannot be null');
                        return false;
                    }

                    var data ={
                        'checkArray':checkArray,
                        'roleIdPermissionAdd':$('#roleIdPermissionAdd').val(),
                    }
                    saveHelper('saveRolePermission',data,'userAccess')
                })
                $('#checkAllPermissionInnactiveTable').on('click', function(){
                    // Get all rows with search applied
                    var table = $('#rolePermissionInactiveTable').DataTable();
                    var rows = table.rows({ 'search': 'applied' }).nodes();
                    // Check/uncheck checkboxes for all rows in the table
                    $('input[type="checkbox"]', rows).prop('checked', this.checked);
                });
                

            // Add Role Permission

            // Delete Role Permission
                $('#roleTable').on('click','.deletePermission', function(){
                    var id = $(this).data('id');
                    $.ajax({
                        url: 'getRolePermissionDetail',
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
                            $('#roleIdPermissionDelete').val(id)
                            mappingActive(response.active)
                        },
                        error: function(response) {
                            swal.close();
                            toastr['error']('Failed to delete record, please contact ICT Developer');
                        }
                    });   
                })
                $('#btnDeleteRolePermission').on('click', function(){
                    var checkArray = [];
                    var lengthParsed = 0;
                    var rolePermissionActiveTable = $('#rolePermissionActiveTable').dataTable();
                    var rowcollection =  rolePermissionActiveTable.$("input:checkbox[name=check]:checked",{"page": "all"});
                    rowcollection.each(function(){
                        checkArray.push($(this).val());
                    });

                    lengthParsed = checkArray.length;
                    if(lengthParsed == 0)
                    {
                        toastr['error']('Cannot be null');
                        return false;
                    }

                    var data ={
                        'checkArray':checkArray,
                        'roleIdPermissionDelete':$('#roleIdPermissionDelete').val(),
                    }
                    $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "destroyRolePermission",
                        type: "get",
                        dataType: 'json',
                        data:data,
                        async: true,
                        beforeSend: function() {
                            SwalLoading('Please wait ...');
                        },
                        success: function(response) {
                            swal.close();
                            if(response.status==500)
                            {
                                toastr['error'](response.message);
                                return false
                            }else{
                                toastr['success'](response.message);
                                window.location = "{{route('userAccess')}}";
                            }
                            
                        },
                        error: function(xhr, status, error) {
                            swal.close();
                            toastr['error']('Failed to get data, please contact ICT Developer');
                        }
                    });
                })
                $('#checkAllPermissionActiveTable').on('click', function(){
                    // Get all rows with search applied
                    var table = $('#rolePermissionActiveTable').DataTable();
                    var rows = table.rows({ 'search': 'applied' }).nodes();
                    // Check/uncheck checkboxes for all rows in the table
                    $('input[type="checkbox"]', rows).prop('checked', this.checked);
                });
                
            // Delete Role Permission
        // Edit Role Permission


    // Operation

    // Function
    
        //Get Data & Mapping Table
            // Get Data Function
                function getData(){
                    $.ajax({
                        url: 'getRoleUser',
                        type: "get",
                        dataType: 'json',
                        async: true,
                        beforeSend: function() {
                            SwalLoading('Please wait ...');
                        },
                        success: function(response) {
                            swal.close();
                            mappingRoleUser(response.roleUser)
                            mappingRole(response.role)
                            
                        },
                        error: function(response) {
                            swal.close();
                            toastr['error']('Failed to get data, please contact ICT Developer');
                        }
                    });   
                }
            // Get Data Function
            // Mapping Table
                function mappingRoleUser(response){
                    var data =''
                    $('#roleUserTable').DataTable().clear();
                    $('#roleUserTable').DataTable().destroy();
                    for(i =0; i < response.length; i++){
                        data += `
                            <tr>
                                <td>${response[i].userName}</td>
                                <td>${response[i].rolesName}</td>
                                <td style="text-align:center">
                                    <button title="Detail" class="editRoleUser btn btn-sm btn-primary rounded"data-id="${response[i]['user_id']}" data-toggle="modal" data-target="#editRoleUser">
                                            <i class="fas fa-solid fa-eye"></i>
                                    </button>
                                
                                </td>
                            </tr>
                        `
                    }
                    $('#roleUserTable > tbody:first').html(data);    
                    $('#roleUserTable').DataTable({
                        scrollX     : true,
                        scrollY     :280,
                        // searching   :false
                    }).columns.adjust()
                }
                function mappingRole(response){
                    var data =''
                    $('#roleTable').DataTable().clear();
                    $('#roleTable').DataTable().destroy();
                    for(i = 0; i < response.length; i ++){
                        data +=`
                            <tr>
                                <td>${response[i].name}</td>
                                <td style="text-align:center">
                                    <button title="Add Permission" class="addPermission btn btn-sm btn-success rounded"data-id="${response[i]['id']}" data-toggle="modal" data-target="#addPermission">
                                            <i class="fas fa-solid fa-plus"></i>
                                    </button>    
                                    <button title="List" class="deletePermission btn btn-sm btn-danger rounded"data-id="${response[i]['id']}" data-toggle="modal" data-target="#deletePermission">
                                            <i class="fas fa-solid fa-list"></i>
                                    </button>    
                                </td>
                            </tr>
                        `;
                    }
                    $('#roleTable > tbody:first').html(data);    
                    $('#roleTable').DataTable({
                        scrollX     : true,
                        scrollY     :280,
                        searching   :false
                    }).columns.adjust()
                }
            // Mapping Table
        //Get Data & Mapping Table 
        
        // Mapping Active & Inactive Permission
            // Mapping Inactive Permission
                function mappingInactive(response){
                    var data =''
                    $('#rolePermissionInactiveTable').DataTable().clear();
                    $('#rolePermissionInactiveTable').DataTable().destroy();
                    for(i = 0; i < response.length; i ++){
                        data +=`
                            <tr>
                                <td style="text-align: center;"> <input type="checkbox" id="check" name="check" class="is_checked" style="border-radius: 5px !important;" value="${response[i]['id']}"  data-name="${response[i]['name']}"></td>
                                <td>${response[i].name}</td>
                            </tr>
                        `;
                    }
                    $('#rolePermissionInactiveTable > tbody:first').html(data);    
                    $('#rolePermissionInactiveTable').DataTable({
                        scrollX     : true,
                        scrollY     :280,
                        // searching   :false
                    }).columns.adjust()
                }
            // Mapping Inactive Permission
            
            // Mapping Active
                function mappingActive(response){
                    var data =''
                    $('#rolePermissionActiveTable').DataTable().clear();
                    $('#rolePermissionActiveTable').DataTable().destroy();
                    for(i = 0; i < response.length; i ++){
                        data +=`
                            <tr>
                                <td style="text-align: center;"> <input type="checkbox" id="check" name="check" class="is_checked" style="border-radius: 5px !important;" value="${response[i]['id']}"  data-name="${response[i]['id']}"></td>
                                <td>${response[i].name}</td>
                            </tr>
                        `;
                    }
                    $('#rolePermissionActiveTable > tbody:first').html(data);    
                    $('#rolePermissionActiveTable').DataTable({
                        scrollX     : true,
                        scrollY     :280,
                        // searching   :false
                    }).columns.adjust()
                }
            // Mapping Active
        // Mapping Active & Inactive Permission
    // Function
</script>