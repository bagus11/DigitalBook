<div class="modal fade" id="addDigitalBook">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                Add Header
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="row">
                    <div class="col-3 mt-2">
                        <p>Division</p>
                    </div>
                    <div class="col-9 ">
                        <select name="selectDivision" id="selectDivision" class="select2"></select>
                        <input type="hidden" id="dbDivisionId" class="form-control">
                        <span  style="color:red;" class="message_error text-red block dbDivisionId_error"></span>
                    </div>
               </div>
               <div class="row">
                    <div class="col-3 mt-2">
                        <p>Department</p>
                    </div>
                    <div class="col-9 ">
                        <select name="selectDept" class="select2" id="selectDept">
                            <option value="">Choose Division first</option>
                        </select>
                        <input type="hidden" id="dbDeptId" class="form-control">
                        <span  style="color:red;" class="message_error text-red block dbDeptId_error"></span>
                    </div>
               </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button id="btnAddDigitalBook" type="button" class="btn btn-success">
                    <i class="fas fa-check"></i>
                </button>
            </div>
        </div>
    </div>
</div>