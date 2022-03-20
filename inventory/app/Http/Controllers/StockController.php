<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        
        $stock = new Stock();
        $stock->product_id = $request->product_id;
        $stock->company_name = $request->company_name;
        $stock->product_quantity = $request->product_quantity;

        $stock->product_unit_cost = $request->product_unit_cost;
        $stock->product_total_price = $request->product_total_price;

        $stock->paid = $request->paid;
        $stock->due = $request->due;
        $stock->stock_date = $request->stock_date;

        $stock->save();
        return ['status'=>'Success'];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
     public function formValidation($request){
        $this->validate($request,
        [
            'product_id' => 'required',
            'company_name' => 'required',
            'product_quantity' => 'required',
            'product_unit_cost' => 'required',
            'product_total_price' => 'required',
            'paid' => 'required',
            'due' => 'required',
            'stock_date' => 'required',

        ]);
    }
    
}
