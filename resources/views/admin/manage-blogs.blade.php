@section('title','Manage Blogs')
@extends('components.admin-layout', ['activePage' => 'blogs'])
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Blogs</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Manage Blogs</li>
        </ol>
      </div>
      <div class="col-12 mt-2">
        <a href="./add-blog" class="btn btn-primary float-right">Add Blog</a>
      </div>
    </div>
  </div>
</div>

<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-hover" id="table" style="overflow-x: scroll;">
          <thead>
            <tr>
              <td>S. No.</td>
              <td>Category</td>
              <td>Blog Title</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            @php
            $blogs = DB::table('blogs')
              ->select(['blogs.id', 'blogs.title', 'blogs.image', 'categories.category_name'])
              ->join('categories', 'blogs.category', '=', 'categories.id')
              ->orderBy('blogs.id','DESC')
              ->get();

            $count = 0;
            @endphp
            
            @foreach ($blogs as $blog)
              @php $count++; @endphp
              <tr>
                <td>{{ $count }}</td>
                <td>{{ $blog->category_name }}</td>
                <td>{{ $blog->title }}</td>
                <td>
                  <a href="./update-blog/{{ str_replace(' ','-',$blog->title) }}" class="btn btn-primary form-group"><i class="fa fa-edit"></i></a>
                  <button class="btn btn-danger form-group" onclick="deleteBlog('{{ $blog->id }}','{{ $blog->image }}')"><i class="fa fa-trash"></i></button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(function(){
    $('#table').DataTable()
  })

  function deleteBlog(id, image){
    swal({
      title: "Are you sure?",
      text: "You want to delete this blog",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: '/delete-blog',
          method: 'POST',
          data: { id: id, image: image },
          success:function(response){
            swal({
              title: "Success!",
              text: "Blog deleted successfully...",
              icon: "success",
              button: false,
            })
            setTimeout(function(){ location.reload() },3500)
          }
        })
      }
    })
  }
</script>
@endsection