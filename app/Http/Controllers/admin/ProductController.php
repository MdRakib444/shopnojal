<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
   public function index(){

   	$products = Product::all();


   	return view('admin.product.all_product', compact('products'));
   }

   public function create(){

   	$categories = Categorie::all();
   	$brands = Brand::all();

   	return view('admin.product.add_product', compact('categories', 'brands' ));
   }

   public function store(Request $request){

   	$validator = Validator::make($request->all(), [
        'title' => 'required',
        'slug' => 'required|unique:products',
        'price' => 'required',
        // 'category_id' => 'required',
        'sku' => 'required',
    ]);

    if ($validator->passes()) {
        $product = new Product();
        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->compare_price = $request->compare_price;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->brand_id = $request->product_brand;
        $product->is_featured = $request->is_featured;
        $product->sku = $request->sku;
        $product->barcode = $request->barcode;
        if ($request->track_qty === 'Yes' || $request->track_qty === 'No') {
    		$product->track_qty = $request->track_qty;
		} else {
    		// Handle validation error or set default value
    		$product->track_qty = 'Yes'; // Or set a default value
		}
        $product->qty = $request->qty;
        $product->save();

        return redirect()->route('admin.all.product');
    } else {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }
   }

  public function edit($id){
    $product = Product::findOrFail($id);
    $categories = Categorie::all();
    $brands = Brand::all();
    $subcategories = SubCategory::where('category_id', $product->category_id)->get();

    return view('admin.product.edit_product', compact('product', 'categories', 'brands', 'subcategories'));
  }

  public function update(Request $request){
    $pid = $request->id;

    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'slug' => 'required|unique:products,slug,'.$pid.',id',
        'price' => 'required',
        // 'category_id' => 'required',
        'sku' => 'required',
    ]);

    $product = Product::findOrFail($pid);
        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->compare_price = $request->compare_price;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->brand_id = $request->product_brand;
        $product->is_featured = $request->is_featured;
        $product->sku = $request->sku;
        $product->barcode = $request->barcode;
        if ($request->track_qty === 'Yes' || $request->track_qty === 'No') {
        $product->track_qty = $request->track_qty;
    } else {
        // Handle validation error or set default value
        $product->track_qty = 'Yes'; // Or set a default value
    }
        $product->qty = $request->qty;
        $product->save();

        return redirect()->route('admin.all.product');
  	
  }

  public function destroy($id)
  {
    // Find the category by its ID
    $product = Product::findOrFail($id);

    // Delete the category
    $product->delete();

    // Redirect back or to any other page
    return redirect()->route('admin.product.all_product')->with('success', 'Category deleted successfully.');
  }

}
