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
    </script>
@endsection
