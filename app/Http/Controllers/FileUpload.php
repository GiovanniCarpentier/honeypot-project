<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;

class FileUpload extends Controller
{
  public function createForm(){
    $files = File::all();
    return view('file-upload', ["files" => $files]);
  }

  public function fileUpload(Request $req){
        $req->validate([
        'file' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        $id = Auth::user()->id;
        
        $name = User::select('name')->where('id', $id)->pluck('name')->first();

        $fileModel = new File;

        $value = File::where("name",$name)->get();

        if($req->file() and $value->isEmpty()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');

            $fileModel->name = $name;
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();

            User::where("id",$id)->update(["file_path" => $filePath]);
            return back()
            ->with('success','File has been uploaded.')
            ->with('file', $fileName);

        } else if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');

            $oldFile = User::select('file_path')->where('id',$id)->pluck('file_path')->first();

            $newfile = File::select('name')->where('name', $name)->pluck('name')->first();

            File::where("name",$newfile)->update(["file_path" => '/storage/' . $filePath]);
            User::where("id",$id)->update(["file_path" => $filePath]);

            return back()
            ->with('success','File has been uploaded.')
            ->with('file', $fileName);
        }
   }

}
