<?php

namespace App\Http\Controllers;

use App\Models\CourseModel;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    function CoursesIndex(){
        return view('Courses');
    }
    function getCoursesData(){
        $result = json_encode(CourseModel::all());
        return $result;
    }
    function getCourseDetails(Request $req){
        $id = $req->input('id');
        $result = json_encode(CourseModel::where('id','=',$id)->get());
        return $result;
    }
    function CourseAdd(Request $req){
        $course_name = $req->input('course_name');
        $course_des = $req->input('course_des');
        $course_fee = $req->input('course_fee');
        $course_totlenroll = $req->input('course_totlenroll');
        $course_totalclass = $req->input('course_totalclass');
        $course_link = $req->input('course_link');
        $course_img = $req->input('course_img');

        $result = CourseModel::insert([
            'course_name' => $course_name,
            'course_des' => $course_des,
            'course_fee' => $course_fee,
            'course_totlenroll' => $course_totlenroll,
            'course_totalclass' => $course_totalclass,
            'course_link' => $course_link,
            'course_img' => $course_img,
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
    function CourseUpdate(Request $req){
        $id = $req->input('id');
        $course_name = $req->input('course_name');
        $course_des = $req->input('course_des');
        $course_fee = $req->input('course_fee');
        $course_totlenroll = $req->input('course_totlenroll');
        $course_totalclass = $req->input('course_totalclass');
        $course_link = $req->input('course_link');
        $course_img = $req->input('course_img');

        $result = CourseModel::where('id','=',$id)->update([
            'course_name' => $course_name,
            'course_des' => $course_des,
            'course_fee' => $course_fee,
            'course_totlenroll' => $course_totlenroll,
            'course_totalclass' => $course_totalclass,
            'course_link' => $course_link,
            'course_img' => $course_img,
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
    function CourseDelete(Request $req){
        $id = $req->input('id');
        $result = CourseModel::where('id','=',$id)->delete();
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }


}
