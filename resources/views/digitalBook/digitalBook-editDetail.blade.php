<div class="modal fade" id="editDigitalBookDetail">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                <span id="detailCodeLabel"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="your_path" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-2 mt-2">
                            <p>Title</p>
                        </div>
                        <div class="col-4">
                            <input type="hidden" id="dbdDetailCode" class="form-control">
                            <input type="text" id="dbdTitle" class="form-control">
                            <span  style="color:red;" class="message_error text-red block dbdTitle_error"></span>
                        </div>
                        <div class="col-2 mt-2">
                            <p>Type</p>
                        </div>
                        <div class="col-4">
                            <select name="dbdSelectType" class="select2" id="dbdSelectType" disabled>
                                <option value="">Choose Type</option>
                                <option value="1">PS</option>
                                <option value="2">IK</option>
                            </select>
                            <input type="hidden" id="dbdTypeId" class="form-control">
                            <span  style="color:red;" class="message_error text-red block dbdTypeId_error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 mt-2">
                            <p>ISO</p>
                        </div>
                        <div class="col-4">
                            <input type="text" style="text-align: center" disabled id="dbdIsoName" class="form-control">
                            <span  style="color:red;" class="message_error text-red block dbdIsoName_error"></span>
                        </div>
                        <div class="col-2 mt-2">
                            <p>Location</p>
                        </div>
                        <div class="col-4">
                            <input type="text" style="text-align: center" disabled id="dbdLocationName" class="form-control">
                            <span  style="color:red;" class="message_error text-red block dbdLocationName_error"></span>
                        </div>
                    </div>          
                    <div class="row">
                        <div class="col-2">
                            <p>Description</p>
                        </div>
                        <div class="col-10">
                            <textarea class="form-control" id="dbdDescription" rows="4"></textarea>
                            <span  style="color:red;" class="message_error text-red block dbdDescription_error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 mt-2">
                            <p>Attachment</p>
                        </div>
                        <div class="col-4 m-2">
                            <input type="file" class="form-control-file" id="dbdAttachment">
                            <span  style="color:red;" class="message_error text-red block dbdAttachment_error"></span>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button id="btnUpdateDigitalBookDetail" type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>