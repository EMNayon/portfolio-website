<div class="container section-marginTop text-center">
    <h1 class="section-title">কোর্স সমূহ </h1>
    <h1 class="section-subtitle">আইটি কোর্স, প্রজেক্ট ভিত্তিক সোর্স কোড সহ আরো যে সকল সার্ভিস আমরা প্রদান করি </h1>
    <div class="row">
        @foreach ($coursesData as $courseData)
            
        <div class="col-md-4 thumbnail-container">
            <img src="{{ $courseData['course_img'] }}" alt="Avatar" class="thumbnail-image ">
            <div class="thumbnail-middle">
                <h1 class="thumbnail-title"> {{ $courseData['course_name'] }}</h1>
                <h1 class="thumbnail-subtitle">{{ $courseData['course_des'] }}</h1>
                {{-- <h1 class="thumbnail-subtitle">{{ $courseData['course_fee'] }} | {{ $courseData['course_totlenroll'] }}</h1> --}}
                <h1 class="thumbnail-subtitle">{{ $courseData['course_totalclass'] }}</h1>
                <a href="{{$courseData['course_link']}}" target="_blank" class="normal-btn btn">শুরু করুন</a>
            </div>
        </div>
        @endforeach
        {{-- <div class="col-md-4 thumbnail-container">
                <img src="images/react.jpg" alt="Avatar" class="thumbnail-image">
                <div class="thumbnail-middle">
                    <h1 class="thumbnail-title"> লারাভেল এবং প্রোজেক্ট </h1>
                    <h1 class="thumbnail-subtitle">আইটি কোর্স, প্রজেক্ট ভিত্তিক সোর্স কোড সহ আরো যে সকল সার্ভিস আমরা প্রদান করি </h1>
                    <button class="normal-btn btn">শুরু করুন</button>
                </div>
        </div>
        <div class="col-md-4 thumbnail-container ">
                <img src="images/laravel.jpg" alt="Avatar" class="thumbnail-image ">
                <div class="thumbnail-middle">
                    <h1 class="thumbnail-title"> লারাভেল এবং প্রোজেক্ট </h1>
                    <h1 class="thumbnail-subtitle">আইটি কোর্স, প্রজেক্ট ভিত্তিক সোর্স কোড সহ আরো যে সকল সার্ভিস আমরা প্রদান করি </h1>
                    <button class="normal-btn btn">শুরু করুন</button>
                </div>
        </div>
        <div class="col-md-4 thumbnail-container ">
                <img src="images/react.jpg" alt="Avatar" class="thumbnail-image">
                <div class="thumbnail-middle">
                    <h1 class="thumbnail-title"> লারাভেল এবং প্রোজেক্ট </h1>
                    <h1 class="thumbnail-subtitle">আইটি কোর্স, প্রজেক্ট ভিত্তিক সোর্স কোড সহ আরো যে সকল সার্ভিস আমরা প্রদান করি </h1>
                    <button class="normal-btn btn">শুরু করুন</button>
                </div>
        </div>
        <div class="col-md-4 thumbnail-container">
                <img src="images/laravel.jpg" alt="Avatar" class="thumbnail-image">
                <div class="thumbnail-middle">
                    <h1 class="thumbnail-title"> লারাভেল এবং প্রোজেক্ট </h1>
                    <h1 class="thumbnail-subtitle">আইটি কোর্স, প্রজেক্ট ভিত্তিক সোর্স কোড সহ আরো যে সকল সার্ভিস আমরা প্রদান করি </h1>
                    <button class="normal-btn btn">শুরু করুন</button>
                </div>
        </div>
        <div class="col-md-4 thumbnail-container">
                <img src="images/react.jpg" alt="Avatar" class="thumbnail-image">
                <div class="thumbnail-middle">
                    <h1 class="thumbnail-title"> লারাভেল এবং প্রোজেক্ট </h1>
                    <h1 class="thumbnail-subtitle">আইটি কোর্স, প্রজেক্ট ভিত্তিক সোর্স কোড সহ আরো যে সকল সার্ভিস আমরা প্রদান করি </h1>
                    <button class="normal-btn btn">শুরু করুন</button>
                </div>
        </div> --}}
    </div>
</div>
