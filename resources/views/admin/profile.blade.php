@section('title','Profile')
@extends('components.admin-layout', ['activePage' => 'profile'])
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Profile</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/admin">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </div>
      <div class="col-12">
        <a href="./update-password" class="btn btn-primary float-right mt-2">Update Password</a>
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
        $results = DB::table('admin')
          ->where('id', Session::get('admin'))
          ->get();
        @endphp

        @foreach ($results as $result)
          <div class="form-group">
            <label>First Name</label>
            <input type="hidden" id="id" class="form-control" value="{{ $result->id }}">
            <input type="text" id="first_name" class="form-control" value="{{ $result->first_name }}">
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" id="last_name" class="form-control" value="{{ $result->last_name }}">
          </div>
          <div class="form-group">
            <label>Email Address</label>
            <input type="text" id="email" class="form-control" value="{{ $result->email }}">
          </div>
          <button class="btn btn-primary" onclick="updateProfile()">Update Profile</button>
        @endforeach
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function updateProfile(){
    var id = $('#id').val();
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var email = $('#email').val();
    var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    var prev_url = '{{ url()->previous() }}';

    if (first_name=='') {
      $('#err').html('Please enter first name')
      setTimeout(function(){ $('#err').html('') },3500)
      $('#first_name').focus();
    } else if (last_name=='') {
      $('#err').html('Please enter last name')
      setTimeout(function(){ $('#err').html('') },3500)
      $('#last_name').focus();
    } else if (email=='') {
      $('#err').html('Please enter email address')
      setTimeout(function(){ $('#err').html('') },3500)
      $('#email').focus();
    } else if (regex.test(email)==false) {
      $('#err').html('Please enter valid email')
      setTimeout(function(){ $('#err').html('') },3500)
      $('#email').focus();
    } else{
      $.ajax({
        url: '/update-admin-profile',
        method: 'POST',
        data: { id:id, first_name: first_name, last_name: last_name, email: email },
        success:function(response){
          if(response.success==true){
            swal({
              title: "Success!",
              text: "Profile updated successfully...",
              icon: "success",
              button: false,
            });
            setTimeout(function(){ window.location=prev_url; },3500)
          }
        }
      })
    }
  }
</script>
@endsection