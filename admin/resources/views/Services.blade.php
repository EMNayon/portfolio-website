@extends('Layout.app')
@section('content')
    <div id="mainDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
              <button id="something" class="btn btn-sm btn-danger my-3" >Add New</button>
                <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Image</th>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Description</th>
                            <th class="th-sm">Edit</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="service_table">

                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <div id="loaderDiv" class="container ">
        <div class="row">
            <div class="col-md-12 text-center p-5 m-5">
                <img src="{{ asset('images/loadder.gif') }}" alt="">
            </div>
        </div>
    </div>

    <div id="wrongDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h1>Something Went Wrong !</h1>
            </div>
        </div>
    </div>
@endsection

<!-- modal for delete -->
<div class="modal top fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
    data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-body text-center p-3">
                <h4 class="mt-4">Do You Want Delete?</h4>
                <h5 id="serviceDeleteId" class="mt-4"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
                    No
                </button>
                <button data-id="" id="serviceDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>

{{-- modal for edit --}}

<div class="modal top fade" id="editModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
    data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-body text-center p-3">

                <h5 id="serviceEditId" class="mt-4"></h5>
                <img id="serviceEditLoder" class="m-5" src="{{ asset('images/loadder.gif') }}" alt="">
                <h5 id="serviceEditWrong" class="d-none">Something Went Wrong !</h5>
                <div id="serviceEditForm" class="d-none">
                    <div class="form-outline mb-4">
                        <input type="name" id="serviceNameId" class="form-control" />
                        <label class="form-label" for="form4Example2">Service Name</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input class="form-control" id="serviceDesId" rows="4" />
                        <label class="form-label" for="form4Example3">Service Description</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="serviceImageId" class="form-control" />
                        <label class="form-label" for="form4Example1">Image Link</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
                    Cancel
                </button>
                <button data-id="" id="serviceEditConfirmBtn" type="button" class="btn btn-danger">Save</button>
            </div>
        </div>
    </div>
</div>

{{-- modal for add --}}

<div class="modal top fade" id="addModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
    data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-body text-center p-3">
                <div id="serviceAddForm" class="">
                  <h6 class="mb-2">Add New Service</h6>
                    <div class="form-outline mb-4">
                        <input type="name" id="serviceNameAddId" class="form-control" />
                        <label class="form-label" for="form4Example2">Service Name</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input class="form-control" id="serviceDesAddId" rows="4" />
                        <label class="form-label" for="form4Example3">Service Description</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="serviceImageAddId" class="form-control" />
                        <label class="form-label" for="form4Example1">Image Link</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
                    Cancel
                </button>
                <button data-id="" id="serviceAddConfirmBtn" type="button" class="btn btn-danger">Add New</button>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script type="text/javascript">
        getServiceData();

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

    </script>
@endsection
