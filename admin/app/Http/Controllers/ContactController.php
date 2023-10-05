<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function ContactIndex(){
        return view('Contact');
    }
    public function getContactData(){
        $result = json_encode(ContactModel::all());
        return $result;
    }
    function contactDelete(Request $req){
        $id = $req->input('id');
        $result = ContactModel::where('id','=',$id)->delete();
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
}
