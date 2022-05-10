<?php

namespace App\Http\Controllers;

use DB;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $EmployeeList = Employee::all();
         return response()->json(['EmployeeList'=>$EmployeeList],200);
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

        $employee = new Employee();
        $employee->employee_name = $request->employee_name;
        $employee->employee_phone = $request->employee_phone;
        $employee->employee_address = $request->employee_address;
        $employee->employee_nid = $request->employee_nid;
        $employee->employee_experience = $request->employee_experience;
        $employee->employee_salary = $request->employee_salary;

           if ($request->employee_image) {
   
            $uploadPath = public_path('images/employee/');
            $img = $request->file('employee_image');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
            $employee->employee_image = $newFileName;
            $request->employee_image->move($uploadPath,$newFileName);

        }
       
        $employee->save();
        return ['status'=>'Employee Insert Successfully'];   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $employeeyById = Employee::find($id);
        return response()->json(['employeeyById'=>$employeeyById],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Employee $employee,$id)
    {
         $this->formValidation($request);
        $employee = Employee::find($id);

        $employee->employee_name = $request->employee_name;
        $employee->employee_phone = $request->employee_phone;
        $employee->employee_address = $request->employee_address;
        $employee->employee_nid = $request->employee_nid;
        $employee->employee_experience = $request->employee_experience;
        $employee->employee_salary = $request->employee_salary;

         if($request->file('employee_image') !='') {
            $uploadPath = public_path('images/employee/');
            $img = $request->file('employee_image');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
             
            unlink(public_path('images/employee/'.$employee->employee_image));
            $employee->employee_image = $newFileName;
            $request->employee_image->move($uploadPath,$newFileName);

        }
       
       // dd($category);
        $employee->save();
        return ['status'=>'Success'];   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $employee = Employee::find($id);
        if($employee->employee_image !='')
        {
            unlink(public_path('images/employee/'.$employee->employee_image));

        }
        Employee::destroy($id);
        return ['status'=>'success'];
    }
     public function employeeCount()
     {
        $employeeCount =  DB::table('employees')->count();
        return response()->json(['employeeCount'=>$employeeCount],200);
     }

    
    public function formValidation($request){
        $this->validate($request,
        [
            'employee_name' => 'required',
            'employee_phone' => 'required',
            'employee_address' => 'required',
            'employee_nid' => 'required',
            'employee_experience' => 'required',
            'employee_salary' => 'required',
        ]);
    }


}
