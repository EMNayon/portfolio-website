@extends('Layout.app')
@section('content')
    <div id="mainProjectDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
              <button id="NewAddProject" class="btn btn-sm btn-danger my-3" >Add New</button>
                <table id="project_data_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Image</th>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Description</th>
                            <th class="th-sm">Edit</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="project_table">

                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <div id="loaderDivProject" class="container ">
        <div class="row">
            <div class="col-md-12 text-center p-5 m-5">
                <img src="{{ asset('images/loadder.gif') }}" alt="">
            </div>
        </div>
    </div>

    <div id="wrongDivProject" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                <h1>Something Went Wrong !</h1>
            </div>
        </div>
    </div>
@endsection

<!-- modal for delete -->
<div class="modal top fade" id="deleteProectModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
    data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-body text-center p-3">
                <h4 class="mt-4">Do You Want Delete?</h4>
                <h5 id="projectDeleteId" class="mt-4"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
                    No
                </button>
                <button data-id="" id="projectDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>

{{-- modal for edit --}}

<div class="modal top fade" id="editProjectModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
    data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-body text-center p-3">

                <h5 id="projectEditId" class="mt-4"></h5>
                <img id="projectEditLoder" class="m-5" src="{{ asset('images/loadder.gif') }}" alt="">
                <h5 id="projectEditWrong" class="d-none">Something Went Wrong !</h5>
                <div id="projectEditForm" class="d-none">
                    <div class="form-outline mb-4">
                        <input type="name" id="projectNameId" class="form-control" />
                        <label class="form-label" for="form4Example2">Project Name</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input class="form-control" id="projectDesId" rows="4" />
                        <label class="form-label" for="form4Example3">Project Description</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input class="form-control" id="projectLinkId" rows="4" />
                        <label class="form-label" for="form4Example3">Project Link</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="projectImageId" class="form-control" />
                        <label class="form-label" for="form4Example1">Image Link</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
                    Cancel
                </button>
                <button data-id="" id="projectEditConfirmBtn" type="button" class="btn btn-danger">Save</button>
            </div>
        </div>
    </div>
</div>

{{-- modal for add --}}

<div class="modal top fade" id="addProjectModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
    data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-body text-center p-3">
                <div id="serviceAddForm" class="">
                  <h6 class="mb-2">Add New Project</h6>
                    <div class="form-outline mb-4">
                        <input type="name" id="projectNameAddId" class="form-control" />
                        <label class="form-label" for="form4Example2">Project Name</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input class="form-control" id="projectDesAddId" rows="4" />
                        <label class="form-label" for="form4Example3">Project Description</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input class="form-control" id="projectLinkAddId" rows="4" />
                        <label class="form-label" for="form4Example3">Project Link</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="projectImageAddId" class="form-control" />
                        <label class="form-label" for="form4Example1">Image Link</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
                    Cancel
                </button>
                <button data-id="" id="projectAddConfirmBtn" type="button" class="btn btn-danger">Add New</button>
            </div>
        </div>
    </div>
</div>



@section('script')
    <script type="text/javascript">

getProjectsData()
</script>
@endsection