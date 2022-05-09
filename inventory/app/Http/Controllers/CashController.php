<?php

namespace App\Http\Controllers;

use App\Cash;
use Illuminate\Http\Request;
use DB;

class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cashList = Cash::all();
        return response()->json(['cashList'=>$cashList],200);
    }
     public function totalCash()
    {
         $total_cash = DB::table('cashes')->sum('cash_amount');
        return response()->json(['total_cash'=>$total_cash],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->formValidation($request);

        $cash = new Cash();
        $cash->cash_amount = $request->cash_amount;
        $cash->cash_date = $request->cash_date;

        $cash->save();
        return ['status'=>'Success'];   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function show(Cash $cash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $cashById = Cash::find($id);
        return response()->json(['cashById'=>$cashById],200);
        
    }

    public function update(Request $request,$id)
    {
         $this->formValidation($request);
        $cash = Cash::find($id);
        $cash->cash_amount = $request->cash_amount;
        $cash->cash_date = $request->cash_date;
       
        $cash->save();
        return ['status'=>'Success'];   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Cash::destroy($id);
         return ['status'=>'success'];
    }
     public function formValidation($request){
        $this->validate($request,
        [
            'cash_amount' => 'required',
            'cash_date' => 'required',
        ]);
    }
}
