<div class="modal fade" id="editMasterLocation">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-mainCore">
                Edit Location
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3 col-sm-3 col-md-2 mt-2">
                        <p>Name</p>
                    </div>
                    <div class="col-9 col-sm-9 col-md-4 col-sm-py-3 ">
                        <input type="hidden" class="form-control" id="locationId">
                        <input type="text" class="form-control" id="locationName">
                        <span  style="color:red;" class="message_error text-red block locationName_error"></span>
                    </div>
                    <div class="col-3 col-sm-3 col-md-2 mt-2">
                        <p>Type</p>
                    </div>
                    <div class="col-9 col-sm-9 col-md-4 col-sm-py-3 ">
                        <select name="selectTypeLocation" id="selectTypeLocation" class="select2">
                            <option value="Pusat">Pusat</option>
                            <option value="Cabang">Cabang</option>
                        </select>
                        <input type="hidden" id="locationTypeId" class="form-control">
                        <span  style="color:red;" class="message_error text-red block locationTypeId_error"></span>
                    </div>
                </div>
             
               <div class="row">
                    <div class="col-3 col-sm-3 col-md-2 mt-2">
                        <p>Province</p>
                    </div>
                    <div class="col-9 col-sm-9 col-md-4 col-sm-py-3 ">
                        <select name="selectProvince" id="selectProvince" class="select2">
                        </select>
                        <input type="hidden" id="provinceId" class="form-control">
                        <span  style="color:red;" class="message_error text-red block provinceId_error"></span>
                    </div>
                    <div class="col-3 col-sm-3 col-md-2 mt-2">
                        <p>Region</p>
                    </div>
                    <div class="col-9 col-sm-9 col-md-4 col-sm-py-3 ">
                        <select name="selectRegion" id="selectRegion" class="select2">
                        </select>
                        <input type="hidden" id="regionId" class="form-control">
                        <span  style="color:red;" class="message_error text-red block regionId_error"></span>
                    </div>
               </div>
               <div class="row">
                    <div class="col-3 col-sm-3 col-md-2 mt-2">
                        <p>District</p>
                    </div>
                    <div class="col-9 col-sm-9 col-md-4 col-sm-py-3 ">
                        <select name="selectDistrict" id="selectDistrict" class="select2">
                        </select>
                        <input type="hidden" id="districtId" class="form-control">
                        <span  style="color:red;" class="message_error text-red block districtId_error"></span>
                    </div>
                    <div class="col-3 col-sm-3 col-md-2 mt-2">
                        <p>Village</p>
                    </div>
                    <div class="col-9 col-sm-9 col-md-4 col-sm-py-3 ">
                        <select name="selectVillage" id="selectVillage" class="select2">
                        </select>
                        <input type="hidden" id="villageId" class="form-control">
                        <span  style="color:red;" class="message_error text-red block villageId_error"></span>
                    </div>
               </div>
               <div class="row">
                    <div class="col-3 col-sm-3 col-md-2 mt-2">
                        <p>Postal Code</p>
                    </div>
                    <div class="col-9 col-sm-9 col-md-4 col-sm-py-3 ">
                        <input type="text" class="form-control" id="locationPostalCode">
                    </div>
               </div>
               <div class="row">
                    <div class="col-3 col-sm-3 col-md-2 mt-2">
                        <p>Address</p>
                    </div>
                    <div class="col-9 col-sm-9 col-md-10 col-sm-py-3 ">
                        <textarea class="form-control" id="locationAddress" rows="4"></textarea>
                        <span  style="color:red;" class="message_error text-red block locationAddress_error"></span>
                    </div>
               </div>
              
            </div>
            <div class="modal-footer justify-content-end">
                <button id="btnUpdateLocation" type="button" class="btn btn-success">
                    <i class="fas fa-check"></i>
                </button>
            </div>
        </div>
    </div>
</div>