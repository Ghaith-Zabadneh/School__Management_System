<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Upload_Image {
    public function upload (Request $request,$folder_name){
        $image= date('Ymd').$request->file('image')->getClientOriginalName();
        $path= $request->file('image')->storeAs($folder_name,$image,'users');
        return $path;

    }
    public function employee_upload (Request $request,$folder_name){
        $image= date('Ymd').$request->file('image')->getClientOriginalName();
        $path= $request->file('image')->storeAs($folder_name,$image,'employees');
        return $path;

    }
}
