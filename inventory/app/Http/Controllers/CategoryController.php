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
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;

           if ($request->category_image) {
   
            $uploadPath = public_path('images/category/');
            $img = $request->file('category_image');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
            $category->category_image = $newFileName;
            $request->category_image->move($uploadPath,$newFileName);

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
        $categoryItem->category_name = $request->category_name;
        $categoryItem->category_description = $request->category_description;

         if ($request->file('category_image') !='') {
            $uploadPath = public_path('images/category/');
            $img = $request->file('category_image');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
             
            unlink(public_path('images/category/'.$categoryItem->category_image));
            $categoryItem->category_image = $newFileName;
            $request->category_image->move($uploadPath,$newFileName);

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
        if($categoryItem->category_image !='')
        {
            unlink(public_path('images/category/'.$categoryItem->category_image));

        }
        Category::destroy($id);
       return ['status'=>'success'];

    }

    public function categoryCount()
     {
        $categoryCount =  DB::table('categories')
            ->where('deleted_at', NULL)
            ->count();
        return response()->json(['categoryCount'=>$categoryCount],200);
    }


      public function formValidation($request){
        $this->validate($request,
        [
            'category_name' => 'required',
            'category_description' => 'required',
            'category_image' => 'required',
        ]);
    }
}
