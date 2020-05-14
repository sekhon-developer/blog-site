@section('title','Update Category')
@extends('components.admin-layout', ['activePage' => 'categories'])
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-4">
        <h1><a href="{{ url()->previous() }}" class="text-dark"><i class="fa fa-arrow-left"></i></a></h1>
      </div>
      <div class="col-sm-4">
        <h1 class="m-0 text-dark">Update Category</h1>
      </div>
      <div class="col-sm-4">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="./index">Home</a></li>
          <li class="breadcrumb-item"><a href="./manage-categories">Manage Categories</a></li>
          <li class="breadcrumb-item active">Update Category</li>
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
        @php
        $category = str_replace('-',' ',$category);
        $categories = DB::table('categories')
          ->where('category_name', $category)
          ->get();
        @endphp
        @foreach($categories as $category)
          <div class="form-group">
            <label>Category Name</label>
            <input type="text" id="category_name" class="form-control" value="{{ $category->category_name }}">
          </div>
        @endforeach
        <button class="btn btn-primary" onclick="updateCategory('{{ $category->id }}')">Submit</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function updateCategory(id){
    var category_name = $('#category_name').val();
    if (category_name=='') {
      $('#err').html('Please enter category name');
      $('#category_name').focus();
      setTimeout(function(){ $('#err').html('') },3500);
    } else{
      console.log(id)
      $.ajax({
        url: '/update-category',
        method: 'POST',
        data: { id: id, category_name: category_name },
        success:function(response){
          if (response.success==true) {
            swal({
              title: "Success!",
              text: "Category updated successfully...",
              icon: "success",
              button: false,
            });
            setTimeout(function(){ window.location='../manage-categories'; })
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