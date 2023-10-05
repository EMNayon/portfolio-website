<?php

namespace App\Http\Controllers;

use App\Models\CourseModel;
use App\Models\ServicesModel;
use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ProjectModel;
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
        return view('Home',[
            'servicesData' => $servicesData,
            'coursesData' => $coursesData,
            'projectsData' => $projectsData,
        ]);
    }
}
