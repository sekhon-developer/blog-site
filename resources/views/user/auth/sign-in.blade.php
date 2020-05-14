@section('title','Sign In')
@extends('components.user-layout', ['activePage' => 'signIn'])
@section('content')
<div class="container-fluid px-0">
  <section class="xs-p-2 p-5 text-center overflow-hidden" style="">
    <div class="my-5 mx-md-5">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card card-cascade narrower mt-2">
            <div class="view view-cascade gradient-card-header bg-primary p-2">
              <h5 class="mb-0 pb-3 pt-2">Sign In</h5>
            </div>
            <div class="card-body">
              <div class="text-center text-danger h5-responsive" id="err">&nbsp;</div>

              <div class="text-center" style="color: #757575;">
                <div class="md-form md-outline">
                  <input type="text" id="email" class="form-control"  maxlength="50">
                  <label for="email">User Email</label>
                </div>
                <div class="md-form md-outline">
                  <input type="password" id="password" class="form-control" maxlength="16">
                  <label for="password">Enter Password</label>
                </div>

                <div class="row mb-2">
                  <div class="col-sm-12">
                    <a href="#" class="form-text text-right xs-text-center blue-text">Recover Password</a>
                  </div>
                </div>
                
                <div class="text-center mb-2">
                  <a href="/sign-up">New user ? Sign Up</a>
                </div>

                <div class="text-center">
                  <button type="button" class="btn btn-primary waves-effect" onclick="submitForm()">Sign In</button>
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
    var email = $('#email').val();
    var password = $('#password').val();
    var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (email=='') {
      $('#err').html('Please enter user email')
      setTimeout(function(){ $('#err').html('&nbsp') },3500)
      $('#email').focus()
    } else if(regex.test(email)==false){
      $('#err').html('Please enter valid email')
      setTimeout(function(){ $('#err').html('&nbsp') },3500)
      $('#email').focus()
    } else if (password=='') {
      $('#err').html('Please enter password')
      setTimeout(function(){ $('#err').html('&nbsp') },3500)
      $('#password').focus()
    } else{
      $.ajax({
        url: '/sign-in',
        method: 'POST',
        data: { email: email, password: password },
        success:function(response){
          if (response.success==true) {
            window.location='/';
          } else{
            $('#err').html(response.message)
            setTimeout(function(){ $('#err').html('&nbsp') },3500)
            $('#password').focus()
          }
        }
      })
    }
  }
</script>
@endsection