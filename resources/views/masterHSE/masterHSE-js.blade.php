<script>
    // Call Function
    getData()
    // Call Function

    // Operation
        $('#masterHSETable').on('click','.btnAddSubmenus', function(){
            var id = $(this).data('id')
            var name = $(this).data('name')
            var data = {
                'id' : id
            } 
            $('#idHSE').val(id)
            $('#submenusLabel').html('Setting '+ name +' Page')
            getCallback('getClientMenus',data, function(response){
                swal.close()
                if(response.data){
                    $('#optionHSE').val('2')
                    $('#titleHSE').val(response.data.title)
                    $('#descriptionHSE').summernote('code',response.data.description);

                }else{
                    $('#optionHSE').val('1')
                    $('#titleHSE').val('')
                    $('#attachmentHSE').val('')
                    $('#descriptionHSE').summernote('reset');
                }
            })
        })

        $(document).ready(function(){
            $('#descriptionHSE').summernote({
                tabsize: 2,
                height: '370px',
                toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        })
        // Add 
        $('#addPageHSE').on('click', function(e){
            e.preventDefault()
            var data = new FormData();
            data.append('idParentMenus',$('#idHSE').val())
            data.append('optionHSE',$('#optionHSE').val())
            data.append('titleHSE',$('#titleHSE').val())
            data.append('clientMenusId',$('#clientMenusId').val())
            data.append('descriptionHSE',$('#descriptionHSE').val())
            data.append('attachmentHSE',$('#attachmentHSE')[0].files[0]);
            data.append('coverAttachmentHSE',$('#coverAttachmentHSE')[0].files[0]);
            postAttachment('addHSEPage',data,false,function(response){
                swal.close()
                toastr['success'](response.meta.message);
                window.location = 'masterHSEPage';
            })

        })
      
        var _URL = window.URL || window.webkitURL;
        $("#coverAttachmentHSE").change(function(e) {
            var file, img;
            $('.coverAttachmentHSE_error').html('')
            if ((file = this.files[0])) {
                img = new Image();
                img.onload = function() {
                    var ratio = this.width / this.height;
                    console.log(ratio)
                    if (ratio.toFixed(1) == 3.2 || ratio.toFixed(1) == 3.1 || ratio.toFixed(1) == 3.0 ||ratio.toFixed(1) == 1.4 || ratio.toFixed(1) == 1.5|| ratio.toFixed(1) == 3.3) {
                        $('#addPageHSE').prop('disabled', false);
                        $('.coverAttachmentHSE_error').html('');
                    } else {
                        alert('test 2')
                        $('.coverAttachmentHSE_error').html('Image ratio must 3:1');
                        $('#addPageHSE').prop('disabled', true);
                    }

                };
                img.onerror = function() {
                    alert("not a valid file: " + file.type);
                };
                img.src = _URL.createObjectURL(file);
            }
        });
    // Operation

    // Function
        function getData(){
            $.ajax({
                    url: 'getMasterHSE',
                    type: "get",
                    dataType: 'json',
                    async: true,
                    beforeSend: function() {
                        SwalLoading('Please wait ...');
                    },
                    success: function(response) {
                        swal.close();
                       mappingMasterHSE(response.data)
                    },
                    error: function(response) {
                        swal.close();
                        toastr['error']('Failed to get data, please contact ICT Developer');
                    }
                });   
        }
        function mappingMasterHSE(response){
            var data =''
            $('#masterHSETable').DataTable().clear();
            $('#masterHSETable').DataTable().destroy();
            for(i = 0; i< response.length; i++){
                data +=`
                    <tr>
                        <td style="width:10%" class='details-control'></td>
                        <td style="width:90%" class="menus">${response[i].name}</td>
                    </tr>
                `;
            }
            $('#masterHSETable > tbody:first').html(data);    
            var table = $('#masterHSETable').DataTable({
                            scrollX  : true,
                            scrollY: true,
                            scrollCollapse : true,
                            autoWidth:true
                        }).columns.adjust()    
                        $('#masterHSETable tbody').off().on('click', 'td.details-control', function (e) {
                        var tr = $(this).closest("tr");
                        var row =   table.row( tr );
                        if ( row.child.isShown() ) {
                            // This row is already open - close it
                            row.child.hide();
                            tr.removeClass( 'shown' );
                        }
                        else {
                            // Open this row
                            detail_log(row.child,$(this).parents("tr").find('td.menus').text()) ;
                            tr.addClass( 'shown' );
                        }
                    } );  
        }
        function detail_log( callback, menus){
       
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('getClientSubmenus')}}",
                type: "get",
                dataType: 'json',
                data: {
                    'menus': menus
                },
                success : function(response) {
                    if(response){
                        let row = '';
                        var revision = 0;
                        for(let i = 0; i < response.data.length; i++){
                        var isi_survey =``;
                        var report_survey =``;
                        var akeses =``;
                            $(document).ready(function() 
                            {
                                $('.table_detail').DataTable
                                ({
                                    "destroy": true,
                                    "autoWidth" : false,
                                    "searching": false,
                                    "aaSorting" : false,
                                    "paging":   false,
                                    "scrollX":true
                                }).columns.adjust()    
                            });
                            $('.table_detail tbody').append(``);
                                row+= `<tr class="table-light">
                                            <td style="text-align:center">${i + 1}</td>
                                            <td style="text-align:left">${response.data[i].name}</td>
                                            <td style="text-align:left">
                                                <button class="btn btn-sm btn-info btnAddSubmenus" data-name ="${response.data[i].name}" data-id="${response.data[i].id}"  data-toggle="modal" data-target="#addSubmenusModal">
                                                    <i class="fas fa-edit"></i>    
                                                </button>        
                                            </td>
                                        </tr>`;
                        }
                        callback($(`
                            <table class="table_detail datatable-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align:center">No</th>
                                    <th style="text-align:center">Menus Page</th>
                                    <th style="text-align:center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered">${row}</tbody>
                        </table>`)).show();
                        
                    }else{
                        toastr["error"]('Data tidak ada')
                        $('#loading').hide();
                    }
                },
                error : function(response) {
                    alert('Gagal Get Data, Tidak Ada Data / Mohon Coba Kembali Beberapa Saat Lagi');
                    $('#loading').hide();
                }
            });
        }
    // Function
</script>