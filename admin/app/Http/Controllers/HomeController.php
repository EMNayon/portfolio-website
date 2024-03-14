<?php

namespace App\Http\Controllers;

use App\Models\VisitorModel;
use App\Models\ContactModel;
use App\Models\CourseModel;
use App\Models\ProjectModel;
use App\Models\ReviewModel;
use App\Models\ServicesModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function HomeIndex(){

        $total_visitors = VisitorModel::count();
        $total_contacts = ContactModel::count();
        $total_courses = CourseModel::count();
        $total_projects = ProjectModel::count();
        $total_reviews = ReviewModel::count();
        $total_services = ServicesModel::count();
        // dd($visitor);
        return view('Home', [
            'total_visitors' => $total_visitors,
            'total_contacts' => $total_contacts,
            'total_courses' => $total_courses,
            'total_projects' => $total_projects,
            'total_reviews' => $total_reviews,
            'total_services' => $total_services
        ]);
    }
}
