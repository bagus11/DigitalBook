<div class="modal fade" id="editMasterDepartement">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                Edit Departement
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
                        <input type="hidden" id="departmentId" class="form-control">
                        <input type="text" id="departementNameEdit" class="form-control">
                        <span  style="color:red;" class="message_error text-red block departementNameEdit_error"></span>
                    </div>
               </div>
               <div class="row">
                    <div class="col-3 mt-2">
                        <p>Initial</p>
                    </div>
                    <div class="col-9 ">
                        <input type="text" id="departementInitialEdit" class="form-control">
                        <span  style="color:red;" class="message_error text-red block departementInitialEdit_error"></span>
                    </div>
               </div>
               <div class="row">
                    <div class="col-3 mt-2">
                        <p>Division</p>
                    </div>
                    <div class="col-9 ">
                        <select name="selectDivisionEdit" class="select2" id="selectDivisionEdit"></select>
                        <input type="hidden" id="divisionEditId" class="form-control">
                        <span  style="color:red;" class="message_error text-red block divisionEditId_error"></span>
                    </div>
               </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button id="btnUpdateMasterDepartement" type="button" class="btn btn-success">
                    <i class="fas fa-check"></i>
                </button>
            </div>
        </div>
    </div>
</div>