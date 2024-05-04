<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function index(){
    	$subcategories = SubCategory::select('sub_categories.*', 'categories.name as categoryName')
   	 		->latest()
    		->leftJoin('categories', 'categories.id', '=', 'sub_categories.category_id')
    		->get();


    	return view('admin.subcategory.all_subcategory', compact('subcategories'));
    }

    public function create(){
    	$category = Categorie::all();
    	return view('admin.subcategory.add_subcategory', compact('category'));
    }

    public function store(Request $request){
    	$validator = Validator::make($request->all(),[
    		'name'			=> 'required',
    		'slug'          => 'required|unique:sub_categories',
        	// 'category_id'   => 'required',
    	]);

    	if ($validator->passes()) {
        $subcategorie = new SubCategory();
        $subcategorie->name = $request->name;
        $subcategorie->slug = $request->slug;
        $subcategorie->status = $request->status;
        $subcategorie->category_id = $request->category;
        $subcategorie->save();

        return redirect()->route('admin.all.subcategory');
    	} else {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        	]);
    	}
    }

    public function edit($id){

    	$subcategories = SubCategory::findOrFail($id);
    	$categories = Categorie::all();

    	// $subcategories = SubCategory::findOrFail($id)->select('sub_categories.*', 'categories.name as categoryName')
   	 // 		->latest()
    	// 	->leftJoin('categories', 'categories.id', '=', 'sub_categories.category_id')
    	// 	->get();

    	return view('admin.subcategory.edit_subcategory', compact('subcategories','categories'));
    }

    public function update(Request $request){
    	$pid = $request->id;

    	$validator = Validator::make($request->all(), [
        'name' => 'required',
        'slug' => 'required|unique:sub_categories,slug,'.$pid.',id',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Find the category
    $subcategory = SubCategory::findOrFail($pid);

    // Update attributes
    $subcategory->name = $request->name;
    $subcategory->slug = $request->slug;
    $subcategory->status = $request->status;
    $subcategory->category_id = $request->category;

    // Save changes
    $subcategory->save();

    return redirect()->route('admin.all.subcategory')->with('success', 'Category updated successfully.');
    }

    public function delete($id){
    	$subcategory = SubCategory::findOrFail($id);

    	$subcategory->delete();

    	return redirect()->route('admin.all.subcategory')->with('success', 'Category updated successfully.');
    }


}
