<?php

namespace App\Http\Controllers;

use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use Image;
use File;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AllProductList = DB::table('products')
           ->join('categories', 'products.cat_id', '=', 'categories.id')
          ->join('sub_categories', 'products.sub_cat_id', '=', 'sub_categories.id')
           ->select('products.id','products.cat_id','products.sub_cat_id','products.product_name','products.product_price','products.product_img','products.description','products.status','categories.cat_name','categories.cat_description','categories.cat_img','sub_categories.sub_cat_name','sub_categories.sub_cat_description','sub_categories.sub_cat_img',)
           ->get();
        return response()->json(['AllProductList'=>$AllProductList],200);
        
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
        
        $product = new Product();
        $product->cat_id = $request->cat_id;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->product_price = $request->product_price;
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->status = $request->status;


           if ($request->product_img) {
   
            $uploadPath = public_path('images/product/');
            $img = $request->file('product_img');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
            $product->product_img = $newFileName;
            $request->product_img->move($uploadPath,$newFileName);

        }
       
       // dd($category);
        $product->save();
        return ['status'=>'Success'];

        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $productById = Product::find($id);
        return response()->json(['productById'=>$productById],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product,$id)
    {
         $this->formValidation($request);

        $product = Product::find($id);
        $product->cat_id = $request->cat_id;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->product_price = $request->product_price;
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->status = $request->status;


         if ($request->file('product_img') !='') {
   
            $uploadPath = public_path('images/product/');
            $img = $request->file('product_img');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
            unlink(public_path('images/product/'.$subCategory->sub_cat_img));
            $product->product_img = $newFileName;
            $request->product_img->move($uploadPath,$newFileName);

        }
       
       // dd($category);
        $product->save();
        return ['status'=>'Success'];  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $productItem = Product::find($id);
        if($productItem->product_img !='')
        {
            unlink(public_path('images/product/'.$productItem->product_img));

        }

        Product::destroy($id);
       return ['status'=>'success'];
    }
     public function getSubcategoryByCategoryId($id)
    {
         $subCategoryList = SubCategory::where('cat_id',$id)->get();
        return response()->json(['subCategoryListById'=>$subCategoryList],200);
        

    }

     public function formValidation($request){
        $this->validate($request,
        [
            'cat_id' => 'required',
            'sub_cat_id' => 'required',
            'product_price' => 'required',
            'product_name' => 'required',
            'description' => 'required',
            'product_img' => 'required',
            'status' => 'required',

        ]);
    }
}
