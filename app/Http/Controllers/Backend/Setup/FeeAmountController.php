<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategoryAmount;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeeAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$data=FeeCategoryAmount::all();
        $data=FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();  
         
        return view('Backend.Setup.Fee_Amount.amount_view',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['fee_categories']=FeeCategory::all();
        $data['classes']=StudentClass::all();
        return view('Backend.Setup.Fee_Amount.amount_add',compact('data'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $count_classes= count($request->class_id);
        if($count_classes){
            for($i=0;$i<$count_classes;$i++){
                FeeCategoryAmount::create([
                    'fee_category_id'=>$request->fee_category_id,
                    'class_id'=>$request->class_id[$i],
                    'amount'=>$request->amount[$i],
                ]);
            } //end for
        } //end if

        $notification = array(
            'message'=> 'Fee Amount Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('feeam.index')->with($notification);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=FeeCategoryAmount::where('fee_category_id',$id)->orderBy('class_id', 'asc')->get();
        return view('Backend.Setup.Fee_Amount.amount_details',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['edit_data']=FeeCategoryAmount::where('fee_category_id',$id)->orderBy('class_id', 'asc')->get();
        $data['fee_categories']=FeeCategory::all();
        $data['classes']=StudentClass::all();

        return view('Backend.Setup.Fee_Amount.amount_edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $count_classes= count($request->class_id);
        FeeCategoryAmount::where('fee_category_id',$id)->delete();
        if($count_classes){
            for($i=0;$i<$count_classes;$i++){
                FeeCategoryAmount::create([
                    'fee_category_id'=>$request->fee_category_id,
                    'class_id'=>$request->class_id[$i],
                    'amount'=>$request->amount[$i],
                ]);
            } //end for
        } //end if

        $notification = array(
            'message'=> 'Fee Amount Updatede Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('feeam.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        FeeCategoryAmount::where('fee_category_id',$id)->delete();
        $notification = array(
            'message'=> 'Fee Category Amount Deleted Successfully',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
}
