<script>
    // Call Function
        getData()
    // Call Function

    // Operation
        // Add Role 
            $('#add_role').on('click', function(){
                $('#rolesName').val('')
                $('.message_error').html('')
            })
            $('#btnAddRole').on('click', function(){
                var data = {
                    'rolesName' : $('#rolesName').val()
                }
                saveHelper('saveRole',data,'rolePermission')
            })
        // Add Role 

        // Add Permission
            $('#add_permission').on('click', function(){
                $('#permissionName').val('')
                $('.message_error').html('')
                getMenusName()
            })
            $('#btnAddPermission').on('click', function(){
                var data = {
                'permissionName' : $('#permissionName').val()
                }
                saveHelper('savePermissions',data,'rolePermission')
            })
            $('#selectPermissionType').on('change', function(){
                var selectPermissionType = $('#selectPermissionType').val()
                var selectMenusName = $('#selectMenusName').val()
                $('#permissionName').val(selectPermissionType+'-'+selectMenusName)
            })
            $('#selectMenusName').on('change', function(){
                var selectPermissionType = $('#selectPermissionType').val()
                var selectMenusName = $('#selectMenusName').val()
                $('#permissionName').val(selectPermissionType+'-'+selectMenusName)
            })
        // Add Permission

        // Edit Role
            $('#roleTable').on('click', '.editRoles', function(){
                var id = $(this).data('id');
                $.ajax({
                    url: 'roleDetail',
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
                        $('#roleId').val(id)
                        $('#rolesNameEdit').val(response.detail.name)
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to get data, please contact ICT Developer');
                    }
                });   
            })

            $('#btnUpdateRole').on('click', function(){
                var data ={
                    'id':$('#roleId').val(),
                    'rolesNameEdit':$('#rolesNameEdit').val(),
                }
                saveHelper('updateRole',data,'rolePermission')
            })
        // Edit Role

        // Delete Role
        $('#roleTable').on('click', '.deleteRole', function(){
                var id = $(this).data('id');
                $.ajax({
                    url: 'deleteRole',
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
                        if(response.status == 200){
                            toastr['success'](response.message);
                            getData()
                        }
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to delete record, please contact ICT Developer');
                    }
                });   
            })
        $('#permissionTable').on('click', '.deletePermission', function(){
                var id = $(this).data('id');
                $.ajax({
                    url: 'deletePermission',
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
                        if(response.status == 200){
                            toastr['success'](response.message);
                            getData()
                        }
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to delete record, please contact ICT Developer');
                    }
                });   
            })
        // Delete Role
    // Operation

    // Function
        // Get Data Table
            function getData(){
                    $.ajax({
                        url: 'getRolePermission',
                        type: "get",
                        dataType: 'json',
                        async: true,
                        beforeSend: function() {
                            SwalLoading('Please wait ...');
                        },
                        success: function(response) {
                            swal.close();
                            mappingRole(response.role)
                            mappingPermission(response.permission)
                        },
                        error: function(response) {
                            swal.close();
                            toastr['error']('Failed to get data, please contact ICT Developer');
                        }
                    });   
            }
            function mappingRole(response){
                var data =''
                $('#roleTable').DataTable().clear();
                $('#roleTable').DataTable().destroy();

                for(i =0; i < response.length; i++){
                    data += `
                        <tr>
                            <td>${response[i].name}</td>
                            <td style="text-align:center">
                                <button title="Detail" class="editRoles btn btn-sm btn-primary rounded"data-id="${response[i]['id']}" data-toggle="modal" data-target="#editRoles">
                                        <i class="fas fa-solid fa-eye"></i>
                                </button>
                                <button title="Delete" class="deleteRole btn btn-sm btn-danger"data-id="${response[i]['id']}">
                                    <i class="fas fa-solid fa-trash"></i>
                                </button>   
                            </td>
                        </tr>
                    `
                }
                $('#roleTable > tbody:first').html(data);    
                $('#roleTable').DataTable({
                    scrollX     : true,
                    scrollY     :280,
                    searching   :false
                }).columns.adjust()
            }
            function mappingPermission(response){
                var data=''
                $('#permissionTable').DataTable().clear();
                $('#permissionTable').DataTable().destroy();

                for(i =0; i < response.length; i++){
                    data += `
                        <tr>
                            <td>${response[i].name}</td>
                            <td style="text-align:center">
                                <button title="Delete" class="deletePermission btn btn-sm btn-danger"data-id="${response[i]['id']}">
                                    <i class="fas fa-solid fa-trash"></i>
                                </button>   
                            </td>
                        </tr>
                    `
                }
                $('#permissionTable > tbody:first').html(data);    
                $('#permissionTable').DataTable({
                    scrollX     : true,
                    scrollY     :280,
                    // searching   :false
                }).columns.adjust()
            }
        // Get Data Table
        
        // Get Menus Name
            function getMenusName(){
                    $.ajax({
                        url: 'getMenusName',
                        type: "get",
                        dataType: 'json',
                        async: true,
                        beforeSend: function() {
                            SwalLoading('Please wait ...');
                        },
                        success: function(response) {
                            swal.close();
                            $('#selectMenusName').empty()
                            $.each(response.data,function(i,data,param){
                            $('#selectMenusName').append('<option value="'+data.link+'">' + data.name +'</option>');
                        });
    
                        },
                        error: function(response) {
                            swal.close();
                            toastr['error']('Failed to get data, please contact ICT Developer');
                        }
                    });   
            }
        // Get Menus Name
    // Function
</script>