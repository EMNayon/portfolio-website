<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryModel;

class PhotoController extends Controller
{
    //
    public function index(){
        return view('Gallery');
    }

    public function Upload(Request $req){
        $imgPath = $req->file('photo')->store('public');
        $imgName = (explode('/', $imgPath))[1];

        $host = $_SERVER['HTTP_HOST'];

        $location = "http://".$host."/storage/".$imgName;
        $result = GalleryModel::insert(['location' => $location]);
        // dd($result);
        return $result;
    }

    function PhotoJson(){
        return GalleryModel::take(4)->get();
    }

    function PhotoJsonByID(Request $req){
        $firstId = $req->id;
        $lastId = $firstId+4;
        return GalleryModel::where('id', '>=', $firstId)->where('id', '<', $lastId)->get();
    }
    function delete(Request $req){
        // dd('okay');
        $oldPhotoURL = $req->input('OldPhotoURL');
        $oldPhotoId = $req->input('id');
        // dd($oldPhotoURL);
        $oldPhotoURLArray = explode("/", $oldPhotoURL);
        $oldPhotoName = end($oldPhotoURLArray);

        $deletePhotoFile = Storage::delete('public/'. $oldPhotoName);
        $deleteRow = GalleryModel::where('id', '=', $oldPhotoId)->delete();
        return $deleteRow;
    }
}
