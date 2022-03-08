<?php

namespace App\Http\Controllers;

use Cart;
use PDF;
use App\Product;
use App\Customer;
use App\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GeneratePDF(Request $request)
    {
        //  $customerInfo=array();
        //  $customerInfo['customer_name'] = $request->customer_name;
        //  $customerInfo['customer_address'] = $request->customer_address;
        //  $customerInfo['customer_phone'] = $request->customer_phone;
        //  $customerInfo['customerId'] = $request->customerId;
        //  $customerInfo['Shipping'] = $request->Shipping;
        //  $customerInfo['tax'] = $request->tax;
        //  $customerInfo['total'] = $request->total;

        // $cartProductsList = Cart::getContent();
        // return view('admin.document.GeneratePDF',compact('customerInfo','cartProductsList'));

         $pdf = PDF::loadView('admin.document.GeneratePDF');
         return $pdf->stream('invoice.pdf');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
