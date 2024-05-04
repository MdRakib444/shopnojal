@extends('admin.layout.add')

@section('content')

<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Brand</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('admin.all.brand')}}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
						<form action="{{ route('admin.store.brand')}}" method="POST">
						@csrf
						<div class="card">
							<div class="card-body">								
								<div class="row">
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" class="form-control" placeholder="Name">	
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="slug">Slug</label>
											<input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">	
										</div>
									</div>
									<div class="col-md-12">
                    					<div class="mb-3">
                        					<label for="status">Status</label>
                        					<select class="form-control" name="status" id="status" autocomplete="status">
                            					<option value="1">Active</option>
                            					<option value="0">Inactive</option>
                        					</select>
                    					</div>
               	 					</div>										
								</div>
							</div>							
						</div>
						<div class="pb-5 pt-3">
							<button type="submit" class="btn btn-primary">Create</button>
							<a href="{{ route('admin.all.brand')}}" class="btn btn-outline-dark ml-3">Cancel</a>
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