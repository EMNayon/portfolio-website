<?php

namespace App\Http\Controllers;

use App\Models\ReviewModel;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function ReviewIndex(){
        return view('Review');
    }
    function getReviewData(){
        $test = 'Hello';
        // dd($test);
        $result = json_encode(ReviewModel::all());
        // dd($result);
        return $result;
    }
    function getReviewDetails(Request $req){
        $id = $req->input('id');
        $result = json_encode(ReviewModel::where('id','=',$id)->get());
        return $result;
    }
    function ReviewAdd(Request $req){
        $reviewer_name = $req->input('reviewer_name');
        $reviewer_des = $req->input('reviewer_des');
        $reviewer_img = $req->input('reviewer_img');

        $result = ReviewModel::insert([
            'reviewer_name' => $reviewer_name,
            'reviewer_des' => $reviewer_des,
            'reviewer_img' => $reviewer_img,
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
    function ReviewUpdate(Request $req){
        $id = $req->input('id');
        $reviewer_name = $req->input('reviewer_name');
        $reviewer_des = $req->input('reviewer_des');
        $reviewer_img = $req->input('reviewer_img');


        $result = ReviewModel::where('id','=',$id)->update([
            'reviewer_name' => $reviewer_name,
            'reviewer_des' => $reviewer_des,
            'reviewer_img' => $reviewer_img,
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
    function ReviewDelete(Request $req){
        $id = $req->input('id');
        $result = ReviewModel::where('id','=',$id)->delete();
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
}
