@section('title','Sign Up')
@extends('components.user-layout', ['activePage' => 'signUp'])
@section('content')
<div class="container-fluid px-0">
  <section class="xs-p-2 p-5 text-center overflow-hidden" style="">
    <div class="my-5 mx-md-5">
      <div class="row">
        <div class="col-md-8 mx-auto">
          <div class="card card-cascade narrower mt-2">
            <div class="view view-cascade gradient-card-header bg-primary p-2">
              <h5 class="mb-0 pb-3 pt-2">Sign Up</h5>
            </div>
            <div class="card-body">
              <div class="text-center text-danger h5-responsive" id="err">&nbsp;</div>
              <div class="text-center" style="color: #757575;">
                <div class="row">
                  <div class="col">
                    <div class="md-form md-outline">
                      <input type="text" id="first-name" class="form-control" maxlength="12">
                      <label for="first-name">First Name</label>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form md-outline">
                      <input type="text" id="last-name" class="form-control"  maxlength="12">
                      <label for="last-name">Last Name</label>
                    </div>
                  </div>
                </div>
    
                <div class="row">
                  <div class="col">
                    <div class="md-form md-outline mt-0">
                      <input type="text" id="user-email" class="form-control"  maxlength="50">
                      <label for="user-email">User Email</label>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form md-outline mt-0">
                      <input type="text" id="mobile-number" class="form-control" onkeypress="validateMobile(event)" maxlength="10">
                      <label for="mobile-number">Mobile Number</label>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="md-form md-outline mt-0">
                      <input type="password" id="password" class="form-control" maxlength="16">
                      <label for="password">Password</label>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form md-outline mt-0">
                      <input type="password" id="repeat-password" class="form-control" maxlength="16">
                      <label for="repeat-password">Repeat password</label>
                    </div>
                  </div>
                </div>
                
                <div class="text-center mb-2">
                  <a href="/sign-in">Already a user ? Sign in</a>
                </div>

                <div class="text-center">
                  <button type="button" class="btn btn-primary waves-effect" onclick="submitForm()">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  function submitForm(){
    var first_name      = $('#first-name').val();
    var last_name       = $('#last-name').val();
    var user_email      = $('#user-email').val();
    var mobile_number   = $('#mobile-number').val();
    var password        = $('#password').val();
    var repeat_password = $('#repeat-password').val();
    var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (first_name=='') {
      $('#err').html('Please enter first name')
      setTimeout(function(){ $('#err').html('&nbsp') },3500)
      $('#first-name').focus()
    } else if (last_name=='') {
      $('#err').html('Please enter last name')
      setTimeout(function(){ $('#err').html('&nbsp') },3500)
      $('#last-name').focus()
    } else if (user_email=='') {
      $('#err').html('Please enter user email')
      setTimeout(function(){ $('#err').html('&nbsp') },3500)
      $('#user-email').focus()
    } else if (regex.test(user_email)==false) {
      $('#err').html('Please enter valid email')
      setTimeout(function(){ $('#err').html('&nbsp') },3500)
      $('#user-email').focus()
    } else if (mobile_number=='') {
      $('#err').html('Please enter mobile number')
      setTimeout(function(){ $('#err').html('&nbsp') },3500)
      $('#mobile-number').focus()
    } else if (mobile_number.length!=10) {
      $('#err').html('Please enter valid mobile number')
      setTimeout(function(){ $('#err').html('&nbsp') },3500)
      $('#mobile-number').focus()
    } else if (password=='') {
      $('#err').html('Please enter password')
      setTimeout(function(){ $('#err').html('&nbsp') },3500)
      $('#password').focus()
    } else if (password.length<6) {
      $('#err').html('Pasword must be atleast 6 characters')
      setTimeout(function(){ $('#err').html('&nbsp') },3500)
      $('#password').focus()
    } else if (repeat_password=='') {
      $('#err').html('Please enter repeat password')
      setTimeout(function(){ $('#err').html('&nbsp') },3500)
      $('#repeat-password').focus()
    } else if (password!=repeat_password) {
      $('#err').html('Passwords are not matched')
      setTimeout(function(){ $('#err').html('&nbsp') },3500)
      $('#repeat-password').focus()
    } else{
      $.ajax({
        url: '/sign-up',
        method: 'POST',
        data: { first_name: first_name, last_name: last_name, user_email:user_email, mobile_number: mobile_number, password: password },
        success:function(response){
          if (response.success==true) {
            window.location='/sign-in';
          } else{
            $('#err').html(response.message )
            setTimeout(function(){ $('#err').html('&nbsp') },3500)
            $('#'+focus).focus()
          }
        }
      })
    }
  }

  function validateMobile(evt){
    var theEvent = evt || window.event;
    if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
    } else {
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
    }
    var regex = /[0-9]/;
    if(!regex.test(key)) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }
</script>
@endsection