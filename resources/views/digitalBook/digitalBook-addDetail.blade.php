<div class="modal fade" id="addDigitalBookDetail">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                Add Detail
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
                            <input type="hidden" id="requestCodeDetail" class="form-control">
                            <input type="text" id="dbTitle" class="form-control">
                            <span  style="color:red;" class="message_error text-red block dbTitle_error"></span>
                        </div>
                        <div class="col-2 mt-2">
                            <p>Type</p>
                        </div>
                        <div class="col-4">
                            <select name="selectType" class="select2" id="selectType">
                                <option value="">Choose Type</option>
                                <option value="1">PS</option>
                                <option value="2">IK</option>
                                <option value="3">PM</option>
                            </select>
                            <input type="hidden" id="dbTypeId" class="form-control">
                            <span  style="color:red;" class="message_error text-red block dbTypeId_error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 mt-2">
                            <p>ISO</p>
                        </div>
                        <div class="col-4">
                            <select name="selectIso" class="select2" id="selectIso"></select>
                            <input type="hidden" id="dbIsoId" class="form-control">
                            <span  style="color:red;" class="message_error text-red block dbIsoId_error"></span>
                        </div>
                        <div class="col-2 mt-2">
                            <p>Location</p>
                        </div>
                        <div class="col-4">
                            <select name="selectLocation" id="selectLocation" class="select2"></select>
                            <input type="hidden" id="dbLocationId" class="form-control">
                            <span  style="color:red;" class="message_error text-red block dbLocationId_error"></span>
                        </div>
                    </div>          
                    <div class="row">
                        <div class="col-2">
                            <p>Description</p>
                        </div>
                        <div class="col-10">
                            <textarea class="form-control" id="dbDescription" rows="4"></textarea>
                            <span  style="color:red;" class="message_error text-red block dbDescription_error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 mt-2">
                            <p>Attachment</p>
                        </div>
                        <div class="col-4 m-2">
                            <input type="file" class="form-control-file" id="dbAttachment">
                            <span  style="color:red;" class="message_error text-red block dbAttachment_error"></span>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button id="btnAddDigitalBookDetail" type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>