@section('title','Add Blog')
@extends('components.admin-layout', ['activePage' => 'blogs'])
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-4">
        <h1><a href="{{ url()->previous() }}" class="text-dark"><i class="fa fa-arrow-left"></i></a></h1>
      </div>
      <div class="col-sm-4">
        <h1 class="m-0 text-dark">Add Blog</h1>
      </div>
      <div class="col-sm-4">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="./index">Home</a></li>
          <li class="breadcrumb-item"><a href="./manage-blogs">Manage Blogs</a></li>
          <li class="breadcrumb-item active">Add Blog</li>
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
          <label>Select Category</label>
          <select name="category" class="form-control" onchange="category()">
            <option value="" selected="" disabled="">Select Category</option>
            @php
            $categories = DB::table('categories')
              ->orderBy('id','DESC')
              ->get();
            @endphp

            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Blog Title</label>
          <input type="text" name="title" class="form-control" maxlength="250">
        </div>
        <div class="form-group" id="blog-image_">
          <label>Blog Image</label>
          <div class="custom-file">
            <input type="file" name="image" id="image" class="custom-file-input" accept="image/*">
            <label class="custom-file-label" for="image">Choose Image</label>
          </div>
          <div id="blog-image"></div>
        </div>
        <div class="form-group" id="video-link" style="display: none;">
          <label>Youtube Video Link</label>
          <input type="text" name="video" class="form-control">
        </div>
        <div class="form-group">
          <label>Blog Description</label>
          <textarea name="description" class="editor" placeholder="Enter Blog Description"></textarea>
        </div>
        <button class="btn btn-primary" onclick="addBlog()">Submit</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(function () {
    $('.editor').summernote({
      minHeight: '200px'
    })
  })

  function category(){
    var category = $('select[name=category]').val();
    if (category=='4') {
      $('#video-link').show();
      $('#blog-image_').hide();
    } else{
      $('#video-link').hide();
      $('#blog-image_').show();
    }
  }

  function addBlog(){
    var category    = $('select[name=category]').val();
    var title       = $('input[name=title]').val();
    var image       = $('#image').val();
    var video       = $('input[name=video]').val();
    var description = $('textarea[name=description]').val();

    if (category==null) {
      $('#err').html('Please select category');
      $('select[name=category]').focus();
      setTimeout(function(){ $('#err').html('') },3500);
    } else if (title=='') {
      $('#err').html('Please enter blog title');
      $('input[name=title]').focus();
      setTimeout(function(){ $('#err').html('') },3500);
    } else if (category!='4' && image=='') {
      $('#err').html('Please select blog image');
      $('#image').focus();
      setTimeout(function(){ $('#err').html('') },3500);
    } else if (category=='Videos' && video=='') {
      $('#err').html('Please enter youtube video link');
      $('#image').focus();
      setTimeout(function(){ $('#err').html('') },3500);
    } else if (description=='') {
      $('#err').html('Please enter blog description');
      $('textarea[name=description]').focus();
      setTimeout(function(){ $('#err').html('') },3500);
    } else{
      var fd = new FormData();
      if (category!=4) {
        var image = $('#image')[0].files[0];
        fd.append('image',image);
        fd.append('video','');
      } else{
        fd.append('image','');
        fd.append('video',video);
      }
      
      fd.append('category',category);
      fd.append('title',title);
      fd.append('description',description);

      $.ajax({
        url: '/add-blog',
        method: 'POST',
        data: fd,
        contentType: false,
        processData: false,
        success:function(response){
          if (response.success==true) {
            swal({
              title: "Success!",
              text: "Blog added successfully...",
              icon: "success",
              button: false,
            });
            setTimeout(function(){ window.location='./manage-blogs'; },3500)
          } else{
            $('#err').html(response.message);
            $('#category_name').focus();
            setTimeout(function(){ $('#err').html('') },3500);
          }
        }
      })
    }
  }

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
            
      reader.onload = function (e) {
        $('#blog-image').html('<div class="row mt-4"><div class="col-3"><img src="'+e.target.result+'" class="img-fluid"></div></div>')
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
    
  $("#image").change(function(){
    readURL(this);
    $('#blog-image').html('')
  });
</script>
@endsection