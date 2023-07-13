<div class="modal fade" id="editQueueDigitalBook">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                Edit Queue
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row justify-content-end">
                    <div class="col-2 mt-2">
                        <p>Location</p>
                    </div>
                    <div class="col-4">
                        <select name="sortSelectLocation" class="select2" id="sortSelectLocation"></select>
                    </div>
              </div>
              <div class="row">
                <div class="col-12">
                    <input type="hidden" name="sortId" id="sortId">
                    <table class="datatable-stepper nowrap display" id="digitalBookSortTable">
                        <thead>
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">Detail Code</th>
                                <th style="text-align: center;">Title</th>
                                <th style="text-align: center;">ISO</th>
                                <th style="text-align: center;">Location</th>
                            </tr>
                        </thead>
                    </table>
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