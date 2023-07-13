<div class="modal fade" id="editRoles">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                Edit Roles
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="row">
                    <div class="col-md-2 mt-2">
                        <p>Name</p>
                    </div>
                    <div class="col-md-10">
                        <input type="hidden" id="roleId" class="form-control">
                        <input type="text" id="rolesNameEdit" class="form-control">
                        <span  style="color:red;" class="message_error text-red block rolesNameEdit_error"></span>
                    </div>
               </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button id="btnUpdateRole" type="button" class="btn btn-success">
                    <i class="fas fa-check"></i>
                </button>
            </div>
        </div>
    </div>
</div>