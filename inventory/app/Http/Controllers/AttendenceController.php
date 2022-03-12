<?php

namespace App\Http\Controllers;

use DB;
use App\Attendence;
use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todayDate = date("Y-m-d");
        $todayAttendenceList=DB::table('attendences')
          ->join('employees','attendences.employee_id','employees.id')
          ->select('employees.employee_name','employees.employee_image','attendences.*')
          ->where('attendence_date',$todayDate)
          ->get();
        return response()->json(['todayAttendenceList'=>$todayAttendenceList],200);

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

        $attd_record = DB::table('attendences')
               ->where('employee_id',$request->employee_id)
               ->Where('attendence_date',$request->attendence_date)
               ->first();
        if($attd_record != '')
        {
            return ['status'=>'Exist'];   

        }
        if($attd_record == ''){

            $attendence = new Attendence();
            $attendence->employee_id = $request->employee_id;
            $attendence->attendence_status = $request->attendence_status;
            $attendence->attendence_date = $request->attendence_date;
            $attendence->save();
           return ['status'=>'NotExist'];
        }
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function show(Attendence $attendence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $attendenceById=DB::table('attendences')
          ->join('employees','attendences.employee_id','employees.id')
          ->select('employees.employee_name','attendences.*')
          ->where('attendences.id',$id)
           ->first();

        return response()->json(['attendenceById'=>$attendenceById],200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request,Attendence $salary,$id)
    {
          $this->validate($request,
        [
            'attendence_status' => 'required',
            'attendence_date' => 'required',
        ]);
        
        $attendence = Attendence::find($id);
        $attendence->attendence_status = $request->attendence_status;
        $attendence->attendence_date = $request->attendence_date;
        $attendence->save();

        return ['status'=>'Attendence Update Successfully'];    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
   
    
    public function getAttendenceBySearch($value)
    {   
        $attendenceListBySearch=DB::table('attendences')
          ->join('employees','attendences.employee_id','employees.id')
          ->select('employees.employee_name','employees.employee_image','attendences.*')
          ->where('attendences.employee_id','LIKE','%'.$value.'%')
          ->orWhere('attendences.attendence_date','LIKE','%'.$value.'%')
          ->get();


        return response()->json(['attendenceListBySearch'=>$attendenceListBySearch],200);
   
    }
     public function formValidation($request){
        $this->validate($request,
        [
            'employee_id' => 'required',
            'attendence_status' => 'required',
            'attendence_date' => 'required',
        ]);
    }
}
