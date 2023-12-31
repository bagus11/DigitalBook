<script>

    // Call Function
        
    // Call Function

    // Operation
        $('#isoContainer').prop('hidden', true)
        $('#divisionContainer').prop('hidden', true)
        $('#departementContainer').prop('hidden', true)
        $('#locationContainer').prop('hidden', true)
        $('#departementCheck').prop('disabled', true)
        // ISO Checkbox
            $('#isoCheck').on('change', function(){
                if(document.getElementById('isoCheck').checked){
                    $('#isoContainer').prop('hidden', false)
                    selectName('getMasterIso','selectIso','ISO')
                    $('#isoId').val('')
                }
                else{
                    $('#isoContainer').prop('hidden', true)
                    $('#selectIso').empty()
                    $('#isoId').val('')
                }   
            })
            onChange('selectIso','isoId')
        // ISO Checkbox

        // Division Checkbox && On Change
            $('#divisionCheck').on('change', function(){
                if(document.getElementById('divisionCheck').checked){
                    $('#departementCheck').prop('disabled', false)
                    $('#divisionContainer').prop('hidden',false)
                    selectName('getMasterDivision','selectDivision','Division')
                    $('#divisionId').val('')
                }else{
                    $('#divisionContainer').prop('hidden',true)
                    $('#departementCheck').prop('disabled', true)
                    $('#selectDivision').empty()
                    $('#divisionId').val('')
                }
            })
            $('#selectDivision').on('change', function(){
                var selectDivision = $('#selectDivision').val()
                if(document.getElementById('departementCheck').checked){
                    var data ={
                        'id':selectDivision
                    }
                    selectDetailName('DepartementByDiv',data,'selectDepartement','Department')
                    $('#divisionId').val(selectDivision)
                }else{
                    $('#divisionId').val(selectDivision)
                }
            })
        // Division Checkbox && On Change
        
        // Departement
            $('#departementCheck').on('change', function(){
                if(document.getElementById('departementCheck').checked){
                    $('#divisionCheck').prop('disabled', true)
                    $('#departementContainer').prop('hidden', false)
                }else{
                    $('#divisionCheck').prop('disabled', false)
                    $('#departementContainer').prop('hidden', true)
                    $('#selectDepartement').empty()
                    $('#selectDepartement').append('<option value="">Choose Division First</option>')
                    $('#departementId').val('')
                }
            })
            onChange('selectDepartement','departementId')
        // Departement

        // Location
            $('#locationCheck').on('change', function(){
        
                if(document.getElementById('locationCheck').checked){
                    $('#locationContainer').prop('hidden', false)
                    selectName('getMasterLocation','selectLocation','Location')
                }else{
                    $('#locationContainer').prop('hidden', true)
                    $('#selectLocaion').empty()
                    $('#locationId').val()
                }
                onChange('selectLocaion','locationId')
            })
        // Location
       
        $(document).on('click','li.detailCodeButton',function(e){
            e.preventDefault()
            var detailcode = $(this).data('detailcode')
            var data={'detailCode':detailcode}
            getCallback('detailDigitalBook',data,function(response){
                swal.close()
              
                $('#detailContainer').empty()
                $('#detailContainer').append(`
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        ${detailcode}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                Title 
                            </div>
                            <div class="col-4">
                                : ${response.data.title}
                            </div>

                            <div class="col-2">
                                Type  
                            </div>
                            <div class="col-4">
                                : ${response.data.type ==1 ? "PS" : "IK"}
                            </div>
                        </div>   
                               
                        <div class="row">
                            <div class="col-2">
                                Location 
                            </div>
                            <div class="col-4">
                                : ${response.data.location_relation.name}
                            </div>

                            <div class="col-2">
                                ISO  
                            </div>
                            <div class="col-4">
                                : ${response.data.iso_relation.name}
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-2">
                                Description 
                            </div>
                            <div class="col-10">
                                : ${response.data.description}
                            </div>
                        </div> 
                        <br/>
                        <div class="card collapsed-card">
                            <div class="card-header bg-secondaryClient">
                                Attachment
                                <div class="card-tools">
                                    <button type="button" class="btn btn-sm" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-2"> 
                                    <embed src="{{asset('${response.data.attachment}')}}" height="800vh" width="100%"type='application/pdf'>
                                </div> 
                            </div>
                        </div>
                      
                    </div>
                </div>
                `)
            })
        })  
    // Operation
</script>