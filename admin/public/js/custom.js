const { toSafeInteger } = require("lodash");

// visitor page table
$(document).ready(function () {
    $("#VisitorDt").DataTable();
    $(".dataTables_length").addClass("bs-select");
});



function getCoursesData() {
    axios
        .get("/getCoursesData")
        .then(function (response) {
            if (response.status == 200) {
                $("#mainDivCourse").removeClass("d-none");
                $("#loaderDivCourses").addClass("d-none");

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


