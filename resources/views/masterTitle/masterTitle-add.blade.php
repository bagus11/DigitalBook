<div class="modal fade" id="addMasterTitle">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                Add Title
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="row">
                    <div class="col-3 mt-2">
                        <p>Name</p>
                    </div>
                    <div class="col-9 ">
                        <input type="text" id="titleName" class="form-control">
                        <span  style="color:red;" class="message_error text-red block titleName_error"></span>
                    </div>
               </div>
               <div class="row">
                    <div class="col-3 mt-2">
                        <p>Departement</p>
                    </div>
                    <div class="col-9 ">
                        <select name="selectDepartement" class="select2" id="selectDepartement"></select>
                        <input type="hidden" id="departementId" class="form-control">
                        <span  style="color:red;" class="message_error text-red block departementId_error"></span>
                    </div>
               </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button id="btnAddMasterTitle" type="button" class="btn btn-success">
                    <i class="fas fa-check"></i>
                </button>
            </div>
        </div>
    </div>
</div>