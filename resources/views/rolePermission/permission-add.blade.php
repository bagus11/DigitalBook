<div class="modal fade" id="addPermission">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                Add Permission
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="row">
                    <div class="col-md-2 mt-2">
                        <p>Permission</p>
                    </div>
                    <div class="col-md-10">
                        <select name="selectPermissionType" id="selectPermissionType" class="select2">
                            <option value="view">View</option>
                            <option value="create">Create</option>
                            <option value="update">Update</option>
                            <option value="delete">Delete</option>
                        </select>
                        <input type="hidden" id="permissionName" class="form-control">
                        <span  style="color:red;" class="message_error text-red block permissionName_error"></span>
                    </div>
               </div>
               <div class="row mt-2">
                    <div class="col-md-2 mt-2">
                        <p>Menus</p>
                    </div>
                    <div class="col-md-10">
                        <select name="selectMenusName" class="select2" id="selectMenusName"></select>
                    </div>
                    
               </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button id="btnAddPermission" type="button" class="btn btn-success">
                    <i class="fas fa-check"></i>
                </button>
            </div>
        </div>
    </div>
</div>