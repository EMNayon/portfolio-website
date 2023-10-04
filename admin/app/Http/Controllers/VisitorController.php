<?php

namespace App\Http\Controllers;

use App\Models\VisitorModel;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    function VisitorIndex(){
        $visitorData = json_decode(VisitorModel::orderBy('id','desc')->get(),true);
        return view('Visitor',['visitorData'=>$visitorData]);
    }
}
