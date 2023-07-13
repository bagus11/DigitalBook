<div class="modal fade" id="editMasterDivision">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                Edit Division
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="row">
                    <div class="col-3 mt-2">
                        <p>Name</p>
                    </div>
                    <div class="col-9">
                        <input type="hidden" id="divisionId" class="form-control">
                        <input type="text" id="divisionNameEdit" class="form-control">
                        <span  style="color:red;" class="message_error text-red block divisionNameEdit_error"></span>
                    </div>
               </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button id="btnUpdateMasterDivision" type="button" class="btn btn-success">
                    <i class="fas fa-check"></i>
                </button>
            </div>
        </div>
    </div>
</div>