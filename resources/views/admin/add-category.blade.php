@section('title','Add Category')
@extends('components.admin-layout', ['activePage' => 'categories'])
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-4">
        <h1><a href="{{ url()->previous() }}" class="text-dark"><i class="fa fa-arrow-left"></i></a></h1>
      </div>
      <div class="col-sm-4">
        <h1 class="m-0 text-dark">Add Category</h1>
      </div>
      <div class="col-sm-4">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="./index">Home</a></li>
          <li class="breadcrumb-item"><a href="./manage-categories">Manage Categories</a></li>
          <li class="breadcrumb-item active">Add Category</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <h5 class="text-center text-danger" id="err"></h5>
        <div class="form-group">
          <label>Category Name</label>
          <input type="text" id="category_name" class="form-control">
        </div>
        <button class="btn btn-primary" onclick="addCategory()">Submit</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function addCategory(){
    var category_name = $('#category_name').val();
    if (category_name=='') {
      $('#err').html('Please enter category name');
      $('#category_name').focus();
      setTimeout(function(){ $('#err').html('') },3500);
    } else{
      $.ajax({
        url: '/add-category',
        method: 'POST',
        data: { category_name: category_name },
        success:function(response){
          if (response.success==true) {
            swal({
              title: "Success!",
              text: "Category added successfully...",
              icon: "success",
              button: false,
            });
            setTimeout(function(){ window.location='./manage-categories'; })
          } else{
            $('#err').html(response.message);
            $('#category_name').focus();
            setTimeout(function(){ $('#err').html('') },3500);
          }
        }
      })
    }
  }
</script>
@endsection