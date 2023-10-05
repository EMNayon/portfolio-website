@extends('Layout.app')
@section('content')

<div id="mainDivContact" class="container d-none">
    <div class="row">
        <div class="col-md-12 p-5">
            {{-- <button id="addNewCourse" class="btn btn-sm btn-danger my-3" >Add New</button> --}}
            <table id="contact_data_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Mobile</th>
                        <th class="th-sm">Email</th>
                        <th class="th-sm">Message</th> 
                        <th class="th-sm">Delete</th>
                    </tr>
                </thead>
                <tbody id="contact_table">

                </tbody>
            </table>

        </div>
    </div>
</div>

<div id="loaderDivContact" class="container ">
    <div class="row">
        <div class="col-md-12 text-center p-5 m-5">
            <img src="{{ asset('images/loadder.gif') }}" alt="">
        </div>
    </div>
</div>

<div id="wrongDivContact" class="container d-none">
    <div class="row">
        <div class="col-md-12 text-center p-5">
            <h1>Something Went Wrong !</h1>
        </div>
    </div>
</div>
@endsection

{{-- modal for delete --}}
<div class="modal top fade" id="deleteContactModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true"
    data-mdb-backdrop="true" data-mdb-keyboard="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-body text-center p-3">
                <h4 class="mt-4">Do You Want Delete?</h4>
                <h5 id="contactDeleteId" class="mt-4"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-mdb-dismiss="modal">
                    No
                </button>
                <button data-id="" id="contactDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script type="text/javascript">
        getContactData()
</script>
@endsection