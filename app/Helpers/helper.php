<?php
use App\Models\Categorie;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;
function getCategories(){
	return Categorie::orderBy('name','ASC')
	->with('sub_category')
	->where('status',1)
	->get();
}

function getBrand(){
	return Brand::orderBy('name','ASC')
			->where('status',1)
			->get();
}

?>