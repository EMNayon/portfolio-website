const { toSafeInteger } = require("lodash");




function getCoursesData() {
    axios
        .get("/getCoursesData")
        .then(function (response) {
            if (response.status == 200) {
                $("#mainDivCourse").removeClass("d-none");
                $("#loaderDivCourses").addClass("d-none");

                $('#course_data_table').DataTable().destroy();
                $("#courses_table").empty();

                var jsonData = response.data;
                $.each(jsonData, function (i, item) {
                    $("<tr>")
                        .html(
                                "<td>" +
                                jsonData[i].course_name +
                                "</td>" +
                                "<td>" +
                                jsonData[i].course_fee +
                                "</td>" +
                                "<td>" +
                                jsonData[i].course_totalclass +
                                "</td>" +
                                "<td>" +
                                jsonData[i].course_totlenroll +
                                "</td>" +
                                "<td> <a class = 'courseDetailsBtn' data-id = " +
                                jsonData[i].id +
                                "  ><i class='fas fa-eye'></i></a> </td>" +
                                "<td> <a class = 'courseEditBtn' data-id = " +
                                jsonData[i].id +
                                "  ><i class='fas fa-edit'></i></a> </td>" +
                                // "<td> <a data-mdb-toggle='modal' data-id = "+jsonData[i].id +" data-mdb-target='#deleteModal'> <i class='fas fa-trash-alt'></i> </a></td>"
                                "<td> <a class='courseDeleteBtn' data-id = " +
                                jsonData[i].id +
                                " > <i class='fas fa-trash-alt'></i> </a></td>"
                        )
                        .appendTo("#courses_table");
                });

                // services table delete icon click
                $(".courseDeleteBtn").click(function () {
                    var id = $(this).data("id");
                    $("#courseDeleteId").html(id);
                    // $('#serviceDeleteConfirmBtn').attr('data-id',id);
                    $("#deleteCourseModal").modal("show");
                });
                // service delete modal yes button
                $("#courseDeleteConfirmBtn").click(function () {
                    // var id = $(this).data('id');
                    var id = $("#courseDeleteId").html();
                    console.log(id);
                    courseDelete(id);
                });

                // services table edit icon click
                $(".courseEditBtn").click(function () {
                    var id = $(this).data("id");
                    $("#courseEditId").html(id);
                    courseUpdateDetails(id);
                    $("#editCourseModal").modal("show");
                });
                // service edit modal save button
                $("#CourseEditConfirmBtn").click(function () {
                    // var id = $(this).data('id');
                    var id = $("#courseEditId").html();
                    var name = $("#CourseNameAddId").val();
                    var des = $("#CourseDesAddId").val();
                    var fee = $("#CourseFeeAddId").val();
                    var enroll = $("#CourseEnrollAddId").val();
                    var classes = $("#CourseClassAddId").val();
                    var link = $("#CourseLinkAddId").val();
                    var img = $("#CourseImgAddId").val();
                    courseUpdated(id, name, des,fee,enroll,classes,link, img);
                });

                // course add new btn click
                $('#addNewCourse').click(function(){
                    $('#addCourseModal').modal('show');
                });

                 // couse add modal add new button
                 $("#CourseAddConfirmBtn").click(function () {
                    // var id = $(this).data('id');
                    var name = $("#CourseNameId").val();
                    var des = $("#CourseDesId").val();
                    var fee = $("#CourseFeeId").val();
                    var enroll = $("#CourseEnrollId").val();
                    var classes = $("#CourseClassId").val();
                    var link = $("#CourseLinkId").val();
                    var img = $("#CourseImgId").val();
                    courseAdd(name, des,fee,enroll,classes,link, img);
                });

                $('#course_data_table').DataTable();
                $(".dataTables_length").addClass("bs-select");
                
            } else {
                $("#loaderDivCourses").addClass("d-none");
                $("#wrongDivCourses").removeClass("d-none");
            }
        })
        .catch(function (error) {
            $("#loaderDivCourses").addClass("d-none");
            $("#wrongDivCourses").removeClass("d-none");
        });
}

