<div class="modal fade" id="editMasterIso">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                Edit ISO
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
                        <input type="hidden" id="isoId" class="form-control">
                        <input type="text" id="isoNameEdit" class="form-control">
                        <span  style="color:red;" class="message_error text-red block isoNameEdit_error"></span>
                    </div>
               </div>
               <div class="row">
                    <div class="col-3 mt-2">
                        <p>Description</p>
                    </div>
                    <div class="col-9 ">
                        <textarea class="form-control" id="isoDescriptionEdit" rows="4"></textarea>
                        <span  style="color:red;" class="message_error text-red block isoDescriptionEdit_error"></span>
                    </div>
               </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button id="btnUpdateIso" type="button" class="btn btn-success">
                    <i class="fas fa-check"></i>
                </button>
            </div>
        </div>
    </div>
</div>