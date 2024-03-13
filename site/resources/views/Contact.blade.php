@extends('Layout.app')
@section('title', 'Contact')
@section('content')
    <div class="container-fluid jumbotron mt-5 ">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 text-center">
                {{-- <img src="images/knowledge.svg" alt="" class="page-top-imag fadeIn"> --}}
                <h1 class="page-top-title mt-3">-- Contact Us -- </h1>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-white jumbotron mt-5 ">
        <div class="row ">
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d228.17072572316738!2d90.35677488125569!3d23.792569779612716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c1038e47a401%3A0xf333ac82ca4b8d66!2sToday%20Fresh%20Fish!5e0!3m2!1sen!2sbd!4v1710347194685!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-6">
                <h5 class="service-card-title">যোগাযোগ করুন </h5>
                <div class="form-group ">
                    <input id="contactNameId" type="text" class="form-control w-100" placeholder="আপনার নাম">
                </div>
                <div class="form-group">
                    <input id="contactMobileId" type="number" class="form-control  w-100" placeholder="মোবাইল নং ">
                </div>
                <div class="form-group">
                    <input id="contactEmailId" type="email" class="form-control  w-100" placeholder="ইমেইল ">
                </div>
                <div class="form-group">
                    <input id="contactSMSId" type="text" class="form-control  w-100" placeholder="মেসেজ ">
                </div>
                <button id="contactSendBtnId" type="submit" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
            </div>

        </div>
    </div>
@endsection
