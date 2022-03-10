<?php

namespace App\Http\Controllers;

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

        $attendence = new Attendence();
        $attendence->employee_id = $request->employee_id;
        $attendence->attendence_status = $request->attendence_status;
        $attendence->attendence_date = $request->attendence_date;
        $attendence->save();
        return ['status'=>'Attendence Save Successfully'];   
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
    public function edit(Attendence $attendence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendence $attendence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendence $attendence)
    {
        //
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
