<script>
    // Call Function
        getData()
    // Call Function

    // Operation
        //Digital Book Header
            // Add Digital Book Header
                $('#add_digitalBook').on('click', function(){
                    $('.message_error').html('')
                    selectName('getMasterDivision','selectDivision','Division')
                    $('#selectDept').empty()
                    $('#selectDept').append('<option> Choose division first</option>')
                })
                onChange('selectDivision','dbDivisionId')
            
                $('#selectDivision').on('change', function(){
                    var data ={
                        'id':$('#selectDivision').val()
                    }
                    selectDetailName('DepartementByDiv',data,'selectDept','Departement')
                })
                onChange('selectDept','dbDeptId')
                $('#btnAddDigitalBook').on('click', function(){
                    var data={
                        'dbDeptId':$('#dbDeptId').val(),
                        'dbDivisionId':$('#dbDivisionId').val(),
                    }
                    saveHelper('addDigitalBookHeader', data,'digitalBook')
                })
            // Add Digital Book Header

            // Update Status Digital Book Header
                $('#digitalBookTable').on('click','.is_checked', function(){
                    var id = $(this).data('id')
                    updateStatus('updateStatusDigitalBookHeader',id) 
                })
            // Update Status Digital Book Header
            
            // Update DIgital Book PIC
                $('#digitalBookTable').on('click','.editPICDigitalBook', function(){
                    $('#btnDeletePic').prop('hidden', true)
                    $('#btnAddNewPIC').prop('hidden', true)
                    var detailCode = $(this).data('detail_code')
                    $('#editPICId').val(detailCode)
                    getDigitalBookPIC(detailCode)
                })
            // Update DIgital Book PIC
            
            // Add Digital Book Detail
                $('#digitalBookTable').on('click', '.addDigitalBookDetail', function(){
                    var requestCode = $(this).data('request_code')
                    $('#requestCodeDetail').val(requestCode)
                    selectName('getMasterIso','selectIso','ISO')
                    selectName('getMasterLocation','selectLocation','Location')
                })
                onChange('selectIso','dbIsoId')
                onChange('selectLocation','dbLocationId')
                onChange('selectType','dbTypeId')

                $('#btnAddDigitalBookDetail').on('click', function(e){
                    e.preventDefault();
                    var data = new FormData();
                    data.append('dbIsoId',$('#dbIsoId').val())
                    data.append('dbLocationId',$('#dbLocationId').val())
                    data.append('dbTypeId',$('#dbTypeId').val())
                    data.append('dbTitle',$('#dbTitle').val())
                    data.append('dbDescription',$('#dbDescription').val())
                    data.append('requestCode',$('#requestCodeDetail').val())
                    data.append('dbAttachment',$('#dbAttachment')[0].files[0]);

                    postAttachment('addDigitalBookDetail',data,false,function(response){
                        swal.close()
                        $('#addDigitalBookDetail').modal('hide')
                        $('.message_error').html('')
                        toastr['success'](response.meta.message);
                        
                    })
                })
            // Add Digital Book Detail

        //Digital Book Header 

        // Digital Book Detail Queue
            $('#digitalBookTable').on('click','.editQueueDigitalBook', function(){
                var requestCode = $(this).data('request_code')
                $('#sortId').val(requestCode)
                var data ={
                    'requestCode'   :requestCode,
                    'locationId'    :99
                }
                selectName('getMasterLocation','sortSelectLocation','Location')
                getCallback('getDigitalBookDetail',data,function(response){
                    swal.close()
                    mappingSort(response)
                })
            })
            $('#sortSelectLocation').on('change', function(){
                var data={
                    'requestCode':$('#sortId').val(),
                    'locationId' :$('#sortSelectLocation').val()
                }
                getCallback('getDigitalBookDetail',data,function(response){
                    swal.close()
                    mappingSort(response)
                })
            })
            $('#digitalBookSortTable').on('change','.sortIndex',function(){
                var detailCode  = $(this).data('detail_code');
                var index       = $(this).val()
                var data ={
                    'detailCode':detailCode,
                    'index'     :index
                }
                var dataMapping ={
                    'requestCode':$('#sortId').val(),
                    'locationId' :$('#sortSelectLocation').val()
                }
               
                postCallback('updateIndexDigitalBook',data,function(response){
                   
                    if(response.status == 200){
                        toastr['success'](response.message);
                        getCallback('getDigitalBookDetail',dataMapping,function(response){
                            swal.close()
                            mappingSort(response)
                        })
                    }else{
                        swal.close
                        toastr['error'](response.message);
                    }
                    
                })

            })
        // Digital Book Detail Queue

        // Digital Book Details
            //Update Digital Book Detail  
                $(document).on("click", ".editDigitalBookDetail", function(){
                    $('#detailCodeLabel').html('')
                    var detailCode = $(this).data('detail_code')
                    var data={
                        'detailCode':detailCode
                    }
                    getCallback('detailDigitalBook',data, function(response){
                        swal.close()
                        
                        $('#detailCodeLabel').html('Detail Code : '+ response.data.detailCode)
                        $('#dbdDetailCode').val(response.data.detailCode)
                        $('#dbdTitle').val(response.data.title)
                        $('#dbdTypeId').val(response.data.type)
                        $('#dbdSelectType').val(response.data.type)
                        $('#dbdSelectType').select2().trigger('change');
                        $('#dbdIsoName').val(response.data.iso_relation.name)
                        $('#dbdLocationName').val(response.data.location_relation.name)
                        $('#dbdDescription').val(response.data.description)
                    })
                })
                onChange('dbdSelectType','dbdTypeId')
                $('#btnUpdateDigitalBookDetail').on('click', function(e){
                    e.preventDefault();
                    var data = new FormData();
                    
                    data.append('detailCode',$('#dbdDetailCode').val())
                    data.append('dbdTitle',$('#dbdTitle').val())
                    data.append('dbdTypeId',$('#dbdTypeId').val())
                    data.append('dbdDescription',$('#dbdDescription').val())
                    data.append('dbdAttachment',$('#dbdAttachment')[0].files[0]);

                    postAttachment('updateDigitalBookDetail',data,false,function(response){
                        swal.close()
                        $('#editDigitalBookDetail').modal('hide')
                        $('.message_error').html('')
                        toastr['success'](response.meta.message);
                    })

                })
            //Update Digital Book Detail  
            
            // History
                $(document).on("click", ".digitalBookDetailLog", function(){
                    var detailCode =$(this).data('detail_code')
                    $('#labelDigitalBookDetailLog').html('Detail Code : '+detailCode)
                    var data ={
                        'detailCode':detailCode
                    }
                    getCallback('getDigitalBookLog',data,function(response){
                        var fileName = response.detail.attachment.split('/')
                       
                        swal.close()
                        $('#dbdDetailCodeLb').html(' : '+ response.detail.detailCode)
                        $('#dbdLocationLb').html(' : '+ response.detail.location_relation.name)
                        $('#dbdTitleLb').html(' : '+ response.detail.title)
                        $('#dbdDescriptionLb').html(' : '+ response.detail.description)
                        $('#dbdIsoLb').html(' : '+ response.detail.iso_relation.name)
                        $('#dbdTypeLb').html( response.detail.type == 1 ? ': PS' : ': IK')
                        $('#dbdAttachmentLb').html(` : 
                            <a target="_blank" href="{{URL::asset('${response.detail.attachment}')}}" class="ml-3" style="color:blue;">
                            <i class="far fa-file" style="color: red;font-size: 20px;"></i>
                            ${fileName[2]}</a>
                        `)

                        mappingLog(response.data)
                    })
                })
            // History
        // Digital Book Details
        
    // Operation

    // Function
        // Get Data && Mapping Table
            function getData(){
                $.ajax({
                    url: 'getDigitalBook',
                    type: "get",
                    dataType: 'json',
                    async: true,
                    beforeSend: function() {
                        SwalLoading('Please wait ...');
                    },
                    success: function(response) {
                        swal.close();
                       mappingDigitalBook(response.data)
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to get data, please contact ICT Developer');
                    }
                });   
            }
            function mappingDigitalBook(response){
                var data=''
                $('#digitalBookTable').DataTable().clear();
                $('#digitalBookTable').DataTable().destroy();
                for(i =0; i < response.length; i++){
                    data += `
                        <tr>
                            <td class='details-control'></td>
                            <td style="text-align:center"><input type="checkbox" class="is_checked" ${response[i].flg_active == 1 ?'checked':''} data-id="${response[i].id}"></td>
                            <td style="text-align:center">${response[i].flg_active == 1 ?'active':'inactive'}</td>
                            <td class="request_code" style="text-align:center">${response[i].requestCode}</td>
                            <td>${response[i].departement_relation.division_relation.name}</td>
                            <td>${response[i].departement_relation.name}</td>
                            <td style="text-align:center">
                               
                                @can('addDetail-digitalBook')
                                    <button title="Add Digital Book Detail" class="addDigitalBookDetail btn-sm btn btn-success rounded" data-request_code="${response[i]['requestCode']}" data-toggle="modal" data-target="#addDigitalBookDetail">
                                        <i class="fa-solid fa-plus"></i>
                                    </button> 
                                @endcan
                                @can('editOrder-digitalBook')
                                    <button title="Edit Digital Book Queue" class="editQueueDigitalBook btn-sm btn bg-mainCore rounded" data-request_code="${response[i]['requestCode']}" data-toggle="modal" data-target="#editQueueDigitalBook">
                                        <i class="fa-solid fa-list"></i>
                                    </button> 
                                @endcan
                            </td>
                        </tr>
                    `
                }
                $('#digitalBookTable > tbody:first').html(data);    

                var table = $('#digitalBookTable').DataTable({
                                scrollX     : true,
                                scrollY     :280,
                            }).columns.adjust()

                // Extend Digital Book Detail
                    $('#digitalBookTable tbody').off().on('click', 'td.details-control', function (e) {
                            var tr = $(this).closest("tr");
                            var row =   table.row( tr );
                            if ( row.child.isShown() ) {
                                row.child.hide();
                                tr.removeClass( 'shown' );
                            }
                            else {
                                digitalBookDetail($(this).parents("tr").find('td.request_code').text(),row.child) ;
                                tr.addClass( 'shown' );
                            }
                        } );  
                // Extend Digital Book Detail
            }
        // Get Data && Mapping Table

        // Digital Book Detail
            // Get Data && Mapping 
                function digitalBookDetail(requestCode,callback){
                    $.ajax({
                            url: 'getDigitalBookDetail',
                            type: "get",
                            dataType: 'json',
                            data :{
                                'requestCode':requestCode
                            },
                            async: true,
                            beforeSend: function() {
                                SwalLoading('Please wait ...');
                            },
                            success: function(response) {
                                swal.close();
                                mappingDigitalBookDetail(callback,response.data)
                            },
                            error: function(response) {
                                swal.close();
                                toastr['error']('Failed to get data, please contact ICT Developer');
                            }
                        });   
                }

                function mappingDigitalBookDetail(callback, response){
                    var data = ''
                    for(i =0; i < response.length; i++){
                        data +=`
                            <tr>
                               
                                <td style="text-align:center">${response[i].iso_relation.name}</td>
                                <td style="text-align:center">${response[i].title}</td>
                                <td style="text-align:center">${response[i].detailCode}</td>
                                <td>${response[i].location_relation.name}</td>
                                <td style="text-align:center">${response[i].type == 1 ?'PS':'IK'}</td>
                                <td style="text-align:center">
                                    <button title="Detail" class="editDigitalBookDetail btn-sm btn btn-primary rounded"data-detail_code="${response[i]['detailCode']}" data-toggle="modal" data-target="#editDigitalBookDetail">
                                        <i class="fas fa-solid fa-edit"></i>
                                    </button> 
                                    @can('editPIC-digitalBook')
                                        <button title="Edit PIC" class="editPICDigitalBook btn-sm btn btn-warning rounded" data-detail_code="${response[i]['detailCode']}" data-toggle="modal" data-target="#editPICDigitalBook">
                                            <i class="fa-solid fa-user"></i>
                                        </button> 
                                        <button title="Digital Book Detail History" class="digitalBookDetailLog btn-sm btn btn-secondary rounded" data-detail_code="${response[i]['detailCode']}" data-toggle="modal" data-target="#digitalBookDetailLog">
                                            <i class="fa-solid fa-history"></i>
                                        </button> 
                                    @endcan
                                </td>
                            </tr>
                        `;
                    }
                    callback($(`
                        <table class="digitalBookDetailTable datatable-stepper" >
                            <thead>
                                <tr>
                                    <th style="text-align:center">ISO</th>
                                    <th style="text-align:center">Title</th>
                                    <th style="text-align:center">Detail Code</th>
                                    <th style="text-align:center">Location</th>
                                    <th style="text-align:center">Type</th>
                                    <th style="text-align:center">Action</th>
                                </tr>
                            </thead>
                          <tbody class="table-bordered">
                           ${data}
                          </tbody>
                        </table>
                        `)).show();
                    $('.digitalBookDetailTable').DataTable({
                        scrollX         : true,
                        lengthChange    : false
                    }).columns.adjust()
                }
        
            // Get Data && Mapping 
        // Digital Book Detail
        
        // Digital Book PIC
                // Get Digital Book PIC
                    function getDigitalBookPIC(detailCode){
                        $.ajax({
                        url: 'getPICDigitalBook',
                        type: "get",
                        dataType: 'json',
                        data:{
                            'detailCode':detailCode
                        },
                        async: true,
                        // beforeSend: function() {
                        //     SwalLoading('Please wait ...');
                        // },
                        success: function(response) {
                            swal.close();
                            mappingPICActive(response.active)
                            mappingPICInactive(response.inactive)
                        },
                        error: function(response) {
                            swal.close();
                            toastr['error']('Failed to get data, please contact ICT Developer');
                        }
                    });  
                    }
                // Get Digital Book PIC

                // PIC Active
                    // Mapping PIC Active
                        function mappingPICActive(response){
                            $('#digitalBookCurrentPICTable').DataTable().clear();
                            $('#digitalBookCurrentPICTable').DataTable().destroy();
                            var data =''
                        
                            for(i = 0; i < response.length; i++){
                                
                                data +=`
                                    <tr>
                                        <td style="text-align:center;"><input type="checkbox" class="checkedActive" value="${response[i].userId}" data-user_id="${response[i].userId}"></td>
                                        <td style="text-align:left;">${response[i].user_relation.name}</td>
                                        <td style="text-align:left;">${response[i].user_relation.title_relation != null ? response[i].user_relation.title_relation.name : '-'}</td>
                                    </tr>
                                `;
                            }
                            $('#digitalBookCurrentPICTable > tbody:first').html(data)
                            $('#digitalBookCurrentPICTable').DataTable({
                                scrollX     : true,
                                scrollY     :280,
                            }).columns.adjust()
                        }
                    // Mapping PIC Active
                    // On change for Button Delete PIC
                        $('#digitalBookCurrentPICTable').on('change', 'input[type="checkbox"]', function() {
                                let opts = $("#digitalBookCurrentPICTable input[type=checkbox]:checked").length;
                                if (opts > 0) {
                                    $('#btnDeletePic').prop('hidden', false)
                                    $(".checkedInactive").attr("disabled", true);
                                    $('#btnAddNewPIC').prop('hidden', true)
                                } else {
                                    $('#btnDeletePic').prop('hidden', true)
                                    $(".checkedInactive").attr("disabled", false);
                                    $('#btnAddNewPIC').prop('hidden', true)
                                }
                        });
                    // On change for Button Delete PIC
                    // Delete PIC
                        $('#btnDeletePic').on('click', function(){
                            var picId                       = [];
                            var lengthParsed                = 0;
                            var detailCode                  = $('#editPICId').val()
                            var digitalBookCurrentPICTable  = $('#digitalBookCurrentPICTable').dataTable();
                            var rowcollection               =  digitalBookCurrentPICTable.$("input[type=checkbox]:checked",{"page": "all"});
                            rowcollection.each(function(){
                                picId.push($(this).val());
                            });
                            lengthParsed = picId.length;
                            var data ={
                                'picId'         :picId,
                                'detailCode'   :detailCode,
                                'type'          : '1'
                            }
                            postCallback('updateDigitalBookPIC',data, function(response) {
                                swal.close();
                                if(response.status == 200){
                                    toastr['success'](response.message);
                                    getDigitalBookPIC(detailCode)
                                    $('#btnDeletePic').prop('hidden', true)
                                }else{
                                    toastr['error'](response.message);
                                }
                            })
                        })
                    // Delete PIC
                // PIC Active

                //  PIC Inactive
                    // Mapping PIC Inactive
                        function mappingPICInactive(response){
                            $('#digitalBookNewPICTable').DataTable().clear();
                            $('#digitalBookNewPICTable').DataTable().destroy();
                            var data =''
                            for(i = 0; i < response.length; i++){
                                data +=`
                                    <tr>
                                        <td style="text-align:center;"><input type="checkbox" class="checkedInactive" value="${response[i].id}" data-id="${response[i].id}"></td>
                                        <td style="text-align:left;">${response[i].name}</td>
                                        <td style="text-align:left;">${response[i].title_relation != null ? response[i].title_relation.name : '-'}</td>
                                    </tr>
                                `;
                            }
                            $('#digitalBookNewPICTable > tbody:first').html(data)
                            $('#digitalBookNewPICTable').DataTable({
                                scrollX     : true,
                                scrollY     :280,
                            }).columns.adjust()
                        }
                    // Mapping PIC Inactive
                    // On change for button Add New PIC
                        $('#digitalBookNewPICTable').on('change', 'input[type="checkbox"]', function() {
                            let opts = $("#digitalBookNewPICTable input[type=checkbox]:checked").length;
                            if (opts > 0) {
                                $('#btnDeletePic').prop('hidden', true)
                                $(".checkedActive").attr("disabled", true);
                                $('#btnAddNewPIC').prop('hidden', false)
                            } else {
                                $('#btnDeletePic').prop('hidden', true)
                                $(".checkedActive").attr("disabled", false);
                                $('#btnAddNewPIC').prop('hidden', true)
                            }
                        });
                    // On change for button Add New PIC
                    // Add New PIC
                        $('#btnAddNewPIC').on('click', function(){
                            var picId = [];
                            var lengthParsed = 0;
                            var detailCode = $('#editPICId').val()
                            var digitalBookNewPICTable = $('#digitalBookNewPICTable').dataTable();
                            var rowcollection =  digitalBookNewPICTable.$("input[type=checkbox]:checked",{"page": "all"});
                            rowcollection.each(function(){
                                picId.push($(this).val());
                            });
                            lengthParsed = picId.length;
                            var data ={
                                'picId'         :picId,
                                'detailCode'   :detailCode,
                                'type'          : '2'
                            }
                            postCallback('updateDigitalBookPIC',data, function(response) {
                                swal.close();
                                if(response.status == 200){
                                    getDigitalBookPIC(detailCode)
                                    toastr['success'](response.message);
                                    $('#btnAddNewPIC').prop('hidden', true)
                                }else{
                                    toastr['error'](response.message);
                                }
                            })
                        })
                    // Add New PIC
                //  PIC Inactive
        // Digital Book PIC

        // Queue Digital Book
            function mappingSort(response){
                var data =''
                    $('#digitalBookSortTable').DataTable().clear();
                    $('#digitalBookSortTable').DataTable().destroy();
                    var response = response.data
                        for(i =0; i < response.length; i++){
                            data +=`
                                <tr>
                                    <td style="width:10%"> <input style="text-align:center" type="number" class="form-control sortIndex" data-detail_code="${response[i].detailCode}" value="${response[i].index}"></td>
                                    <td style="text-align:center">${response[i].detailCode}</td>
                                    <td>${response[i].title}</td>
                                    <td style="text-align:center">${response[i].iso_relation.name}</td>
                                    <td>${response[i].location_relation.name}</td>
                                </tr>
                            `;
                        }
                    $('#digitalBookSortTable > tbody:first').html(data);    
                     $('#digitalBookSortTable').DataTable({
                        scrollX     : true,
                        scrollY     :280,
                    }).columns.adjust()
            }
        // Queue Digital Book

        // Mapping Log
            function mappingLog(response){
                $('#digitalBookDetailLogTable').html('');
                var data =''
                for(i = 0; i < response.length; i++){
                    const d = new Date(response[i].created_at)
                    const date = d.toISOString().split('T')[0];
                    const time = d.toTimeString().split(' ')[0];
                    var fileName = response[i].attachment.split('/')
                     var fileAttachment='';
                     if(response[i].attachment){
                         fileAttachment =`
                                   <a target="_blank" href="{{URL::asset('${response[i].attachment}')}}" class="ml-3" style="color:blue;">
                                       <i class="far fa-file" style="color: red;font-size: 20px;"></i>
                                           ${fileName[2]}
                                   </a>
                        `;
                     }
                    data += `
                        <tr>
                            <td style="width:10px !important;">${date} ${time}</td>
                            <td style="width:15px !important;">${response[i].user_relation.name}</td>
                            <td style="width:20px !important;"><p>${response[i].message}<p/></td>
                            <td style="width:10px !important;">
                              ${fileAttachment}
                            </td>
                        </tr>
                    `;
                }
                $('#digitalBookDetailLogTable').html(data)
            }
        // Mapping Log
    // Function
</script>