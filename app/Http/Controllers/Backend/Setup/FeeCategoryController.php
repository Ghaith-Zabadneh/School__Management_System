<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FeeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=FeeCategory::all();    
        return view('Backend.Setup.Fee_Category.fee_view',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.Setup.Fee_Category.fee_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:student_shifts,name',       
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
 
        FeeCategory::create([
            'name' => $request->name,
        ]);
        $notification = array(
            'message'=> 'Fee Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('feecat.index')->with($notification);
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
        $data = FeeCategory::find($id);
        return view('Backend.Setup.Fee_Category.fee_edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:student_shifts,name',       
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        

        FeeCategory::findorFail($id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message'=> 'Fee Category Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('feecat.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        FeeCategory::findorFail($id)->delete();
        $notification = array(
            'message'=> 'Fee Category Deleted Successfully',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
}
