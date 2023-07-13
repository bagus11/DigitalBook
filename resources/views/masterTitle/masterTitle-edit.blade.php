<div class="modal fade" id="editMasterTitle">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                Edit Title
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
                        <input type="hidden" id="titleId" class="form-control">
                        <input type="text" id="titleNameEdit" class="form-control">
                        <span  style="color:red;" class="message_error text-red block titleNameEdit_error"></span>
                    </div>
               </div>
               <div class="row">
                    <div class="col-3 mt-2">
                        <p>Departement</p>
                    </div>
                    <div class="col-9 ">
                        <select name="selectDepartementEdit" class="select2" id="selectDepartementEdit"></select>
                        <input type="hidden" id="departementIdEdit" class="form-control">
                        <span  style="color:red;" class="message_error text-red block departementIdEdit_error"></span>
                    </div>
               </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button id="btnUpdateMasterTitle" type="button" class="btn btn-success">
                    <i class="fas fa-check"></i>
                </button>
            </div>
        </div>
    </div>
</div>