// course add method
function courseAdd(cousreName, cousreDes,cousreFee,cousreEnroll,cousreClass,cousreLink, cousreImg) {
    if (cousreName.length == 0) {
        alert("Service Name is Empty!");
    } else if (cousreDes.length == 0) {
        alert("Service Image is Empty!");
    } else if (cousreFee.length == 0) {
        alert("Service Image is Empty!");
    }else if (cousreEnroll.length == 0) {
        alert("Service Image is Empty!");
    } else if (cousreClass.length == 0) {
        alert("Service Image is Empty!");
    }else if (cousreLink.length == 0) {
        alert("Service Image is Empty!");
    }else if (cousreImg.length == 0) {
        alert("Service Image is Empty!");
    }  
    else {
        $("#CourseAddConfirmBtn").html("<div class='spinner-border spinner-border-sm' role='status'></div>")
        axios
            .post("/courseAdd", {
                course_name: cousreName,
                course_des: cousreDes,
                course_fee: cousreFee,
                course_totlenroll: cousreEnroll,
                course_totalclass: cousreClass,
                course_link: cousreLink,
                course_img: cousreImg,
            })
            .then(function (response) {
                $("#CourseAddConfirmBtn").html("Add New")
                if(response.status == 200){
                    if (response.data == 1) {
                        $("#addCourseModal").modal("hide");
                        // toastr.success('Delete Success');
                        getCoursesData();
                    } else {
                        $("#addCourseModal").modal("hide");
                        // toastr.error('Delete Fail');
                        getCoursesData();
                    }
                }else {
                    $("#addCourseModal").modal("hide");
                    alert("Something Went Wrong!")
                }
               
            })
            .catch(function (error) {
                $("#addCourseModal").modal("hide");
                alert("Something Went Wrong!")
            });
    }
}

//each  course details
function courseUpdateDetails(detailsId) {
    axios
        .post("/courseDetails", { id: detailsId })
        .then(function (response) {
            if (response.status == 200) {
                // console.log(response);
                $("#courseEditForm").removeClass("d-none");
                $("#courseEditLoder").addClass("d-none");
                $('#courseEditWrong').addClass('d-none');
                var jsonData = response.data;
                console.log(jsonData[0].course_des);
                $("#CourseNameAddId").val(jsonData[0].course_name);
                $("#CourseDesAddId").val(jsonData[0].course_des);
                $("#CourseFeeAddId").val(jsonData[0].course_fee);
                $("#CourseEnrollAddId").val(jsonData[0].course_totlenroll);
                $("#CourseClassAddId").val(jsonData[0].course_totalclass);
                $("#CourseLinkAddId").val(jsonData[0].course_link);
                $("#CourseImgAddId").val(jsonData[0].course_img);
            } else {
                $("#courseEditLoder").addClass("d-none");
                $("#courseEditWrong").removeClass("d-none");
            }
        })
        .catch(function (error) {
            $("#courseEditLoder").addClass("d-none");
            $("#courseEditWrong").removeClass("d-none");
        });
}

//each  course update
function courseUpdated(courseId, cousreName, cousreDes,cousreFee,cousreEnroll,cousreClass,cousreLink, cousreImg) {
    if (cousreName.length == 0) {
        alert("Course Name is Empty!");
    } else if (cousreDes.length == 0) {
        alert("Course Des is Empty!");
    } else if (cousreFee.length == 0) {
        alert("Course fee is Empty!");
    } else if (cousreEnroll.length == 0) {
        alert("Course enroll is Empty!");
    } else if (cousreClass.length == 0) {
        alert("Course class is Empty!");
    } else if (cousreLink.length == 0) {
        alert("Course link is Empty!");
    }
     else if (cousreImg.length == 0) {
        alert("Course Image is Empty!");
    } else {
        $("#CourseEditConfirmBtn").html("<div class='spinner-border spinner-border-sm' role='status'></div>")
        axios
            .post("/courseUpdate", {
                id: courseId,
                course_name: cousreName,
                course_des: cousreDes,
                course_fee: cousreFee,
                course_totlenroll: cousreEnroll,
                course_totalclass: cousreClass,
                course_link: cousreLink,
                course_img: cousreImg,
            })
            .then(function (response) {
                $("#CourseEditConfirmBtn").html("Save")
                if(response.status){
                    if (response.data == 1) {
                        $("#editCourseModal").modal("hide");
                        // toastr.success('Delete Success');
                        getCoursesData();
                    } else {
                        $("#editCourseModal").modal("hide");
                        // toastr.error('Delete Fail');
                        getCoursesData();
                    }
                }else {
                    $("#editCourseModal").modal("hide");
                    alert("Something Went Wrong!")
                }
               
            })
            .catch(function (error) {
                $("#editCourseModal").modal("hide");
                alert("Something Went Wrong!")
            });
    }
}

