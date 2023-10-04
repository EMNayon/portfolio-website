@extends('Layout.app')
@section('content')

<div id="mainDivCourse" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">
            <button id="addNewCourse" class="btn btn-sm btn-danger my-3" >Add New</button>
            <table id="course_data_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Fee</th>
                        <th class="th-sm">Class</th>
                        <th class="th-sm">Enroll</th>
                        <th class="th-sm">Details</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="courses_table">

                </tbody>
            </table>

        </div>
    </div>
</div>

<div id="loaderDivCourses" class="container ">
    <div class="row">
        <div class="col-md-12 text-center p-5 m-5">
            <img src="{{ asset('images/loadder.gif') }}" alt="">
        </div>
    </div>
</div>

<div id="wrongDivCourses" class="container d-none">
    <div class="row">
        <div class="col-md-12 text-center p-5">
            <h1>Something Went Wrong !</h1>
        </div>
    </div>
</div>



@endsection

{{-- add modal --}}
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

{{-- modal for edit --}}

<div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Course Details & Update</h5>
      </div>
      <div class="modal-body  text-center">
        <h5 id="courseEditId" class="mt-4"></h5>
        <img id="courseEditLoder" class="m-5" src="{{ asset('images/loadder.gif') }}" alt="">
        <h5 id="courseEditWrong" class="d-none">Something Went Wrong !</h5>
       <div class="container d-none" id="courseEditForm">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameAddId" type="text"  class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesAddId" type="text"  class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeAddId" type="text"  class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollAddId" type="text" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassAddId" type="text" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkAddId" type="text" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgAddId" type="text" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseEditConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

{{-- modal for delete --}}
<div class="modal top fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
    data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-body text-center p-3">
                <h4 class="mt-4">Do You Want Delete?</h4>
                <h5 id="courseDeleteId" class="mt-4"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
                    No
                </button>
                <button data-id="" id="courseDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>

@section('script')
<script type="text/javascript"> 
    getCoursesData()
</script>
@endsection
