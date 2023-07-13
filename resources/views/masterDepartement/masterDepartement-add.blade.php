<div class="modal fade" id="addMasterDepartement">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                Add Departement
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
                        <input type="text" id="departementName" class="form-control">
                        <span  style="color:red;" class="message_error text-red block departementName_error"></span>
                    </div>
               </div>
               <div class="row">
                    <div class="col-3 mt-2">
                        <p>Initial</p>
                    </div>
                    <div class="col-9 ">
                        <input type="text" id="departementInitial" class="form-control">
                        <span  style="color:red;" class="message_error text-red block departementInitial_error"></span>
                    </div>
               </div>
               <div class="row">
                    <div class="col-3 mt-2">
                        <p>Division</p>
                    </div>
                    <div class="col-9 ">
                        <select name="selectDivision" class="select2" id="selectDivision"></select>
                        <input type="hidden" id="divisionId" class="form-control">
                        <span  style="color:red;" class="message_error text-red block divisionId_error"></span>
                    </div>
               </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button id="btnAddMasterDepartement" type="button" class="btn btn-success">
                    <i class="fas fa-check"></i>
                </button>
            </div>
        </div>
    </div>
</div>