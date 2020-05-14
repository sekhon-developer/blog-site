<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Blog Site | Admin | Sign In</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <link rel="stylesheet" href="{{ url('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ url('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('admin/css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <script src="{{ url('admin/plugins/jquery/jquery.min.js') }}"></script>
  <script type="text/javascript">
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    })
  </script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Admin</b></a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <h5 class="text-danger text-center" id="err"></h5>
      <div class="input-group mb-3">
        <input type="text" id="email" class="form-control" placeholder="Email">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="password" id="password" class="form-control" placeholder="Password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
        
      <button type="submit" class="btn btn-primary btn-block" onclick="submit()">Sign In</button>
          
    </div>
  </div>
</div>

<script type="text/javascript">
  function submit(){
    var email = $('#email').val();
    var password = $('#password').val();
    var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (email=='') {
      $('#err').html('Please enter email')
      $('#email').focus()
      setTimeout(function(){ $('#err').html('') },3500)
    } else if (regex.test(email)==false) {
      $('#err').html('Please enter valid email')
      $('#email').focus()
      setTimeout(function(){ $('#err').html('') },3500)
    } else if (password=='') {
      $('#err').html('Please enter password')
      $('#password').focus()
      setTimeout(function(){ $('#err').html('') },3500)
    } else if(password.length<6){
      $('#err').html('Password must be atleast 6 characters')
      $('#password').focus()
      setTimeout(function(){ $('#err').html('') },3500)
    } else{
      $.ajax({
        url: '/admin-sign-in',
        method: 'POST',
        data: { email: email, password: password },
        success:function(response){
          if(response.success==true){
            window.location='./index';
          } else{
            $('#err').html(response.message)
            $('#password').focus()
            setTimeout(function(){ $('#err').html('') },4500)
          }
        }
      })
    }
  }
</script>

<script src="{{ url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('admin/js/adminlte.min.js') }}"></script>
</body>
</html>
