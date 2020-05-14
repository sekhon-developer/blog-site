<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>Site Name | @yield('title')</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('user/plugins/font-awesome/css/all.css') }}">
  <link rel="stylesheet" href="{{ url('user/plugins/site-font/font-family.css') }}">
  <link rel="stylesheet" href="{{ url('user/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('user/css/mdb.min.css') }}">
  <link rel="stylesheet" href="{{ url('user/css/style.css') }}">

  <!-- jquery -->
  <script type="text/javascript" src="{{ url('user/js/jquery.min.js') }}"></script>
  <!-- sweet alert -->
  <script type="text/javascript" src="{{ url('user/plugins/sweetalert/sweetalert.min.js') }}"></script>

  <!-- ajax setup -->
  <script type="text/javascript">
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
  </script>

  <!-- Site translator -->
  <script src="{{ url('user/plugins/translator/jquery.cookie.js') }}"></script>  
    <style type="text/css">
    .goog-te-banner-frame.skiptranslate{display:none!important;}
    body{top:0px!important;}
    </style>
</head>
<body>
  <script type="text/javascript">
    var url = window.location.href;
    var language = url.split('?lang=')[1];
    $.cookie('googtrans', '/en/'+language);
    </script>
    <div id="google_translate_element" style="display: none;"></div>

    <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
    }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<nav class="navbar navbar-expand-lg navbar-dark primary-color lighten-1">
  <a class="navbar-brand" href="#">Site Logo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
    aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ $activePage=='home' ? 'active' : '' }}">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item dropdown {{ $activePage=='categories' ? 'active' : '' }}">
        <a class="nav-link dropdown-toggle" id="categories" data-toggle="dropdown">Categories
        </a>
        <div class="dropdown-menu dropdown-secondary" aria-labelledby="categories">
          @php
            $categories = DB::table('categories')->select('category_name')->orderBy('id', 'DESC')->get();
          @endphp

          @if(sizeof($categories) != 0)
            @foreach ($categories as $category)
              <a class="dropdown-item" href="#">{{ $category->category_name }}</a>
            @endforeach
          @else
            <a class="dropdown-item" href="#">No Categories found</a>
          @endif   
          </div>
      </li>
      <li class="nav-item {{ $activePage=='search' ? 'active' : '' }}">
        <a class="nav-link" href="/search">Search</a>
      </li>
      <li class="nav-item {{ $activePage=='favorites' ? 'active' : '' }}">
        <a class="nav-link" href="#">Favorites</a>
      </li>
      <li class="nav-item {{ $activePage=='about-us' ? 'active' : '' }}">
        <a class="nav-link" href="/about-us">About Us</a>
      </li>
      <li class="nav-item {{ $activePage=='contact-us' ? 'active' : '' }}">
        <a class="nav-link" href="/contact-us">Contact Us</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item avatar dropdown">
        <a class="nav-link dropdown-toggle" id="language" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Language</a>
          <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary" aria-labelledby="language">
            <a class="dropdown-item" href="?lang=en">English</a>
            <a class="dropdown-item" href="?lang=hi">Hindi</a>
          </div>
        </li>
      @if(Session::get('user')=='')
        <li class="nav-item {{ $activePage=='signIn' ? 'active' : '' }}">
          <a href="/sign-in" class="nav-link">Sign In</a>
        </li>
        <li class="nav-item {{ $activePage=='signUp' ? 'active' : '' }}">
          <a href="/sign-up" class="nav-link">Sign Up</a>
        </li>
        @else
        <li class="nav-item avatar dropdown">
          <!-- <a class="nav-link dropdown-toggle" id="user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="/images/avatar.jpg" class="rounded-circle z-depth-0" alt="avatar image" style="max-height: 45px">
          </a> -->
          <a class="nav-link dropdown-toggle" id="user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php
            $results = DB::table('users')->select('first_name','last_name')->where('id', Session::get('user'))->get();
            foreach ($results as $result){
              echo $result->first_name.' '.$result->last_name;
            } ?>
          </a>
          <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary" aria-labelledby="user">
            <a class="dropdown-item" href="#">View Profile</a>
            <a class="dropdown-item" href="/sign-out">Sign Out</a>
          </div>
        </li>
      @endif
      
    </ul>
  </div>
</nav>

@yield('content')

<div class="bg-primary">
  <div class="text-light text-center p-3">
    © Site Name. All rights reserved.
  </div>
</div>

  
  
  <script type="text/javascript" src="{{ url('user/js/popper.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('user/js/bootstrap.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('user/js/mdb.min.js') }}"></script>
</body>
</html>
