@extends('admin.layout.add')

@section('content')

<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Update Product</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('admin.all.product')}}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<form action="{{ route('admin.update.product')}}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="container-fluid">
                        <input type="hidden" value="{{$product->id}}" name="id">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="title">Title</label>
                                                    <input type="text" value="{{$product->title}}" name="title" id="title" class="form-control" required placeholder="Title">	
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="slug">slug</label>
                                                    <input type="text" value="{{$product->slug}}" name="slug" id="slug" class="form-control" required placeholder="slug">	
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description">Description</label>
                                                    <textarea name="description"  id="description" cols="30" rows="10" class="summernote" placeholder="Description">{{$product->description}}</textarea>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Media</h2>
                                        <div class="input-group mb-3">
                                            <input type="file" name="image[]" class="form-control" id="inputGroupFile02" multiple>
                                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Pricing</h2>								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="price">Price</label>
                                                    <input type="text" value="{{$product->price}}" name="price" id="price" class="form-control" required placeholder="Price">	
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="compare_price">Compare at Price</label>
                                                    <input type="text" value="{{$product->compare_price}}" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                                    <p class="text-muted mt-3">
                                                        To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                                    </p>	
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Inventory</h2>								
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="sku">SKU (Stock Keeping Unit)</label>
                                                    <input type="text" value="{{$product->sku}}" name="sku" id="sku" class="form-control" placeholder="sku" required>	
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="barcode">Barcode</label>
                                                    <input type="text" value="{{$product->barcode}}" name="barcode" id="barcode" class="form-control" placeholder="Barcode">	
                                                </div>
                                            </div>   
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" {{($product->track_qty == 'Yes')? 'checked' : ''}} >
                                                        <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="number" value="{{$product->qty}}" min="0" name="qty" id="qty" class="form-control" placeholder="Qty">	
                                                </div>
                                            </div>                                         
                                        </div>
                                    </div>	                                                                      
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Product status</h2>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control">
                                                <option {{($product->status == 1)? 'selected' : '' }} value="1">Active</option>
                                                <option {{($product->status == 0)? 'selected' : '' }} value="0">Block</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <div class="card">
                                    <div class="card-body">	
                                        <h2 class="h4  mb-3">Product category</h2>
                                        <div class="mb-3">
                                            <label for="category">Category</label>
                                            <select name="category" id="category" class="form-control">
                                                <option value="">choce Category</option>
                                                @foreach($categories as $category)
                                                <option {{($category->id == $product->category_id)? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category">Sub category</label>
                                            <select name="sub_category" id="sub_category" class="form-control">
                                                <option value="">choice Sub Category</option>
                                                @foreach($subcategories as $subcategory)
                                                    <option {{($subcategory->id == $product->sub_category_id)? 'selected' : ''}} value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Product brand</h2>
                                        <div class="mb-3">
                                            <select name="product_brand" id="product_brand" class="form-control">
                                                <option value="">choice Brand</option>
                                                @foreach($brands as $brand)
                                                <option {{($brand->id == $product->brand_id)? 'selected' : ''}} value="{{$brand->id}}">{{$brand->name}}</option>
                                               @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Featured product</h2>
                                        <div class="mb-3">
                                            <select name="is_featured" id="is_featured" class="form-control">
                                                <option {{($product->is_featured == 'No')? 'selected' : ''}} value="No">No</option>
                                                <option {{($product->is_featured == 'Yes')? 'selected' : ''}}  value="Yes">Yes</option>                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>                                 
                            </div>
                        </div>
						
						<div class="pb-5 pt-3">
							<button type="submit" class="btn btn-primary">Update</button>
							<a href="{{ route('admin.all.product')}}" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</div>
					</form>
					<!-- /.card -->
				</section>
				<!-- /.content -->

@endsection

@section('customjs')

<script>
	$('#title').on("input",(e)=>{
  	$('#slug').val(String(e.target.value||'').trim().toLowerCase().split(' ').filter(e=>!!e).join('-'));
  })


	$("#category").change(function(){
		var category_id = $(this).val();
		$.ajax({
			url: '{{ route("admin.product.subcategory")}}',
			type: 'get',
			data:{category_id:category_id},
			dataType: 'json',
			success: function(respose){
				//console.log(respose);
				$("#sub_category").find("option").not(":first").remove();
				$.each(respose["subcategories"], function(key,item){
					$("#sub_category").append(`<option value='${item.id}'>${item.name}</option>`)
				});
			},
			error: function(){
				console.log("Something went wrong");
			},
		});
	});

	// Map checkbox state to 'Yes' or 'No' for track_qty field
$('#track_qty').change(function() {
    var trackQtyValue = this.checked ? 'Yes' : 'No';
    $(this).val(trackQtyValue);
});
</script>
@endsection