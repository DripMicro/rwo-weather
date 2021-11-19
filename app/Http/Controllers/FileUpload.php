<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Auth;

class FileUpload extends Controller
{
  public function createForm(){
    return view('image-upload');
  }


  public function fileUpload(Request $req){
    
    $fileModal = new Image();
    if($req->hasfile('imageFile')) {
      $req->validate([
        'imageFile' => 'required',
        'imageFile.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:20480'
      ]);
        foreach($req->file('imageFile') as $file)
        {
            $name = $file->getClientOriginalName();
            $file->move(public_path().'/uploads/', $name);  
            $imgData[] = $name;  
        }
        $fileModal->name = json_encode($imgData);
        $fileModal->image_path = json_encode($imgData);
    }
        
        
        $fileModal->title = $req->title;
        $fileModal->content = $req->content;
        $fileModal->user = Auth::user()->name;
        $fileModal->save();

       return back()->with('success', 'File has successfully uploaded!');
    
  }
}