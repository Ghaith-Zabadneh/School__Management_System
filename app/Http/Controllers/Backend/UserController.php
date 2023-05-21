<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PersonalInformation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$data['All_Data']=User::all();
        $data['All_Data']=User::where('user_type','Admin')->get();    
        return view('Backend.user.view_user',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.user.add_user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users|email',
            'name' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect()
                        ->route('users.create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $code= rand(11111111,999999999);       
        DB::transaction(function () use ($request,$code) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type' => 'Admin',
                'role' => $request->role,
                'code' => $code,
            ]);
        
            $user->personalInformation()->create([
                'user_id' => $user->id,
            ]);
        });
        $notification = array(
            'message'=> 'User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('users.index')->with($notification); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find($id);
        return view('Backend.user.edit_user',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }
        User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            

        ]);

        $notification = array(
            'message'=> 'User Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('users.index')->with($notification); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        $notification = array(
            'message'=> 'User Deleted Successfully',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
}
