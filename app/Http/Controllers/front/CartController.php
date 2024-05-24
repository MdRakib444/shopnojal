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
use Gloudemans\Shoppingcart\Facades;

class CartController extends Controller
{
    // CartController.php
	public function addToCart(Request $request) {
    	$product = Product::find($request->id);

    	if($product == null){
    		return response()->json([
    			'status' => false,
    			'message' => 'Recode not found'
    		]);
    	}
    	$id = $request->input('id');
    	// Implement your add-to-cart logic here
    	return response()->json(['message' => 'Item added to cart successfully']);
	}


    public function cart(){

    	return view('front.cart');

    }
}
