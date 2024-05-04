<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(){

    	$brands = Brand::latest()->paginate(10);

    	return view('admin.brand.all_brand', compact('brands'));
    }

    public function create(){

    	return view('admin.brand.add_brand');
    }

    public function store(Request $request){
    	$validator = Validator::make($request->all(),[
    		'name' => 'required',
    		'slug' => 'required|unique:brands',
    	]);
    	if($validator->passes()){
    		$brand = new Brand();
    		$brand->name = $request->name;
    		$brand->slug = $request->slug;
    		$brand->status = $request->status;
    		$brand->save();

    		return redirect()->route('admin.all.brand');
    	}else {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        	]);
    	}

    }

    public function edit($id){

    	$brand = Brand::findOrFail($id);

    	return view('admin.brand.edit_brand', compact('brand'));
    }

    public function update(Request $request){

    	$pid = $request->id;

    	 // Validation
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'slug' => 'required|unique:categories,slug,'.$pid.',id',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Find the category
    $brand = Brand::findOrFail($pid);

    // Update attributes
    $brand->name = $request->name;
    $brand->slug = $request->slug;
    $brand->status = $request->status;

    // Save changes
    $brand->save();

    return redirect()->route('admin.all.brand')->with('success', 'Category updated successfully.');
    }

    public function delete($id){
    	// Find the category by its ID
    $brand = Brand::findOrFail($id);

    // Delete the category
    $brand->delete();

    // Redirect back or to any other page
    return redirect()->route('admin.all.brand')->with('success', 'Category deleted successfully.');
    }
}
