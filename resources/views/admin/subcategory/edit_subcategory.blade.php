@extends('admin.layout.add')

@section('content')

<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Sub Category</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('admin.all.subcategory')}}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<form action="{{ route('admin.update.subcategory')}}" method="POST">
					@csrf
					<div class="container-fluid">
						<div class="card">
							<input type="hidden" name="id" value="{{$subcategories->id}}">
							<div class="card-body">								
								<div class="row">
                                    <div class="col-md-6">
										<div class="mb-3">
											<label for="name">Category</label>
											<select name="category" id="category" class="form-control">
												@foreach($categories as $category)
                                                <option {{($subcategories->category_id == $category->id)? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                               
                                            </select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Name</label>
											<input type="text" name="name" value="{{$subcategories->name}}" id="name" class="form-control" placeholder="Name" required>	
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="slug">Slug</label>
											<input type="text" name="slug" value="{{$subcategories->slug}}" id="slug" class="form-control" placeholder="Slug" required>	
										</div>
									</div>

									<div class="col-md-6">
										<div class="mb-3">
											<label for="status">Status</label>
											<select name="status" id="status" class="form-control">
                                                <option {{($subcategories->status == 1)? 'selected' : '' }} value="1"> Active</option>
                                                <option {{($subcategories->status == 0)? 'selected' : '' }} value="0"> Inactive</option>
                                            </select>
										</div>
									</div>									
								</div>
							</div>							
						</div>
						<div class="pb-5 pt-3">
							<button type="submit" class="btn btn-primary">Update</button>
							<a href="{{ route('admin.all.subcategory')}}" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</div>
					</form>
					<!-- /.card -->
				</section>
				<!-- /.content -->

@endsection

@section('customjs')

<script>
	$('#name').on("input",(e)=>{
  	$('#slug').val(String(e.target.value||'').trim().toLowerCase().split(' ').filter(e=>!!e).join('-'));
  })
</script>
@endsection