<?php

namespace App\Http\Controllers;

use App\SubCategory;
use App\Category;

use Illuminate\Http\Request;
use Image;
use File;
use DB;


class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AllSubCategoryList = DB::table('categories')
           ->join('sub_categories','categories.id','=','sub_categories.cat_id')
           ->select('categories.*','sub_categories.*',)
           ->get();
        return response()->json(['SubCategoryList'=>$AllSubCategoryList],200);
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

        $subCategory = new SubCategory();
        $subCategory->cat_id = $request->cat_id;
        $subCategory->sub_cat_name = $request->sub_cat_name;
        $subCategory->sub_cat_description = $request->sub_cat_description;

           if ($request->sub_cat_img) {
   
            $uploadPath = public_path('images/subCategory/');
            $img = $request->file('sub_cat_img');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
            $subCategory->sub_cat_img = $newFileName;
            $request->sub_cat_img->move($uploadPath,$newFileName);

        }
       
       // dd($category);
        $subCategory->save();
        return ['status'=>'Success'];   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
      public function edit($id)
    {
        $subCategoryById = SubCategory::find($id);
        return response()->json(['subCategoryById'=>$subCategoryById],200);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory,$id)
    {
         $this->formValidation($request);

        $subCategory = SubCategory::find($id);

        $subCategory->cat_id = $request->cat_id;
        $subCategory->sub_cat_name = $request->sub_cat_name;
        $subCategory->sub_cat_description = $request->sub_cat_description;

         if ($request->file('sub_cat_img') !='') {
   
            $uploadPath = public_path('images/subCategory/');
            $img = $request->file('sub_cat_img');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
            unlink(public_path('images/subCategory/'.$subCategory->sub_cat_img));
            $subCategory->sub_cat_img = $newFileName;
            $request->sub_cat_img->move($uploadPath,$newFileName);

        }
       
       // dd($category);
        $subCategory->save();
        return ['status'=>'Success'];   

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $SubCategoryItem = SubCategory::find($id);
        if($SubCategoryItem->sub_cat_img !='')
        {
            unlink(public_path('images/subCategory/'.$SubCategoryItem->sub_cat_img));

        }

        SubCategory::destroy($id);
       return ['status'=>'success'];

    }
         public function formValidation($request){
        $this->validate($request,
        [
            'cat_id' => 'required',
            'sub_cat_name' => 'required',
            'sub_cat_description' => 'required',
            'sub_cat_img' => 'required',
        ]);
    }

}
