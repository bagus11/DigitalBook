<script>
     var canvas = document.querySelector("canvas");
    var signaturePad = new SignaturePad(canvas);

    $("#clear").on("click", function () {
        signaturePad.clear();
    });
    getCallback('getUser',null, function(response){
        swal.close()
        mappingTable(response.data)
    })

    // Function
        function mappingTable(response){
            var data=''
                $('#signature_table').DataTable().clear();
                $('#signature_table').DataTable().destroy();
                for(i =0; i < response.length; i++){
                    data += `
                        <tr>
                            <td>${response[i].name}</td>
                            <td>${response[i].nik}</td>
                            <td style="text-align:center">
                                @can('create-masterSignature')
                                    <button title="update signature" class="edit btn-sm btn btn-warning rounded"data-id="${response[i]['id']}" data-toggle="modal" data-target="#editSignatureModal">
                                        <i class="fa-solid fa-signature"></i>
                                    </button> 
                                @endcan
                            </td>
                        </tr>
                    `
                }
                $('#signature_table > tbody:first').html(data);    
                $('#signature_table').DataTable({
                    scrollX     : true,
                    scrollY     :280,
                    // searching   :false
                }).columns.adjust()
        }
    // Function
</script>