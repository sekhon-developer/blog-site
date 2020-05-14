@section('title','Contact Us')
@extends('components.user-layout', ['activePage' => 'contact-us'])
@section('content')
<div class="container-fluid">
  <section class="my-5">
    <h2 class="h1-responsive font-weight-bold text-center my-5">Contact us</h2>
    <p class="text-center w-responsive mx-auto pb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam eum porro a pariatur veniam.</p>

    <div class="row">
      <div class="col-lg-5 mb-lg-0 mb-4">
        <div class="card card-cascade narrower mt-2">
          <div class="view view-cascade gradient-card-header bg-primary p-0">
            <h5 class="mb-0 pb-3 pt-2">Write to us:</h5>
          </div>
          <div class="card-body">
            <p class="dark-grey-text">We'll write rarely, but only the best content.</p>
            <div class="md-form">
              <div class="md-form md-outline">
                <input type="text" id="form1" class="form-control">
                <label for="form1">Enter Full Name</label>
              </div>
            </div>
            <div class="md-form md-outline">
                <input type="text" id="form1" class="form-control">
                <label for="form1">Enter Email Address</label>
              </div>
            <div class="md-form md-outline">
              <textarea id="description" class="md-textarea form-control"></textarea>
              <label for="description">Enter Description</label>
            </div>
            <div class="text-center">
              <button class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <div id="map-container-section" class="z-depth-1-half map-container-section mb-4" style="height: 400px">
          <iframe src="https://maps.google.com/maps?q=Manhatan&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="row text-center">
          <div class="col-md-4">
            <a class="btn-floating bg-primary accent-1">
              <i class="fas fa-map-marker-alt"></i>
            </a>
            <p>New York, 94126</p>
            <p class="mb-md-0">United States</p>
          </div>
          <div class="col-md-4">
            <a class="btn-floating bg-primary accent-1">
              <i class="fas fa-phone"></i>
            </a>
            <p>+ 01 234 567 89</p>
            <p class="mb-md-0">Mon - Fri, 8:00-22:00</p>
          </div>
          <div class="col-md-4">
            <a class="btn-floating bg-primary accent-1">
              <i class="fas fa-envelope"></i>
            </a>
            <p>info@gmail.com</p>
            <p class="mb-0">sale@gmail.com</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection