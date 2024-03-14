@extends('Layout.app2')
@section('title', 'Admin Login')
@section('content')
<div class="container">
    <div class="row justify-content-center d-flex mt-5 mb-5">
        <div class="col-md-10 card">
            <div class="row">
                <div class="col-md-6 p-3">
                    <form action="" class="m-5 loginForm">
                        <div class="form-group">
                            <label for="inputUsername">User Name</label>
                            <input required="" name="username" value="" type="text" class="form-control" id="inputUserName">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input required="" name="password" value="" type="password" class="form-control" id="inputPassword">
                        </div>

                        <div class="form-group">
                            {{-- <label for="inputUsername">User Name</label> --}}
                            <button name="submit" type="submit" class="btn btn-block btn-danger" > Login </button>
                        </div>

                    </form>
                </div>
                <div class="col-md-6 bg-light">
                    <img src="images/bannerImg.png" alt="" class="w-75 m-5">
                </div>
            </div>
        </div>
    </div>
</div>


@section('script')
<script type="text/javascript">
    // $('.loginForm').on('submit',function(event){
    //     event.preventDefault();

    //     let formData = $(this).serializeArray();
    //     // console.log(formData);
    //     let userName = formData[0]['value']
    //     let password = formData[1]['value']
    //     let url = 'onLogin'

    //     axios.post(url, {
    //         user: userName,
    //         pass: password,
    //     }).then(function(response){
    //         // console.log(response.data);
    //         if(response.status == 200 && response.data == 1){
    //             window.location.href = "/";
    //         }else {
    //             alert('Login Failed! Try Again 2!');
    //         }

    //     }).catch(function(error){
    //         alert('Login Failed! Try Again 3!');
    //     })
    // })

    $('.loginForm').on('submit',function(event){
    event.preventDefault();

    let formData = $(this).serializeArray();
    let userName = formData[0]['value']
    let password = formData[1]['value']
    let url = 'onLogin'

    axios.post(url, {
        user: userName,
        pass: password,
    }).then(function(response){
        if(response.status == 200 && response.data.success){
            window.location.href = "/";
        } else {
            alert('Login Failed! Try Again 2!');
        }
    }).catch(function(error){
        alert('Login Failed! Try Again 3!');
    })
})

</script>


@endsection
