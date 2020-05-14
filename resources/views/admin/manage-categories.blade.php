@section('title','Manage Categories')
@extends('components.admin-layout', ['activePage' => 'categories'])
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Manage Categories</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Manage Categories</li>
        </ol>
      </div>
      <div class="col-12 mt-2">
        <a href="./add-category" class="btn btn-primary float-right">Add Category</a>
      </div>
    </div>
    
  </div>
</div>

<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body p-4">
        <table class="table table-bordered table-hover" id="table">
          <thead>
            <tr>
              <td>S. No.</td>
              <td>Category</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            @php
            $categories = DB::table('categories')
              ->orderBy('id','DESC')
              ->get();

            $count = 0;
            @endphp
            
            @foreach ($categories as $category)
              @php $count++; @endphp
              <tr>
                <td>{{ $count }}</td>
                <td>{{ $category->category_name }}</td>
                <td>
                  <a href="./update-category/{{ str_replace(' ','-',$category->category_name) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                  @if($category->category_name=='Videos')
                    <button class="btn btn-danger" disabled=""><i class="fa fa-trash"></i></button>
                    @else
                    <button class="btn btn-danger" onclick="deleteCategory('{{ $category->id }}')"><i class="fa fa-trash"></i></button>
                  @endif
                  
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

  function deleteCategory(id){
    swal({
      title: "Are you sure?",
      text: "You want to delete this category",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: '/delete-category',
          method: 'POST',
          data: { id: id },
          success:function(response){
            swal({
              title: "Success!",
              text: "Category deleted successfully...",
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
