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
   					 ->where('sub_categories.slug', $subcategorySlug)
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

    public function vegetable(){

    	$subcategorySlug = 'fresh-vegetables';

		
		$product_vege = Product::select('products.*', 'sub_categories.name as subcategory_name')
   					 ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
   					 ->where('sub_categories.slug', $subcategorySlug)
    				 ->get();

    	return view('front.productPage.vegetable', compact('product_vege'));
    }

    public function fruit(){
    	$subcategorySlug = 'fresh-fruits';

		
		$product_fruit = Product::select('products.*', 'sub_categories.name as subcategory_name')
   					 ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
   					 ->where('sub_categories.slug', $subcategorySlug)
    				 ->get();

    	return view('front.productPage.fruits', compact('product_fruit'));
    }

    public function fish(){
    	$subcategorySlug = 'fish';

		
		$product_fish = Product::select('products.*', 'sub_categories.name as subcategory_name')
   					 ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
   					 ->where('sub_categories.slug', $subcategorySlug)
    				 ->get();

    	return view('front.productPage.fish', compact('product_fish'));
    }

    public function meat(){

    	$subcategorySlug = 'meat';

    	$product_meat = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.meat', compact('product_meat'));
    }

    public function premium_meat(){

    	$subcategorySlug = 'premium-meat';
    	$product_prmeat = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.pre_meat', compact('product_prmeat'));
    }

    public function premium_fish(){

    	$subcategorySlug = 'premium_fish';
    	$product_prefish = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id' , '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.pre_fish', compact('product_prefish'));
    }

    public function spices(){

    	$subcategorySlug = 'spices';

    	$product_spices = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.spices', compact('product_spices'));
    }

    public function saltSugar(){


    	$subcategorySlug = 'salt-&-sugar';

    	$product_saltSugar = Product::select('products.*', 'sub_categories.name as subcategory_name')
    						->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    						->where('sub_categories.slug', $subcategorySlug)
    						->get();

    	return view('front.productPage.salt_sugar', compact('product_saltSugar'));
    }

    public function rice(){

    	$subcategorySlug = 'rice';

    	$product_rice = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.rice', compact('product_rice'));
    }

    public function dal(){

    	$subcategorySlug = 'dal-or-lentis';

    	$product_dal = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.dal', compact('product_dal'));
    }

    public function readyMix(){

    	$subcategorySlug = 'ready-mix';

    	$product_readyMix = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.ready_mix', compact('product_readyMix'));
    }

    public function shemaiSuji(){

    	$subcategorySlug = 'shemai-&-suji';

    	$product_shemaiSuji = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.shemai_suji', compact('product_shemaiSuji'));
    }

    public function oil(){

    	$subcategorySlug = 'oil';

    	$product_oil = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.oil', compact('product_oil'));
    }


    public function ghee(){

    	$subcategorySlug = 'ghee';

    	$product_ghee = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.ghee', compact('product_ghee'));
    }

    public function tomatoSauces(){

    	$subcategorySlug = 'tomato-sauces';

    	$product_tomatoSauces = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.tomato_sauces', compact('product_tomatoSauces'));
    }

    public function cookingSauces(){

    	$subcategorySlug = 'cooking-sauces';

    	$product_cookingSauces = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.cooking_sauces', compact('product_cookingSauces'));
    }

    public function pickles(){

    	$subcategorySlug = 'pickles';

    	$product_pickles = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.pickles', compact('product_pickless'));
    }

    public function powderMilk(){

    	$subcategorySlug = 'powder-milk';

    	$product_powderMilk = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.powder_milk', compact('product_powderMilk'));
    }

    public function liquidMilk(){

    	$subcategorySlug = 'liquid-uht-milk';

    	$product_liquidMilk = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.liquid_milk', compact('product_liquidMilk'));
    }

    public function sweets(){

    	$subcategorySlug = 'sweets';

    	$product_sweets = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.sweets', compact('product_sweets'));
    }

    public function condensedMilk(){

    	$subcategorySlug = 'condensed-milk';

    	$product_condensedMilk = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.condensed_milk', compact('product_condensedMilk'));
    }

    public function eggs(){

    	$subcategorySlug = 'eggs';

    	$product_eggs = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.eggs', compact('product_eggs'));
    }

    public function bread(){

    	$subcategorySlug = 'breads';

    	$product_bread = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.bread', compact('product_bread'));
    }

    public function teaCoffee(){

    	$subcategorySlug = 'tea-&-coffee';

    	$product_teaCoffee = Product::select('products.*', 'sub_categories.name as subcategory_name')
    					->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
    					->where('sub_categories.slug', $subcategorySlug)
    					->get();

    	return view('front.productPage.tea_coffee', compact('product_teaCoffee'));
    }
}