// course delete
function courseDelete(deleteId) {
    $("#courseDeleteConfirmBtn").html("<div class='spinner-border spinner-border-sm' role='status'></div>") // animation 
    axios.post("/courseDelete", { id: deleteId })

        .then(function (response) {
            $("#courseDeleteConfirmBtn").html("Yes")
            if(response.status == 200){
                if (response.data == 1) {
                    $("#deleteCourseModal").modal("hide");
                    // toastr.success('Delete Success');
                    getCoursesData();
                } else {
                    $("#deleteCourseModal").modal("hide");
                    // toastr.error('Delete Fail');
                    getCoursesData();
                }
            }
            else {
                $("#deleteCourseModal").modal("hide");
                alert("Something Went Wrong!")
            }
            
        })
        .catch(function (error) {
            $("#deleteCourseModal").modal("hide");
            alert("Something Went Wrong!")
        });
}


// projects start js code 
function getProjectsData() {
    axios
        .get("/getProjectsData")
        .then(function (response) {
            if (response.status == 200) {
                $("#mainProjectDiv").removeClass("d-none");
                $("#loaderDivProject").addClass("d-none");

                $('#project_data_table').DataTable().destroy();
                $("#project_table").empty();

                var jsonData = response.data;
                $.each(jsonData, function (i, item) {
                    $("<tr>")
                        .html(
                            "<td> <img class ='table-img' src=" +
                            jsonData[i].project_img +
                            "></td>" +
                                "<td>" +
                                jsonData[i].project_name +
                                "</td>" +
                                "<td>" +
                                jsonData[i].project_des +
                                "</td>" +
                               
                                
                                "<td> <a class = 'projectEditBtn' data-id = " +
                                jsonData[i].id +
                                "  ><i class='fas fa-edit'></i></a> </td>" +
                                // "<td> <a data-mdb-toggle='modal' data-id = "+jsonData[i].id +" data-mdb-target='#deleteModal'> <i class='fas fa-trash-alt'></i> </a></td>"
                                "<td> <a class='projectDeleteBtn' data-id = " +
                                jsonData[i].id +
                                " > <i class='fas fa-trash-alt'></i> </a></td>"
                        )
                        .appendTo("#project_table");
                });

                // project table delete icon click
                $(".projectDeleteBtn").click(function () {
                    var id = $(this).data("id");
                    $("#projectDeleteId").html(id);
                    // $('#serviceDeleteConfirmBtn').attr('data-id',id);
                    $("#deleteProectModal").modal("show");
                });
                // project delete modal yes button
                $("#projectDeleteConfirmBtn").click(function () {
                    // var id = $(this).data('id');
                    var id = $("#projectDeleteId").html();
                    console.log(id);
                    projectDelete(id);
                });

                // projects table edit icon click
                $(".projectEditBtn").click(function () {
                    var id = $(this).data("id");
                    $("#projectEditId").html(id);
                    projectUpdateDetails(id);
                    $("#editProjectModal").modal("show");
                });
                // project edit modal save button
                $("#projectEditConfirmBtn").click(function () {
                    // var id = $(this).data('id');
                    var id = $("#projectEditId").html();
                    var name = $("#projectNameId").val();
                    var des = $("#projectDesId").val();
                    var link = $("#projectLinkId").val();
                    var img = $("#projectImageId").val();
                    projectUpdated(id, name, des,link, img);
                });

                // project add new btn click
                $('#NewAddProject').click(function(){
                    $('#addProjectModal').modal('show');
                });

                 // project add modal add new button
                 $("#projectAddConfirmBtn").click(function () {
                    // var id = $(this).data('id');
                    var name = $("#projectNameAddId").val();
                    var des = $("#projectDesAddId").val();
                    var link = $("#projectLinkAddId").val();
                    var img = $("#projectImageAddId").val();
                    projectAdd(name, des,link, img);
                });

                $('#project_data_table').DataTable();
                $(".dataTables_length").addClass("bs-select");
                
            } else {
                $("#loaderDivCourses").addClass("d-none");
                $("#wrongDivCourses").removeClass("d-none");
            }
        })
        .catch(function (error) {
            $("#loaderDivCourses").addClass("d-none");
            $("#wrongDivCourses").removeClass("d-none");
        });
}

