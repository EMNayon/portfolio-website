@extends('Layout.app')
@section('title', 'Photo Gallery')
@section('content')

    <div id="mainDivPhoto" class="container">
        <div class="row">
            <div class="col-md-12 p-3">
                <button data-toggle="modal" data-target="#PhotoModal" id="addNewPhotoBtnId"
                    class="btn btn-sm btn-danger my-3">Add New</button>
            </div>
        </div>
    </div>

    {{-- modal  --}}

    <div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                    <div class="container">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                    <button id="" type="button" class="btn  btn-sm  btn-danger">Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript"></script>

@endsection
