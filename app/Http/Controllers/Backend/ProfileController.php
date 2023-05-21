<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\Upload_Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    use Upload_Image;
   
    public function Profile_View (){
        $user= Auth::user();
        return view('Backend.profile.view_profile',compact('user'));
    }
   
    public function Profile_Edit(){
        $user= Auth::user();
        return view('Backend.profile.edit_profile',compact('user'));
    }
   
    public function Profile_Update(Request $request,$id){

        $data= User::findorFail($id);
        if($request->file('image')){
            @unlink(public_path('upload/users/'.$data->image));
            $image = $this->upload($request,$id);
            $data['image'] =$image;
            $data->save();
        }
        User::findorFail($id)->update([
            'name'=> $request->name,
            "email" => $request->email,
              
        ]);
        $user = User::findorFail($id);
        $user->personalInformation()->update([
            'mobile' =>$request->mobile,
            'address' => $request->address,
            'gender' => $request->gender 
        ]);

        $notification = array(
            'message'=> 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('profile.view')->with($notification) ;
        
    }

    public function Password_View (){
        $user= Auth::user();
        return view('Backend.profile.password_profile',compact('user'));

    }

    public function Password_Stor (Request $request , $id ){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|current_password',
            'password' => 'required|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        User::where('id', $id)->update([
            'password' => bcrypt($request->password)
        ]);
    
        return redirect()->route('logout');
        
    }
}

