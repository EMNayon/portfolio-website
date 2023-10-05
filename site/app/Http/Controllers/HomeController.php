<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use App\Models\CourseModel;
use App\Models\ServicesModel;
use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ProjectModel;
use App\Models\ReviewModel;

class HomeController extends Controller
{
    function HomeIndex(){
        $UserIP=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate= date("Y-m-d h:i:sa");
        VisitorModel::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);


        $servicesData = json_decode(ServicesModel::all(),true);
        $coursesData = json_decode(CourseModel::orderBy('id','desc')->limit(6)->get(),true);
        $projectsData = json_decode(ProjectModel::orderBy('id','desc')->limit(5)->get(),true);
        $reviewData = json_decode(ReviewModel::orderBy('id','desc')->limit(3)->get(),true);
        return view('Home',[
            'servicesData' => $servicesData,
            'coursesData' => $coursesData,
            'projectsData' => $projectsData,
            'reviewData' => $reviewData,
        ]);
    }

    public function ContactSend(Request $req){
        $contact_name = $req->input('contact_name');
        $mobile_no = $req->input('mobile_no');
        $contact_email = $req->input('contact_email');
        $contact_message = $req->input('contact_message');

        $result = ContactModel::insert([
            'contact_name' => $contact_name,
            'mobile_no' => $mobile_no,
            'contact_email' => $contact_email,
            'contact_message' => $contact_message,
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
}