// project add method
function projectAdd(projectName, projectDes,projectLink, projectImg) {
    if (projectName.length == 0) {
        alert("Project Name is Empty!");
    }else if (projectDes.length == 0) {
        alert("Project Des is Empty!");
    }else if (projectLink.length == 0) {
        alert("Project Link is Empty!");
    }else if (projectImg.length == 0) {
        alert("Project Image is Empty!");
    }else {
        $("#projectAddConfirmBtn").html("<div class='spinner-border spinner-border-sm' role='status'></div>")
        axios
            .post("/projectAdd", {
                project_name: projectName,
                project_des: projectDes,
                project_link: projectLink,
                project_img: projectImg,
            })
            .then(function (response) {
                $("#projectAddConfirmBtn").html("Add New")
                if(response.status == 200){
                    if (response.data == 1) {
                        $("#addProjectModal").modal("hide");
                        // toastr.success('Delete Success');
                        getProjectsData();
                    } else {
                        $("#addProjectModal").modal("hide");
                        // toastr.error('Delete Fail');
                        getProjectsData();
                    }
                }else {
                    $("#addProjectModal").modal("hide");
                    alert("Something Went Wrong!")
                }
               
            })
            .catch(function (error) {
                $("#addProjectModal").modal("hide");
                alert("Something Went Wrong!")
            });
    }
}

//each  project details
function projectUpdateDetails(detailsId) {
    axios
        .post("/projectDetails", { id: detailsId })
        .then(function (response) {
            if (response.status == 200) {
                // console.log(response);
                $("#projectEditForm").removeClass("d-none");
                $("#projectEditLoder").addClass("d-none");
                $('#projectEditWrong').addClass('d-none');
                var jsonData = response.data;
                // console.log(jsonData[0].course_des);
                $("#projectNameId").val(jsonData[0].project_name);
                $("#projectDesId").val(jsonData[0].project_des);
                $("#projectLinkId").val(jsonData[0].project_link);
                $("#projectImageId").val(jsonData[0].project_img);
            } else {
                $("#projectEditLoder").addClass("d-none");
                $("#projectEditWrong").removeClass("d-none");
            }
        })
        .catch(function (error) {
            $("#projectEditLoder").addClass("d-none");
            $("#projectEditWrong").removeClass("d-none");
        });
}

//each  porject update
function projectUpdated(courseId, projectName, projectDes,projectLink, projectImg) {
    if (projectName.length == 0) {
        alert("Course Name is Empty!");
    } else if (projectDes.length == 0) {
        alert("Course Des is Empty!");
    } else if (projectLink.length == 0) {
        alert("Course link is Empty!");
    }
     else if (projectImg.length == 0) {
        alert("Course Image is Empty!");
    } else {
        $("#projectEditConfirmBtn").html("<div class='spinner-border spinner-border-sm' role='status'></div>")
        axios
            .post("/projectUpdate", {
                id: courseId,
                project_name:projectName,
                project_des: projectDes,
                project_link: projectLink,
                project_img: projectImg,
            })
            .then(function (response) {
                $("#projectEditConfirmBtn").html("Save")
                if(response.status){
                    if (response.data == 1) {
                        $("#editProjectModal").modal("hide");
                        // toastr.success('Delete Success');
                        getProjectsData();
                    } else {
                        $("#editProjectModal").modal("hide");
                        // toastr.error('Delete Fail');
                        getProjectsData();
                    }
                }else {
                    $("#editProjectModal").modal("hide");
                    alert("Something Went Wrong!")
                }
               
            })
            .catch(function (error) {
                $("#editProjectModal").modal("hide");
                alert("Something Went Wrong!")
            });
    }
}

