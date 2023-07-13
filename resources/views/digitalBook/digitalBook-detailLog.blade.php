<div class="modal fade" id="digitalBookDetailLog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                <span id="labelDigitalBookDetailLog"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="mt-2">
                <div class="card">
                    <div class="card-header">
                        Detail Digital Book
                       <div class="card-tools">
                            <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                       </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-2 mt-2">
                                    <p>Detail Code</p>
                                </div>
                                <div class="col-4 mt-2">
                                    <span id="dbdDetailCodeLb"></span>
                                </div>
                                <div class="col-2 mt-2">
                                    <p>Type</p>
                                </div>
                                <div class="col-4 mt-2">
                                    <span id="dbdTypeLb"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2 mt-2">
                                    <p>Location</p>
                                </div>
                                <div class="col-4 mt-2">
                                    <span id="dbdLocationLb"></span>
                                </div>
                                <div class="col-2 mt-2">
                                    <p>Iso</p>
                                </div>
                                <div class="col-4 mt-2">
                                    <span id="dbdIsoLb"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2 mt-2">
                                    <p>Title</p>
                                </div>
                                <div class="col-4 mt-2">
                                    <span id="dbdTitleLb"></span>
                                </div>
                                <div class="col-2 mt-2">
                                    <p>Attachment</p>
                                </div>
                                <div class="col-4 mt-2">
                                    <span id="dbdAttachmentLb"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2 mt-2">
                                    <p>Description</p>
                                </div>
                                <div class="col-10 mt-2">
                                    <span id="dbdDescriptionLb"></span>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="mt-2">
                    <div class="card collapsed-card">
                        <div class="card-header">
                            <i class="fas fa-history"></i> Log 
                            <div class="card-tools">
                                <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="datatable-bordered nowrap display" id="digitalBookDetailLogTable">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Created At</th>
                                        <th style="text-align: center;">PIC</th>
                                        <th style="text-align: center;">Message</th>
                                        <th style="text-align: center;">Attachment</th>
                                    </tr>
                                </thead>
                            </table>    
                        </div>
                    </div>  
                </div>
               </div>
              
            </div>
            <div class="modal-footer justify-content-end">
            </div>
        </div>
    </div>
</div>