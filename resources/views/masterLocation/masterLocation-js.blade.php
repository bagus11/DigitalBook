<script>
    // Call Function
        getData()
    // Call Function

    // Operation
            // On Change Location
              
                $('#selectProvince').on('change', function(){
                    var id = $('#selectProvince').val()
                    $('#provinceId').val(id)
                    var data={'id':id}
                    selectDetailName('getRegion',data,'selectRegion','Region')
                })

                $('#selectRegion').on('change', function(){
                    var id = $('#selectRegion').val()
                    $('#regionId').val(id)
                    var data={'id':id}
                    selectDetailName('getDistrict',data,'selectDistrict','District')
                })
               
                $('#selectDistrict').on('change', function(){
                    var id = $('#selectDistrict').val()
                    $('#districtId').val(id)
                    var data={'id':id}
                    selectDetailName('getVillage',data,'selectVillage','Village')
                })
                $('#selectVillage').on('change', function(){
                    var id = $('#selectVillage').val()
                    $('#districtId').val(id)
                    var data={'id':id}
                    getPostalCode('getPostalCode',data,'locationPostalCode')
                })
               
            // On Change Location
        // Edit Master Location
            $('#masterLocationTable').on('click', '.editMasterLocation', function(){
                $('.message_error').html('')
                var id = $(this).data('id');
                selectName('getProvince','selectProvince','Province')
                $.ajax({
                    url: 'detailMasterLocation',
                    type: "get",
                    dataType: 'json',
                    data:{
                        'id':id
                    },
                    async: true,
                    beforeSend: function() {
                        SwalLoading('Please wait ...');
                    },
                    success: function(response) {
                        swal.close();
                        $('#locationId').val(id)  
                        $('#locationName').val(response.detail.name)  
                        $('#locationPostalCode').val(response.detail.postal_code)  
                        $('#locationAddress').val(response.detail.address)  
                        $('#selectTypeLocation').val(response.detail.office_type)
                        $('#locationTypeId').val(response.detail.office_type);
                        $('#selectTypeLocation').select2().trigger('change');
                        $('#selectProvince').val(response.detail.id_prov)
                        $('#selectProvince').select2().trigger('change');
                        $('#provinceId').val(response.detail.id_prov);
                        $('#regionId').val(response.detail.id_city);
                        $('#districtId').val(response.detail.id_district);
                        $('#villageId').val(response.detail.id_village);
                        // $('#selectProvince').append('<option value="'+response.detail.id_prov+'">'+response.detail.province_relation.name+'</option>')
                        $('#selectRegion').empty()
                        $('#selectRegion').append('<option value="'+response.detail.id_region+'">'+response.detail.region_relation.name+'</option>')
                        $('#selectDistrict').empty()
                        $('#selectDistrict').append('<option value="'+response.detail.id_city+'">'+response.detail.district_relation.name+'</option>')
                        $('#selectVillage').empty()
                        $('#selectVillage').append('<option value="'+response.detail.id_village+'">'+response.detail.village_relation.name+'</option>')
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to get data, please contact ICT Developer');
                    }
                });   
            })
            $('#btnUpdateLocation').on('click', function(){
                var data ={
                    'id':$('#locationId').val(),
                    'locationName':$('#locationName').val(),
                    'locationTypeId':$('#locationTypeId').val(),
                    'provinceId':$('#provinceId').val(),
                    'regionId':$('#regionId').val(),
                    'districtId':$('#districtId').val(),
                    'villageId':$('#villageId').val(),
                    'locationPostalCode':$('#locationPostalCode').val(),
                    'locationAddress':$('#locationAddress').val(),
                }
                saveHelper('updateMasterLocation',data,'masterLocation')
            })

         
        // Edit Master Location
    // Operation

    // Function
        // Get Data Tabel & Mapping
            // Get Data
                function getData(){
                    $.ajax({
                        url: 'getMasterLocation',
                        type: "get",
                        dataType: 'json',
                        async: true,
                        beforeSend: function() {
                            SwalLoading('Please wait ...');
                        },
                        success: function(response) {
                            swal.close();
                            mappingLocation(response.data)
                        },
                        error: function(response) {
                            swal.close();
                            toastr['error']('Failed to get data, please contact ICT Developer');
                        }
                    });   
                }
            // Get Data

            // Mapping Location
                function mappingLocation(response){
                    var data =''
                    $('#masterLocationTable').DataTable().clear();
                    $('#masterLocationTable').DataTable().destroy();
                    for(i =0; i < response.length; i++){
                        data += `
                            <tr>
                                <td>${response[i].name}</td>
                                <td>${response[i].region_relation.ibukota}</td>
                                <td style="text-align:center">
                                        <button title="Detail" class="editMasterLocation btn-sm btn btn-info rounded"data-id="${response[i]['id']}" data-toggle="modal" data-target="#editMasterLocation">
                                            <i class="fas fa-solid fa-edit"></i>
                                        </button> 
                                </td>
                            </tr>
                        `
                    }
                    $('#masterLocationTable > tbody:first').html(data);    
                    $('#masterLocationTable').DataTable({
                        scrollX     : true,
                        scrollY     :280,
                        // searching   :false
                    }).columns.adjust()
                }
            // Mapping Location

        // Get Data Tabel & Mapping
    // Function

</script>