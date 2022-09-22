$(document).ready(function () {
$('#VisitorDt').DataTable();
$('.dataTables_length').addClass('bs-select');
});


function getServiceData(){
    axios.get('/getServicesData')
    .then(function(response){
        if(response.status == 200){
            $('#mainDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');

            var jsonData = response.data;
            $.each(jsonData,function(i,item){
                $('<tr>').html(
                "<td> <img class ='table_img' src=" + jsonData[i].service_img + "></td>" +
                "<td>" + jsonData[i].service_name + "</td>" +
                "<td>" + jsonData[i].service_des + "</td>" +
                "<td> <a data-mdb-toggle='modal' data-mdb-target='#exampleModal' ><i class='fas fa-edit'></i></a> </td>" +
                "<td> <a data-mdb-toggle='modal' data-id = "+jsonData[i].id +" data-mdb-target='#deleteModal'> <i class='fas fa-trash-alt'></i> </a></td>" 
                
                ).appendTo('#service_table')
            });
        }else{
            $('#mainDiv').addClass('d-none');
            $('#loaderDiv').removeClass('d-none');
        }
    })
    .catch(function(error){
        $('#mainDiv').addClass('d-none');
        $('#loaderDiv').removeClass('d-none');
    });
}