// project delete
function projectDelete(deleteId) {
    $("#projectDeleteConfirmBtn").html("<div class='spinner-border spinner-border-sm' role='status'></div>") // animation 
    axios.post("/projectDelete", { id: deleteId })

        .then(function (response) {
            $("#projectDeleteConfirmBtn").html("Yes")
            if(response.status == 200){
                if (response.data == 1) {
                    $("#deleteProectModal").modal("hide");
                    // toastr.success('Delete Success');
                    getProjectsData();
                } else {
                    $("#deleteProectModal").modal("hide");
                    // toastr.error('Delete Fail');
                    getProjectsData();
                }
            }
            else {
                $("#deleteProectModal").modal("hide");
                alert("Something Went Wrong!")
            }
            
        })
        .catch(function (error) {
            $("#deleteProectModal").modal("hide");
            alert("Something Went Wrong!")
        });
}




// contact start js code 
function getContactData() {
    axios
        .get("/getContactData")
        .then(function (response) {
            if (response.status == 200) {
                $("#mainDivContact").removeClass("d-none");
                $("#loaderDivContact").addClass("d-none");

                $('#contact_data_table').DataTable().destroy();
                $("#contact_table").empty();

                var jsonData = response.data;
                $.each(jsonData, function (i, item) {
                    $("<tr>")
                        .html(
                            "<td> <img class ='table-img' src=" +
                            jsonData[i].contact_name +
                            "></td>" +
                                "<td>" +
                                jsonData[i].mobile_no +
                                "</td>" +
                                "<td>" +
                                jsonData[i].contact_email +
                                "</td>" +
                                "<td>" +
                                jsonData[i].contact_message +
                                "</td>" +
                               
                                
                               
                                // "<td> <a data-mdb-toggle='modal' data-id = "+jsonData[i].id +" data-mdb-target='#deleteModal'> <i class='fas fa-trash-alt'></i> </a></td>"
                                "<td> <a class='contactDeleteBtn' data-id = " +
                                jsonData[i].id +
                                " > <i class='fas fa-trash-alt'></i> </a></td>"
                        )
                        .appendTo("#contact_table");
                });

                // project table delete icon click
                $(".contactDeleteBtn").click(function () {
                    var id = $(this).data("id");
                    $("#contactDeleteId").html(id);
                    // $('#serviceDeleteConfirmBtn').attr('data-id',id);
                    $("#deleteContactModal").modal("show");
                });
                // project delete modal yes button
                $("#contactDeleteConfirmBtn").click(function () {
                    // var id = $(this).data('id');
                    var id = $("#contactDeleteId").html();
                    console.log(id);
                    contactDelete(id);
                });

                $('#contact_data_table').DataTable();
                $(".dataTables_length").addClass("bs-select");
                
            } else {
                $("#loaderDivContact").addClass("d-none");
                $("#wrongDivContact").removeClass("d-none");
            }
        })
        .catch(function (error) {
            $("#loaderDivContact").addClass("d-none");
            $("#wrongDivContact").removeClass("d-none");
        });
}

// contact delete
function contactDelete(deleteId) {
    $("#contactDeleteConfirmBtn").html("<div class='spinner-border spinner-border-sm' role='status'></div>") // animation 
    axios.post("/contactDelete", { id: deleteId })

        .then(function (response) {
            $("#contactDeleteConfirmBtn").html("Yes")
            if(response.status == 200){
                if (response.data == 1) {
                    $("#deleteContactModal").modal("hide");
                    // toastr.success('Delete Success');
                    getContactData();
                } else {
                    $("#deleteContactModal").modal("hide");
                    // toastr.error('Delete Fail');
                    getContactData();
                }
            }
            else {
                $("#deleteContactModal").modal("hide");
                alert("Something Went Wrong!")
            }
            
        })
        .catch(function (error) {
            $("#deleteContactModal").modal("hide");
            alert("Something Went Wrong!")
        });
}

