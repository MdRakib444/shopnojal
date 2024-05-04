@extends('admin.layout.add')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('admin.all.categorie')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
<form id="categorieForm" action="{{ route('admin.store.categorie')}}" method="POST">
    @csrf
    <div class="card">
        <div class="card-body">								
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" autocomplete="name"required >
                        <p></p>
                    </div>	
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" autocomplete="off" required>	
                        <p></p>
                    </div>
                </div>	
                <div class="col-md-6">
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
        <a href="{{route('admin.all.categorie')}}" class="btn btn-outline-dark ml-3">Cancel</a>
    </div>
</form>

    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection


@section('customjs')

<script>


// $("#categorieForm").submit(function(event) {
//     event.preventDefault();

//     var formData = $(this).serialize();

//     $.ajax({
//         url: '{{ route("admin.store.categorie")}}',
//         type: 'post',
//         data: formData,
//         dataType: 'json',
//         success: function(response) {
//             if (response.status) {
//                 alert(response.message);
//                 // Optionally, redirect the user to another page after successful submission
//                 window.location.href = '{{ route("admin.all.categorie") }}';
//             } else {
//                 // Handle validation errors
//                 $.each(response.errors, function(key, value) {
//                     $("#" + key).addClass('is-invalid').siblings('p').addClass('is-invalid-feedback').html(value);
//                 });
//             }
//         },
//         error: function(jqXHR, exception) {
//             console.log("Something went wrong");
//         }
//     });
// });

  $('#name').on("input",(e)=>{
  	$('#slug').val(String(e.target.value||'').trim().toLowerCase().split(' ').filter(e=>!!e).join('-'));
  })


 //  $('#status').on("input",(e)=>{
 //  	const value = e.target.value;
 //  	/**
	// 1. Api call

 //  	*/
 //  	const sections= [
 //  		{
 //  			id:1,
 //  			name:'A'
 //  		},
 //  		{
 //  			id:2,
 //  			name:'B'
 //  		},
 //  		{
 //  			id:3,
 //  			name:'C'
 //  		},
 //  	];

 //  	const options = sections.map(section=>`<option value="${section.id}">${section.name}</option>`).join('\n');
 //  	console.log(options)
 //  	 $('#section').html(options);
 //  })


</script>
@endsection
