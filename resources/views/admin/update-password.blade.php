@section('title','Update Password')
@extends('components.admin-layout', ['activePage' => 'profile'])
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Update Password</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/admin">Home</a></li>
          <li class="breadcrumb-item active">Update Password</li>
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
        $results = DB::table('admin')
          ->select('id','password')
          ->where('id', Session::get('admin'))
          ->get();
        @endphp

        @foreach ($results as $result)
          <div class="form-group">
            <label>Current Password</label>
            <input type="hidden" id="id" class="form-control" value="{{ $result->id }}">
            <input type="hidden" id="old_password" class="form-control" value="{{ $result->password }}">
            <input type="password" id="current_password" class="form-control">
          </div>
          <div class="form-group">
            <label>New Password</label>
            <input type="password" id="new_password" class="form-control">
          </div>
          <div class="form-group">
            <label>Repeat Password</label>
            <input type="password" id="repeat_password" class="form-control">
          </div>
          <button class="btn btn-primary" onclick="updateProfile()">Update Profile</button>
        @endforeach
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function updateProfile(){
    var id                = $('#id').val();
    var old_password      = $('#old_password').val();
    var current_password  = $('#current_password').val();
    var new_password      = $('#new_password').val();
    var repeat_password   = $('#repeat_password').val();
    var prev_url          = '{{ url()->previous() }}';

    if (current_password=='') {
      $('#err').html('Please enter current password')
      setTimeout(function(){ $('#err').html('') },3500)
      $('#current_password').focus();
    } else if (new_password=='') {
      $('#err').html('Please enter new password')
      setTimeout(function(){ $('#err').html('') },3500)
      $('#new_password').focus();
    } else if (new_password.length<6) {
      $('#err').html('Password must be atleast 6 characters')
      setTimeout(function(){ $('#err').html('') },3500)
      $('#new_password').focus();
    } else if (repeat_password=='') {
      $('#err').html('Please enter repeat password')
      setTimeout(function(){ $('#err').html('') },3500)
      $('#repeat_password').focus();
    } else if (new_password!=repeat_password) {
      $('#err').html('Passwords are not matched')
      setTimeout(function(){ $('#err').html('') },3500)
      $('#repeat_password').focus();
    } else if (current_password!=old_password) {
      $('#err').html('Wrong current password')
      setTimeout(function(){ $('#err').html('') },3500)
      $('#current_password').focus();
    } else{
      $.ajax({
        url: '/update-admin-password',
        method: 'POST',
        data: { id:id, new_password: new_password },
        success:function(response){
          if(response.success==true){
            swal({
              title: "Success!",
              text: "Password updated successfully...",
              icon: "success",
              button: false,
            });
            setTimeout(function(){ window.location='./index'; },3500)
          }
        }
      })
    }
  }
</script>
@endsection