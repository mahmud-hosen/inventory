<?php

namespace App\Http\Controllers;

use App\Stock;
use DB;

use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

         $storeProducts=DB::table('stocks')
          ->join('products','stocks.product_id','products.id')
          ->select('products.product_name','stocks.*')
          ->where('products.id',$id)
          ->get();
        return response()->json(['storeProducts'=>$storeProducts],200);

   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

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

    public function edit($id)
    {
         $StockById = Stock::find($id);
        return response()->json(['StockById'=>$StockById],200);
    }
     public function update(Request $request, Stock $stock,$id)
    {
         $this->formValidation($request);

        $stock = Stock::find($id);

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

   
    public function destroy( $id)
    {
        Stock::destroy($id);
        return ['status'=>'success'];
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
