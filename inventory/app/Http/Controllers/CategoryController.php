<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Image;
use File;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $AllcategoryList = Category::all();
        return response()->json(['categoryList'=>$AllcategoryList],200);
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

        $category = new Category();
        $category->cat_name = $request->cat_name;
        $category->cat_description = $request->cat_description;

           if ($request->cat_img) {
   
            $uploadPath = public_path('images/category/');
            $img = $request->file('cat_img');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
            $category->cat_img = $newFileName;
            $request->cat_img->move($uploadPath,$newFileName);

        }
       
       // dd($category);
        $category->save();
        return ['status'=>'Success'];   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryById = Category::find($id);
        return response()->json(['categoryById'=>$categoryById],200);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category,$id)
    {
         $this->formValidation($request);
        $categoryItem = Category::find($id);
        $categoryItem->cat_name = $request->cat_name;
        $categoryItem->cat_description = $request->cat_description;

         if ($request->file('cat_img') !='') {
            $uploadPath = public_path('images/category/');
            $img = $request->file('cat_img');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
             
            unlink(public_path('images/category/'.$categoryItem->cat_img));
            $categoryItem->cat_img = $newFileName;
            $request->cat_img->move($uploadPath,$newFileName);

        }
       
       // dd($category);
        $categoryItem->save();
        return ['status'=>'Success'];   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryItem = Category::find($id);
        if($categoryItem->cat_img !='')
        {
            unlink(public_path('images/category/'.$categoryItem->cat_img));

        }

        Category::destroy($id);
       return ['status'=>'success'];

    }
      public function formValidation($request){
        $this->validate($request,
        [
            'cat_name' => 'required',
            'cat_description' => 'required',
            'cat_img' => 'required',


        ]);
    }
}
