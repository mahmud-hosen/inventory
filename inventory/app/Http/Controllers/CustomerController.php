<?php

namespace App\Http\Controllers;

use DB;
use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $AllCustomerList = Customer::all();
        return response()->json(['AllCustomerList'=>$AllCustomerList],200);
    
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

        $customer = new Customer();
        $customer->customer_name = $request->customer_name;
        $customer->customer_phone = $request->customer_phone;
        $customer->customer_shop_name = $request->customer_shop_name;
        $customer->customer_address = $request->customer_address;
        $customer->customer_bank_name = $request->customer_bank_name;
        $customer->customer_account_number = $request->customer_account_number;

           if ($request->customer_image) {
   
            $uploadPath = public_path('images/customer/');
            $img = $request->file('customer_image');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
            $customer->customer_image = $newFileName;
            $request->customer_image->move($uploadPath,$newFileName);

        }
       
        $customer->save();
        return ['status'=>'Success'];   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
         $customeryById = Customer::find($id);
        return response()->json(['customeryById'=>$customeryById],200);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
   
    public function update(Request $request, Customer $customer,$id)
    {
         $this->formValidation($request);
        $customer = Customer::find($id);

        $customer->customer_name = $request->customer_name;
        $customer->customer_phone = $request->customer_phone;
        $customer->customer_shop_name = $request->customer_shop_name;
        $customer->customer_address = $request->customer_address;
        $customer->customer_bank_name = $request->customer_bank_name;
        $customer->customer_account_number = $request->customer_account_number;

         if($request->file('customer_image') !='') {
            $uploadPath = public_path('images/customer/');
            $img = $request->file('customer_image');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
             
            unlink(public_path('images/customer/'.$customer->customer_image));
            $customer->customer_image = $newFileName;
            $request->customer_image->move($uploadPath,$newFileName);

        }
       
       // dd($category);
        $customer->save();
        return ['status'=>'Success'];   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if($customer->customer_image !='')
        {
            unlink(public_path('images/customer/'.$customer->customer_image));

        }
        Customer::destroy($id);
        return ['status'=>'success'];
    }

     public function customerCount()
     {
        $customerCount =  DB::table('customers')->count();
        return response()->json(['customerCount'=>$customerCount],200);
    }
     public function formValidation($request){
        $this->validate($request,
        [
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_shop_name' => 'required',
            'customer_address' => 'required',
        ]);
    }
}
