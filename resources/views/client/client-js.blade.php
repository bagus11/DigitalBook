<script>

    // Call Function
        getCallback('getDitialBookClient','',function(response){
            swal.close()
            $('#contentContainer').empty()
            var data =''
            var departmentName=''  
            var detailBook =''         
            if(response.data){
                for(i = 0 ;i < response.data.length; i++){
                    var digital_relation =response.data[i].digital_relation 
                    if(digital_relation.length > 0){ 
                        // Departement Relation
                        var departmentRelation = response.data[i].departement_relation
                        for(j = 0 ; j < departmentRelation.length; j++){
                            // Digital Header
                                var digitalHeader = departmentRelation[j].digital_relation
                                if(digitalHeader.length > 0){
                                    for(k = 0; k < digitalHeader.length; k++){
                                        // Detail Digital
                                            var detailName = digitalHeader[k].detail_relation
                                            if(detailName.length > 0){
                                                for(l = 0 ; l < detailName.length; l++){
                                                    var detailLabel = detailName[l].detailCode
                                                    detailBook +=`
                                                        <li class="nav-item" style="width:100%">
                                                            <a href="" class="nav-link ml-5">
                                                                <p>${detailLabel}</p>
                                                            </a>
                                                        </li>
                                                   `;
                                                }
    
                                            }
                                        // Detail Digital
                                    }
                                }else{
                                    alert('test')
                                    detailBook.empty()
                                }
                            // Digital Header

                            departmentName +=`
                                            <li class="nav-item" style="width:100%" >
                                                <a href="#" class="nav-link ml-3">
                                                    <p>${departmentRelation[j].name}<i class="right fas fa-angle-left"></i></p>
                                                </a>
                                                <ul class="nav nav-treeview">
                                                    ${detailBook}
                                                </ul>
                                            </li>
                            `;
                        }   
                        // Departement Relation   
                        data +=`
                                <li class="nav-item menu-is-opening menu-open">
                                    <a href="#" class="nav-link ">
                                        <p>${response.data[i].name}<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview" style="display: block;">
                                        ${departmentName}
                                    </ul>
                                </li>   
                        `;
                    }
                }
            }
            $('#contentContainer').html(data)
        })
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
    // Operation

    // Function
    // Function

</script>