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
        // $AllProductList = DB::table('products')
        //    ->join('categories', 'products.category_id', '=', 'categories.id')
        //   ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
        //    ->select('products.id','products.category_id','products.sub_category_id','products.product_name','products.product_price','products.product_image','products.description','products.status','categories.category_name','categories.category_description','categories.category_image','sub_categories.sub_category_name','sub_categories.sub_category_description','sub_categories.sub_category_img',)
        //    ->get();
        $AllProductList = Product::with(['categories','sub_categories'])->get();
        // dd($contentList);
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
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_code = $request->product_code;
        $product->product_buying_price = $request->product_buying_price;
        $product->product_selling_price = $request->product_selling_price;
        $product->product_status = $request->product_status;


           if ($request->product_image) {
   
            $uploadPath = public_path('images/product/');
            $img = $request->file('product_image');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
            $product->product_image = $newFileName;
            $request->product_image->move($uploadPath,$newFileName);

        }
       
       // dd($category);
        $product->save();
        return ['status'=>'Success'];

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

        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_code = $request->product_code;
        $product->product_buying_price = $request->product_buying_price;
        $product->product_selling_price = $request->product_selling_price;
        $product->product_status = $request->product_status;


         if ($request->file('product_image') !='') {
   
            $uploadPath = public_path('images/product/');
            $img = $request->file('product_image');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
            unlink(public_path('images/product/'.$product->product_image));
            $product->product_image = $newFileName;
            $request->product_image->move($uploadPath,$newFileName);

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
        if($productItem->product_image !='')
        {
            unlink(public_path('images/product/'.$productItem->product_image));

        }

        Product::destroy($id);
       return ['status'=>'success'];
    }
    public function getSubcategoryByCategoryId($id)
    {
         $subCategoryList = SubCategory::where('category_id',$id)->get();
        return response()->json(['subCategoryListById'=>$subCategoryList],200);
    }
    
     public function getProductBySubCategoryId($id)
    {
         $productListBySubCategoryId = Product::where('sub_category_id',$id)->get();
        return response()->json(['productListBySubCategoryId'=>$productListBySubCategoryId],200);
   
    }
    
    public function getProductBySearch($value)
    {   // dd($value);
        // $productListBySearch = Product::where('sub_category_id',$id)->get();
        $productListBySearch = Product::where('product_name','LIKE','%'.$value.'%')
                ->orWhere('product_selling_price','LIKE','%'.$value.'%')
                ->get();
        return response()->json(['productListBySearch'=>$productListBySearch],200);
   
    }

     public function formValidation($request){
        $this->validate($request,
        [
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'product_name' => 'required',
            'product_description' => 'required',
            'product_code' => 'required',
            'product_buying_price' => 'required',
            'product_selling_price' => 'required',
            'product_image' => 'required',
            'product_status' => 'required',

        ]);
    }
}
