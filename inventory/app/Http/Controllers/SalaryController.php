<?php

namespace App\Http\Controllers;

use DB;
use App\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salaryList=DB::table('salaries')
          ->join('employees','salaries.employee_id','employees.id')
          ->select('employees.employee_name','employees.employee_image','salaries.*')
          ->get();
       return response()->json(['salaryList'=>$salaryList],200);
   
        
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

        $salary = new Salary();
        $salary->employee_id = $request->employee_id;
        $salary->employee_salary = $request->employee_salary;
        $salary->employee_salary_month = $request->employee_salary_month;
        $salary->employee_salary_year = $request->employee_salary_year;
        
        $salary->save();
        return ['status'=>'salary added Successfully'];   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $salaryById = Salary::find($id);
        return response()->json(['salaryById'=>$salaryById],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Salary $salary,$id)
    {
         $this->formValidation($request);
        $salary = Salary::find($id);
        $salary->employee_id = $request->employee_id;
        $salary->employee_salary = $request->employee_salary;
        $salary->employee_salary_month = $request->employee_salary_month;
        $salary->employee_salary_year = $request->employee_salary_year;
        $salary->save();

        return ['status'=>'salary Update Successfully'];    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $productItem = Salary::find($id);
        Salary::destroy($id);
        return ['status'=>'success'];
    }
     public function getSalaryBySearch($value)
    {   
        $SalaryListBySearch=DB::table('salaries')
          ->join('employees','salaries.employee_id','employees.id')
          ->select('employees.employee_name','employees.employee_image','salaries.*')
          ->where('salaries.employee_salary','LIKE','%'.$value.'%')
          ->orWhere('salaries.employee_salary_month','LIKE','%'.$value.'%')
          ->orWhere('salaries.employee_salary_year','LIKE','%'.$value.'%')
          ->orWhere('salaries.created_at','LIKE','%'.$value.'%')
          ->orWhere('employees.employee_name','LIKE','%'.$value.'%')
          ->get();


        return response()->json(['SalaryListBySearch'=>$SalaryListBySearch],200);
   
    }
     public function formValidation($request){
        $this->validate($request,
        [
            'employee_id' => 'required',
            'employee_salary' => 'required',
            'employee_salary_month' => 'required',
            'employee_salary_year' => 'required',
        ]);
    }
}
