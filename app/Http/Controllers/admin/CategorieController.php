<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\Validator;


class CategorieController extends Controller
{
    public function index(){
    	$datas = Categorie::latest()->paginate(10);

    	return view('admin.categories.all_categorie', compact('datas'));
    }
    public function create(){
    	

    	return view('admin.categories.add_categorie');
    }
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'slug' => 'required|unique:sub_categories',
    ]);

    if ($validator->passes()) {
        $categorie = new Categorie();
        $categorie->name = $request->name;
        $categorie->slug = $request->slug;
        $categorie->status = $request->status;
        $categorie->save();

        return redirect()->route('admin.all.categorie');
    } else {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }
}

    public function edit($id){
    	$datas = Categorie::findOrFail($id);

    	return view('admin.categories.edit_category',compact('datas'));
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
    $category = Categorie::findOrFail($pid);

    // Update attributes
    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->status = $request->status;

    // Save changes
    $category->save();

    return redirect()->route('admin.all.categorie')->with('success', 'Category updated successfully.');
}


    public function destroy($id)
{
    // Find the category by its ID
    $category = Categorie::findOrFail($id);

    // Delete the category
    $category->delete();

    // Redirect back or to any other page
    return redirect()->route('admin.all.categorie')->with('success', 'Category deleted successfully.');
}

    
}
