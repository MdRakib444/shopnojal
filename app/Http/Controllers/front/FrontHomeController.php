<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;


class FrontHomeController extends Controller
{
    
    public function index(){

    	$categories = Categorie::all();
    	$products = Product::select('products.*', 'sub_categories.name as sub_category_name')
    				->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    				->inRandomOrder()
    				->take(10)
    				->get();

    	$subcategorySlug = 'fresh-vegetables';

		
		$product_vege = Product::select('products.*', 'sub_categories.name as subcategory_name')
   					 ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
   					 ->where('products.is_featured', 'YES')
    				 ->get();

    	$subcategorySlug = 'fish';

		
		$product_fish = Product::select('products.*', 'sub_categories.name as subcategory_name')
   					 ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
   					 ->where('sub_categories.slug', $subcategorySlug)
    				 ->get();

    	$subcategorySlug = 'meat';

		
		$product_meat = Product::select('products.*', 'sub_categories.name as subcategory_name')
   					 ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
   					 ->where('sub_categories.slug', $subcategorySlug)
    				 ->get();


    	return view('front.index', compact('products','product_vege', 'product_fish', 'product_meat' , 'categories'));
    }

    public function products(Request $request, $categorySlug = null, $subCategorySlug = null, $brandSlug = null){
    // Debug: Log route parameters
    \Log::info("Category Slug: $categorySlug, Subcategory Slug: $subCategorySlug, Brand Slug: $brandSlug");

    // Fetch all brands
    $brands = Brand::where('status', 1)->get();

    // Fetch products with their associated subcategories
    $products = Product::with('subCategory')->where('status', 1);

    // Debug: Log SQL query
    \Log::info($products->toSql());

    // Filter products by category if provided
    if (!empty($categorySlug)) {
        $category = Categorie::where('slug', $categorySlug)->first();
        if ($category) {
            $products->where('category_id', $category->id);
        }
    }

    // Filter products by subcategory if provided
    if (!empty($subCategorySlug)) {
        // Assuming the subcategory slug is unique across all categories
        $subCategory = SubCategory::where('slug', $subCategorySlug)->first();
        if ($subCategory) {
            $products->where('sub_category_id', $subCategory->id);
        }
    }

    // Filter products by brand if provided
    if (!empty($brandSlug)) {
        // Corrected to query the Brand model
        $brand = Brand::where('slug', $brandSlug)->first();
        if ($brand) {
            $products->where('brand_id', $brand->id);
        }
    }

    // Debug: Log SQL query after filtering
    \Log::info($products->toSql());

    // Retrieve the filtered products
    $products = $products->orderBy('id', 'DESC')->get();

    // Pass the data to the view
    return view('front.productPage.vegetable', compact('products', 'category', 'subCategory', 'brands'));
}



}
