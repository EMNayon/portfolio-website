@extends('Layout.app')
@section('title', 'Home')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$total_visitors}}</h3>
                    <h3 class="count-card-text">Total Visitor</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$total_services}}</h3>
                    <h3 class="count-card-text">Total Services</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$total_projects}}</h3>
                    <h3 class="count-card-text">Total Projects</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$total_courses}}</h3>
                    <h3 class="count-card-text">Total Courses</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$total_contacts}}</h3>
                    <h3 class="count-card-text">Total Contacts</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{ $total_reviews}}</h3>
                    <h3 class="count-card-text">Total Reviews</h3>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
