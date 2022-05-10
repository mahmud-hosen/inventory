<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use DB;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $expenseList = Expense::all();
        return response()->json(['expenseList'=>$expenseList],200);
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

        $expense = new Expense();
        $expense->expense_amount = $request->expense_amount;
        $expense->expense_description = $request->expense_description;
        $expense->expense_date = $request->expense_date;
        $expense->save();
        return ['status'=>'Success'];  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $expenseById = Expense::find($id);
        return response()->json(['expenseById'=>$expenseById],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->formValidation($request);
        $expense = Expense::find($id);
        $expense->expense_amount = $request->expense_amount;
        $expense->expense_description = $request->expense_description;
        $expense->expense_date = $request->expense_date;
       
        $expense->save();
        return ['status'=>'Success'];   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
         Expense::destroy($id);
         return ['status'=>'success'];
    }

     public function todayExpense()
     {         
        $todayExpense =  DB::table('expenses')
            ->where('expense_date', '=', date('Y-m-d'))
            ->sum('expense_amount');
        return response()->json(['todayExpense'=>$todayExpense],200);
    }
  
     public function formValidation($request){
        $this->validate($request,
        [
            'expense_amount' => 'required',
            'expense_description' => 'required',
            'expense_date' => 'required',

        ]);
    }
}
