const { toSafeInteger } = require("lodash");

// visitor page table
$(document).ready(function () {
    $("#VisitorDt").DataTable();
    $(".dataTables_length").addClass("bs-select");
});

// service data table
function getServiceData() {
    axios
        .get("/getServicesData")
        .then(function (response) {
            if (response.status == 200) {
                $("#mainDiv").removeClass("d-none");
                $("#loaderDiv").addClass("d-none");

                $("#service_table").empty();

                var jsonData = response.data;
                $.each(jsonData, function (i, item) {
                    $("<tr>")
                        .html(
                            "<td> <img class ='table-img' src=" +
                                jsonData[i].service_img +
                                "></td>" +
                                "<td>" +
                                jsonData[i].service_name +
                                "</td>" +
                                "<td>" +
                                jsonData[i].service_des +
                                "</td>" +
                                "<td> <a class = 'serviceEditBtn' data-id = " +
                                jsonData[i].id +
                                "  ><i class='fas fa-edit'></i></a> </td>" +
                                // "<td> <a data-mdb-toggle='modal' data-id = "+jsonData[i].id +" data-mdb-target='#deleteModal'> <i class='fas fa-trash-alt'></i> </a></td>"
                                "<td> <a class='serviceDeleteBtn' data-id = " +
                                jsonData[i].id +
                                " > <i class='fas fa-trash-alt'></i> </a></td>"
                        )
                        .appendTo("#service_table");
                });

                // services table delete icon click
                $(".serviceDeleteBtn").click(function () {
                    var id = $(this).data("id");
                    $("#serviceDeleteId").html(id);
                    // $('#serviceDeleteConfirmBtn').attr('data-id',id);
                    $("#deleteModal").modal("show");
                });
                // service delete modal yes button
                $("#serviceDeleteConfirmBtn").click(function () {
                    // var id = $(this).data('id');
                    var id = $("#serviceDeleteId").html();
                    console.log(id);
                    serviceDelete(id);
                });

                // services table edit icon click
                $(".serviceEditBtn").click(function () {
                    var id = $(this).data("id");
                    $("#serviceEditId").html(id);
                    serviceUpdateDetails(id);
                    $("#editModal").modal("show");
                });
                // service edit modal save button
                $("#serviceEditConfirmBtn").click(function () {
                    // var id = $(this).data('id');
                    var id = $("#serviceEditId").html();
                    var name = $("#serviceNameId").val();
                    var des = $("#serviceDesId").val();
                    var img = $("#serviceImageId").val();
                    serviceUpdated(id, name, des, img);
                });

                // service add new btn click
                $('#something').click(function(){
                   $("#addModal").modal("show");
                });

                 // service add modal add new button
                 $("#serviceAddConfirmBtn").click(function () {
                    // var id = $(this).data('id');
                    var name = $("#serviceNameAddId").val();
                    var des = $("#serviceDesAddId").val();
                    var img = $("#serviceImageAddId").val();
                    serviceAdd(name, des, img);
                });
            } else {
                $("#loaderDiv").addClass("d-none");
                $("#wrongDiv").removeClass("d-none");
            }
        })
        .catch(function (error) {
            $("#loaderDiv").addClass("d-none");
            $("#wrongDiv").removeClass("d-none");
        });
}

// service delete
function serviceDelete(deleteId) {
    $("#serviceDeleteConfirmBtn").html("<div class='spinner-border spinner-border-sm' role='status'></div>") // animation 
    axios.post("/serviceDelete", { id: deleteId })

        .then(function (response) {
            $("#serviceEditConfirmBtn").html("Yes")
            if(response.status == 200){
                if (response.data == 1) {
                    $("#deleteModal").modal("hide");
                    // toastr.success('Delete Success');
                    getServiceData();
                } else {
                    $("#deleteModal").modal("hide");
                    // toastr.error('Delete Fail');
                    getServiceData();
                }
            }
            else {
                $("#deleteModal").modal("hide");
                alert("Something Went Wrong!")
            }
            
        })
        .catch(function (error) {
            $("#deleteModal").modal("hide");
            alert("Something Went Wrong!")
        });
}

//each  service details
function serviceUpdateDetails(detailsId) {
    axios
        .post("/serviceDetails", { id: detailsId })
        .then(function (response) {
            if (response.status == 200) {
                $("#serviceEditForm").removeClass("d-none");
                $("#serviceEditLoder").addClass("d-none");
                // $('#serviceEditWrong').addClass('d-none');
                var jsonData = response.data;
                $("#serviceNameId").val(jsonData[0].service_name);
                $("#serviceDesId").val(jsonData[0].service_des);
                $("#serviceImageId").val(jsonData[0].service_img);
            } else {
                $("#serviceEditLoder").addClass("d-none");
                $("#serviceEditWrong").removeClass("d-none");
            }
        })
        .catch(function (error) {
            $("#serviceEditLoder").addClass("d-none");
            $("#serviceEditWrong").removeClass("d-none");
        });
}

//each  service update
function serviceUpdated(serviceId, serviceName, serviceDes, serviceImg) {
    if (serviceName.length == 0) {
        alert("Service Name is Empty!");
    } else if (serviceDes.length == 0) {
        alert("Service Image is Empty!");
    } else if (serviceImg.length == 0) {
        alert("Service Image is Empty!");
    } else {
        $("#serviceEditConfirmBtn").html("<div class='spinner-border spinner-border-sm' role='status'></div>")
        axios
            .post("/serviceUpdate", {
                id: serviceId,
                name: serviceName,
                des: serviceDes,
                img: serviceImg,
            })
            .then(function (response) {
                $("#serviceEditConfirmBtn").html("Save")
                if(response.status){
                    if (response.data == 1) {
                        $("#editModal").modal("hide");
                        // toastr.success('Delete Success');
                        getServiceData();
                    } else {
                        $("#editModal").modal("hide");
                        // toastr.error('Delete Fail');
                        getServiceData();
                    }
                }else {
                    $("#editModal").modal("hide");
                    alert("Something Went Wrong!")
                }
               
            })
            .catch(function (error) {
                $("#editModal").modal("hide");
                alert("Something Went Wrong!")
            });
    }
}

// service add method
function serviceAdd(serviceName, serviceDes, serviceImg) {
    if (serviceName.length == 0) {
        alert("Service Name is Empty!");
    } else if (serviceDes.length == 0) {
        alert("Service Image is Empty!");
    } else if (serviceImg.length == 0) {
        alert("Service Image is Empty!");
    } else {
        $("#serviceAddConfirmBtn").html("<div class='spinner-border spinner-border-sm' role='status'></div>")
        axios
            .post("/serviceAdd", {
                name: serviceName,
                des: serviceDes,
                img: serviceImg,
            })
            .then(function (response) {
                $("#serviceAddConfirmBtn").html("Add New")
                if(response.status){
                    if (response.data == 1) {
                        $("#addModal").modal("hide");
                        // toastr.success('Delete Success');
                        getServiceData();
                    } else {
                        $("#addModal").modal("hide");
                        // toastr.error('Delete Fail');
                        getServiceData();
                    }
                }else {
                    $("#addModal").modal("hide");
                    alert("Something Went Wrong!")
                }
               
            })
            .catch(function (error) {
                $("#addModal").modal("hide");
                alert("Something Went Wrong!")
            });
    }
}




