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
        // $AllSubCategoryList = DB::table('categories')
        //    ->join('sub_categories','categories.id','=','sub_categories.category_id')
        //    ->select('categories.*','sub_categories.*',)
        //    ->get();
        // return response()->json(['SubCategoryList'=>$AllSubCategoryList],200);

        ///--------------
        //$subCategoryList = SubCategory::all();
        //return response()->json(['subCategoryList'=>$subCategoryList],200);
        //Data fatch use to ralation so ->get()
        $AllSubCategoryList = SubCategory::with('categories')->get(); 

       // dd($subCategoryList);
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
        $subCategory->category_id = $request->category_id;
        $subCategory->sub_category_name = $request->sub_category_name;
        $subCategory->sub_category_description = $request->sub_category_description;

           if ($request->sub_category_img) {
   
            $uploadPath = public_path('images/subCategory/');
            $img = $request->file('sub_category_img');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
            $subCategory->sub_category_img = $newFileName;
            $request->sub_category_img->move($uploadPath,$newFileName);

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

        $subCategory->category_id = $request->category_id;
        $subCategory->sub_category_name = $request->sub_category_name;
        $subCategory->sub_category_description = $request->sub_category_description;

         if ($request->file('sub_category_img') !='') {
   
            $uploadPath = public_path('images/subCategory/');
            $img = $request->file('sub_category_img');
            $newFileName = time() . '.'. $img->getClientOriginalExtension();
            unlink(public_path('images/subCategory/'.$subCategory->sub_category_img));
            $subCategory->sub_category_img = $newFileName;
            $request->sub_category_img->move($uploadPath,$newFileName);

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
        if($SubCategoryItem->sub_category_img !='')
        {
            unlink(public_path('images/subCategory/'.$SubCategoryItem->sub_category_img));

        }

        SubCategory::destroy($id);
       return ['status'=>'success'];

    }

    public function subCategoryCount()
     {
        $subCategoryCount =  DB::table('sub_categories')
            ->where('deleted_at', NULL)
            ->count();
        return response()->json(['subCategoryCount'=>$subCategoryCount],200);
    }

    
    public function formValidation($request){
          $this->validate($request,
        [
            'category_id' => 'required',
            'sub_category_name' => 'required',
            'sub_category_description' => 'required',
            'sub_category_img' => 'required',
        ]);
    }

}
