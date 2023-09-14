<div class="modal fade" id="addSubmenusModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="your_path" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border" id="submenusLabel"></legend>
                        <div class="row">
                            <div class="col-md-2 mt-2">
                                <p>Title</p>
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" class="form-control" id="optionHSE">
                                <input type="hidden" class="form-control" id="idHSE">
                                <input type="text" class="form-control" id="titleHSE">
                                <span  style="color:red;" class="message_error text-red block titleHSE_error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 mt-2">
                                <p>Description</p>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" id="descriptionHSE" rows="4"></textarea>
                                <span  style="color:red;" class="message_error text-red block descriptionHSE_error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 mt-2">
                                <p>Cover Page</p>
                            </div>
                            <div class="col-md-4 mt-2">
                                <input type="file" class="form-control-file" name="coverAttachmentHSE" id="coverAttachmentHSE">
                                <span  style="color:red;" class="message_error text-red block coverAttachmentHSE_error"></span>
                            </div>
                            <div class="col-md-2 mt-2">
                                <p>Attachment</p>
                            </div>
                            <div class="col-md-4 mt-2">
                                <input type="file" class="form-control-file" name="attachmentHSE" id="attachmentHSE">
                                <span  style="color:red;" class="message_error text-red block attachmentHSE_error"></span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer justify-content-end">
                    <button id="addPageHSE" type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>