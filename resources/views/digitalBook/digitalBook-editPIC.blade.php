<div class="modal fade" id="editPICDigitalBook">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                Edit PIC
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editPICId">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                Current PIC
                            </div>
                            <div class="card-body">
                                <table class="datatable-stepper nowrap display" id="digitalBookCurrentPICTable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;"></th>
                                            <th style="text-align: center;">Name</th>
                                            <th style="text-align: center;">Title</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-danger" id="btnDeletePic" title="Delete PIC" style="float: right">
                                    <i class="fa-solid fa-user-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                New PIC
                            </div>
                            <div class="card-body">
                                <table class="datatable-stepper nowrap display" id="digitalBookNewPICTable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;"></th>
                                            <th style="text-align: center;">Name</th>
                                            <th style="text-align: center;">Title</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="card-footer justify-content-end">
                                <button class="btn btn-sm btn-success" id="btnAddNewPIC" title="Add PIC" style="float: right">
                                    <i class="fa-solid fa-user-plus"></i>
                                </button>
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