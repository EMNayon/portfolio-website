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

    <div class="container-fluid">
        <div class="row " id="photoLoad">

        </div>
        <button class="btn btn-primary" id="LoadMoreBtn">Load More</button>
    </div>




@endsection



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
            <div class="modal-body">
                <input class="form-control" type="file" id="imgInput">
                <img id="imgPreview" src="{{ asset('images/default-image.jpg') }}" width="100%" class="mt-3">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                <button id="savePhoto" type="button" class="btn  btn-sm  btn-danger">Save</button>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script type="text/javascript">
        $('#imgInput').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0])
            reader.onload = function(event) {
                var imgSource = event.target.result;
                $('#imgPreview').attr('src', imgSource);
            }
        })

        $('#savePhoto').on('click', function() {

            $('#savePhoto').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

            var file = $('#imgInput').prop('files')[0];
            var formData = new FormData();
            formData.append('photo', file);

            axios.post("/upload", formData).then(function(response) {
                // console.log('i am here');
                // alert(response.data);
                console.log(response.data.success);
                if (response.status == 200 && response.data == 1) {

                    $("#PhotoModal").modal('hide');
                    $('#savePhoto').html('Save');
                    // alert('Photo Uploaded Sucessfully!');
                } else {
                    $("#PhotoModal").modal("hide");
                    $('#savePhoto').html('Save');
                    alert('Photo Uploaded Failed! 1');
                }
            }).catch(function(error) {
                $("#PhotoModal").modal("hide");
                $('#savePhoto').html('Save');
                alert('Photo Uploaded Failed! 2');
            });
        });

        LoadPhoto();

        function LoadPhoto() {
            axios.get('/photojson').then(function(response) {

                $.each(response.data, function(i, item) {
                    $("<div class='col-md-3 p-1'>")
                        .html(
                            "<img data-id=" + item['id'] + " class='imgOnRow' src=" + item['location'] +
                            ">" +
                            "<button class='btn deletePhoto' data-id=" + item['id'] + " data-photo=" + item[
                                'location'] + " >Delete</button>"
                        )
                        .appendTo("#photoLoad");
                });
                // console.log(response.data);
                $('.deletePhoto').on('click', function(event) {
                    // console.log($(this).data('photo'));
                    let id = $(this).data('id');
                    let photo = $(this).data('photo');
                    photoDelete(photo, id);
                    event.preventDefault();
                })
            }).catch(function(error) {

            })
        }

        var ImgID = 0;

        function LoadById(firstImgId, loadMoreBtn) {
            // alert(firstImgId);
            ImgID = ImgID + 4;
            let PhotoId = firstImgId + ImgID;
            let url = "/photojsonbyid/" + PhotoId;
            // alert(url);
            loadMoreBtn.html("<div class='spinner-border spinner-border-sm' role='status'> </div>")
            axios.get(url).then(function(response) {
                loadMoreBtn.html("Load More")
                $.each(response.data, function(i, item) {
                    $("<div class='col-md-3 p-1'>")
                        .html(
                            "<img data-id=" + item['id'] + " class='imgOnRow' src=" + item['location'] +
                            ">" +
                            "<button class='btn' data-id=" + item['id'] + " data-photo=" + item[
                            'location'] + " >Delete</button>"
                        )
                        .appendTo("#photoLoad");
                });
                console.log(response.data);
            }).catch(function(error) {

            })
        }

        $('#LoadMoreBtn').on('click', function() {
            let loadMoreBtn = $(this);
            let firstImgId = $(this).closest('div').find('img').data('id');
            // alert($firstImgId )
            LoadById(firstImgId, loadMoreBtn);
        })

        // function photoDelete(OldPhotoURL, id){
        //     let url = "/photodelete";
        //     let formData = new FormData();
        //     formData.append('OldPhotoURL', OldPhotoURL);
        //     formData.append('id', id);

        //     console.log(formData.append('id', id));

        //     axios.post(url,formData).then(function(response){
        //         if(response.status == 200 && response.data == 1){
        //             // console.log('okay');
        //             $('.photoLoad').empty();
        //             LoadPhoto();
        //         }else {
        //             alert('failed')
        //         }
        //     }).catch(function(){
        //         alert("failed catch")
        //     })
        // }

        function photoDelete(OldPhotoURL, id) {
            let url = "/photodelete";
            let formData = new FormData();
            formData.append('OldPhotoURL', OldPhotoURL);
            formData.append('id', id);

            axios.post(url, formData)
                .then(function(response) {
                    if (response.status == 200 && response.data == 1) {
                        $('.photoLoad').empty();
                        LoadPhoto();
                    } else {
                        // Server responded with an error status or the data is not as expected
                        alert('Failed to delete photo');
                    }
                })
                .catch(function(error) {
                    // An error occurred during the request
                    alert("Failed to delete photo. Error: " + error.response.status);
                });
        }
    </script>

@endsection
