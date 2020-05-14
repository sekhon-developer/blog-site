@section('title','Home')
@extends('components.user-layout', ['activePage' => 'home'])
@section('content')
<script type="text/javascript" src="{{ url('user/js/script.js') }}"></script>

@php
$auth = Session::get('user')
@endphp

<!-- Social media share popup -->
<div class="modal fade" id="socialShare" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
      <div class="modal-header darken-3 white-text bg-primary">
        <h4 class="title"><i class="fas fa-users"></i> Share with friends</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <div class="modal-body mb-0 text-center">
        <a type="button" class="btn-floating btn-lg bg-primary" data-toggle="tooltip" title="Copy to clipboard"><i class="far fa-copy"></i></a>

        <a type="button" class="btn-floating btn-fb" data-toggle="tooltip" title="Share on facebook"><i class="fab fa-facebook-f"></i></a>

        <a type="button" class="btn-floating btn-tw" data-toggle="tooltip" title="Share on twitter"><i class="fab fa-twitter"></i></a>

        <a type="button" class="btn-floating btn-gplus" data-toggle="tooltip" title="Share on google"><i class="fab fa-google-plus-g"></i></a>

        <a type="button" class="btn-floating btn-ins" data-toggle="tooltip" title="Share on instagram"><i class="fab fa-instagram"></i></a>

        <a type="button" class="btn-floating btn-lg btn-whatsapp" data-toggle="tooltip" title="Share on whatsapp"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>
  </div>
</div>
<!-- / Social media share popup -->


<!-- Report popup -->
<script type="text/javascript">
  function reportBlog(blogId){
    var auth = '{{ $auth }}';
    if (auth=='') {
      window.location='/sign-in';
    } else{
      $('#blog_id').val(blogId)
      $('#report').modal('show')
    }
  }
</script>

<div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header darken-3 white-text bg-primary">
        <h4 class="title"><i class="far fa-comment-alt"></i> Report</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <div class="modal-body mb-0 text-center">
        <div class="form-group">
          <h5 class="h5-responsive text-center text-danger font-weight-bold" id="reportErr">&nbsp;</h5>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-4">
              <div class="custom-control custom-radio" style="float: left;">
                <input type="radio" class="custom-control-input" id="report1" name="report_reason" value="Nudity">
                <label class="custom-control-label" for="report1">Nudity</label>
              </div>
            </div>
            <div class="col-4">
              <div class="custom-control custom-radio" style="float: left;">
                <input type="radio" class="custom-control-input" id="report2" name="report_reason" value="Violence">
                <label class="custom-control-label" for="report2">Violence</label>
              </div>
            </div>
            <div class="col-4">
              <div class="custom-control custom-radio" style="float: left;">
                <input type="radio" class="custom-control-input" id="report3" name="report_reason" value="Harassment">
                <label class="custom-control-label" for="report3">Harassment</label>
              </div>
            </div>
            <div class="col-4">
              <div class="custom-control custom-radio" style="float: left;">
                <input type="radio" class="custom-control-input" id="report4" name="report_reason" value="Suicide or Self-Injury">
                <label class="custom-control-label" for="report4">Suicide or Self-Injury</label>
              </div>
            </div>
            <div class="col-4">
              <div class="custom-control custom-radio" style="float: left;">
                <input type="radio" class="custom-control-input" id="report5" name="report_reason" value="False News">
                <label class="custom-control-label" for="report5">False News</label>
              </div>
            </div>
            <div class="col-4">
              <div class="custom-control custom-radio" style="float: left;">
                <input type="radio" class="custom-control-input" id="report6" name="report_reason" value="Spam">
                <label class="custom-control-label" for="report6">Spam</label>
              </div>
            </div>
            <div class="col-4">
              <div class="custom-control custom-radio" style="float: left;">
                <input type="radio" class="custom-control-input" id="report7" name="report_reason" value="Unauthorized Sales">
                <label class="custom-control-label" for="report7">Unauthorized Sales</label>
              </div>
            </div>
            <div class="col-4">
              <div class="custom-control custom-radio" style="float: left;">
                <input type="radio" class="custom-control-input" id="report8" name="report_reason" value="Hate Speech">
                <label class="custom-control-label" for="report8">Hate Speech</label>
              </div>
            </div>
            <div class="col-4">
              <div class="custom-control custom-radio" style="float: left;">
                <input type="radio" class="custom-control-input" id="report9" name="report_reason" value="Terrorism">
                <label class="custom-control-label" for="report9">Terrorism</label>
              </div>
            </div>

            <input type="hidden" id="blog_id">

            <div class="col-4">
              <div class="custom-control custom-radio" style="float: left;">
                <input type="radio" class="custom-control-input" id="report10" name="report_reason" value="Something Else">
                <label class="custom-control-label" for="report10">Something Else</label>
              </div>
            </div>
          </div>
        </div>
        <div class="md-form md-outline">
          <textarea id="description" class="md-textarea form-control"></textarea>
          <label for="description">Enter Description</label>
        </div>
        <button class="btn btn-primary" onclick="submitReport()">Submit</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function submitReport(){
    var blog_id   = $('#blog_id').val();
    var user_id  = '{{ $auth }}';
    var report_reason = $('input[name=report_reason]:checked').val();
    var description = $('#description').val();

    if ($('input[name=report_reason]:checked').length==0) {
      $('#reportErr').html('Please select report reason')
      setTimeout(function(){ $('#reportErr').html('&nbsp;') },3500)
      $('input[name=report_reason]').focus()
    } else if (report_reason=='Something Else' && description=='') {
      $('#reportErr').html('Please enter description')
      setTimeout(function(){ $('#reportErr').html('&nbsp;') },3500)
      $('#description').focus()
    } else{
      $.ajax({
        url: '/report-blog',
        method: 'POST',
        data: { blog_id:blog_id, user_id:user_id, report_reason:report_reason, description:description },
        success:function(response){
          $('#report').modal('hide')
          if (response.success==true) {
            swal({
              title: "Success!",
              text: "Report submitted successfully...",
              icon: "success",
              button: false,
              timer: 2500
            });
          }
        }
      })
    }
  }
</script>
<!-- / Report popup -->

<style type="text/css">
  .carousel-control-prev-icon, .carousel-control-next-icon {
    height: 100px;
    width: 100px;
    outline: black;
    background-color: #4285f4 !important;
    background-size: 100%, 100%;
    border-radius: 50%;
    border: 1px solid black;
  }
  .carousel-control-prev, .carousel-control-next{
    width: 20px
  }
</style>

<!-- Latest -->
<div class="container-fluid">
  <h2 class="h2-responsive mt-4 mb-4 text-center">Latest</h2>
  <div class="row">
    <div class="col-sm-1"></div>
    @php
    $blogs = DB::table('blogs')
      ->select(['blogs.id', 'blogs.title', 'blogs.image', 'blogs.added_at_date', 'categories.category_name'])
      ->join('categories', 'blogs.category', '=', 'categories.id')
      ->where('blogs.category','!=','4')
      ->orderBy('blogs.id', 'DESC')
      ->limit(3)
      ->get();
    $count = 0;
    @endphp

    @if(sizeof($blogs)>0)
      @foreach ($blogs as $blog)
        @php $count++; @endphp
        @if($count==1)
          <div class="col-sm-4 mb-3">
            <div class="card promoting-card">
              <div class="view overlay">
                <img class="card-img-top rounded-0" src="/images/blogs/{{ $blog->image }}" alt="{{ $blog->title }}" style="max-height: 240px">
                <a href="#!"><div class="mask rgba-white-slight"></div></a>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-11">
                    <h5 class="card-title h5-responsive mb-2">{{ substr($blog->title,0,62) }}...</h5>
                  </div>
                  <div class="col-1 pl-0">
                    <div class="dropdown float-right">
                      <a class="fa fa-ellipsis-v dropdown-toggle hide-da" id="image-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="image-action">
                        <a href="#!" class="dropdown-item" onclick="reportBlog('{{ $blog->id }}')"><i class="far fa-comment-alt"></i> Report</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row my-2">
                  <div class="col-12">
                    <span class="badge badge-primary float-left">{{ $blog->category_name }}</span>
                    <p class="card-text float-right"><i class="far fa-clock pr-2"></i> {{ $blog->added_at_date }} </p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3">
                    <h5 class="text-primary">
                      @php
                      $likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('user_id', $auth)
                        ->where('status', 'like')
                        ->get();
                      @endphp

                      @if(sizeof($likes)>0)
                        <a href="#!" class="unlikeBlog_{{ $blog->id }}">
                          <i class="fas fa-thumbs-up" onclick="unLikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                        </a>
                        
                        @else
                        <a href="#!" class="likeBlog_{{ $blog->id }}">
                          <i class="far fa-thumbs-up" onclick="likeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                        </a>
                      @endif
                      

                      @php
                      $total_likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'like')
                        ->get();
                      @endphp
                      <span class="LikeCount_{{ $blog->id }}">{{ sizeof($total_likes) }}</span>
                    </h5>
                  </div>
                  <div class="col-3">
                    <h5 class="text-primary">
                      @php
                      $dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('user_id', $auth)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp

                      @if(sizeof($dislikes)>0)
                        <a href="#!" class="undislikeBlog_{{ $blog->id }}">
                          <i class="fas fa-thumbs-down" onclick="unDislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                        </a>
                        @else
                        <a href="#!" class="dislikeBlog_{{ $blog->id }}">
                          <i class="far fa-thumbs-down" onclick="dislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                        </a>
                      @endif

                      @php
                      $total_dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp
                      <span class="DislikeCount_{{ $blog->id }}">{{ sizeof($total_dislikes) }}</span>
                    </h5>
                  </div>
                  <div class="col-3">
                    <h5 class="text-primary">
                      @php
                      $favourites = DB::table('favourites')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('user_id', $auth)
                        ->get();
                      @endphp

                      @if(sizeof($favourites)>0)
                        <a href="#!" class="AF_Latest_blog_{{ $blog->id }}">
                          <i class="fas fa-star" onclick="removeFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                        </a>
                        @else
                        <a href="#!" class="RF_Latest_blog_{{ $blog->id }}">
                          <i class="far fa-star" onclick="addFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                        </a>
                      @endif
                    </h5>
                  </div>
                  <div class="col-3">
                    <h5 class="text-primary">
                      <a data-toggle="modal" data-target="#socialShare">
                        <i class="fa fa-share-alt"></i>
                      </a>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @else
          <div class="col-sm-3 mb-3">
            <div class="card promoting-card">
              <div class="view overlay">
                <img class="card-img-top rounded-0" src="/images/blogs/{{ $blog->image }}" alt="{{ $blog->title }}">
                <a href="#!"><div class="mask rgba-white-slight"></div></a>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-11">
                    <h5 class="card-title h5-responsive mb-2">{{ substr($blog->title,0,62) }}...</h5>
                  </div>
                  <div class="col-1 pl-0">
                    <div class="dropdown float-right">
                      <a class="fa fa-ellipsis-v dropdown-toggle hide-da" id="image-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="image-action">
                        <a href="#!" class="dropdown-item" onclick="reportBlog('{{ $blog->id }}')"><i class="far fa-comment-alt"></i> Report</a>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="row my-2">
                  <div class="col-12">
                    <span class="badge badge-primary float-left">{{ $blog->category_name }}</span>
                    <p class="card-text float-right"><i class="far fa-clock pr-2"></i>{{ $blog->added_at_date }}</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3">
                    <h5 class="text-primary">
                      @php
                      $likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('user_id', $auth)
                        ->where('status', 'like')
                        ->get();
                      @endphp

                      @if(sizeof($likes)>0)
                        <a href="#!" class="unlikeBlog_{{ $blog->id }}">
                          <i class="fas fa-thumbs-up" onclick="unLikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                        </a>
                        
                        @else
                        <a href="#!" class="likeBlog_{{ $blog->id }}">
                          <i class="far fa-thumbs-up" onclick="likeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                        </a>
                      @endif
                      

                      @php
                      $total_likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'like')
                        ->get();
                      @endphp
                      <span class="LikeCount_{{ $blog->id }}">{{ sizeof($total_likes) }}</span>
                    </h5>
                  </div>
                  <div class="col-3">
                    <h5 class="text-primary">
                      @php
                      $dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('user_id', $auth)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp

                      @if(sizeof($dislikes)>0)
                        <a href="#!" class="undislikeBlog_{{ $blog->id }}">
                          <i class="fas fa-thumbs-down" onclick="unDislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                        </a>
                        @else
                        <a href="#!" class="dislikeBlog_{{ $blog->id }}">
                          <i class="far fa-thumbs-down" onclick="dislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                        </a>
                      @endif

                      @php
                      $total_dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp
                      <span class="DislikeCount_{{ $blog->id }}">{{ sizeof($total_dislikes) }}</span>
                    </h5>
                  </div>
                  <div class="col-3">
                    <h5 class="text-primary">
                      @php
                      $favourites = DB::table('favourites')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('user_id', $auth)
                        ->get();
                      @endphp

                      @if(sizeof($favourites)>0)
                        <a href="#!" class="AF_Latest_blog_{{ $blog->id }}">
                          <i class="fas fa-star" onclick="removeFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                        </a>
                        @else
                        <a href="#!" class="RF_Latest_blog_{{ $blog->id }}">
                          <i class="far fa-star" onclick="addFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                        </a>
                      @endif
                    </h5>
                  </div>
                  <div class="col-3">
                    <h5 class="text-primary">
                      <a data-toggle="modal" data-target="#socialShare">
                        <i class="fa fa-share-alt"></i>
                      </a>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif
      @endforeach
    @endif
  </div>

  <div id="carouselControls1" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="row">
          @php
          $blogs = DB::table('blogs')
            ->select(['blogs.id', 'blogs.title', 'blogs.image', 'blogs.added_at_date', 'categories.category_name'])
            ->join('categories', 'blogs.category', '=', 'categories.id')
            ->where('blogs.category','!=','4')
            ->orderBy('blogs.id', 'DESC')
            ->get();

          $count = 0;
          @endphp

          @foreach($blogs as $blog)
            @php $count++; @endphp
            @if($count>3 && $count<6)
              <div class="col-md-6">
                <div class="card promoting-card">
                  <div class="card-body d-flex flex-row">
                    <div class="full-width">
                      <div class="row">
                        <div class="col-4">
                          <div class="view overlay">
                            <img class="card-img-top rounded-0" src="/images/blogs/{{ $blog->image }}" alt="{{ $blog->title }}" style="max-height: 110px">
                            <a href="#!"><div class="mask rgba-white-slight"></div></a>
                          </div>
                        </div>
                        <div class="col-7">
                          <h5 class="card-title h5-responsive mb-2">
                            <a href="#" class="text-dark"> {{ substr($blog->title,0,62) }}...</a></h5>
                          <div class="row">
                            <div class="col-12">
                              <span class="badge badge-primary float-left">{{ $blog->category_name }}</span>
                              <p class="card-text float-right"><i class="far fa-clock pr-2"></i>{{ $blog->added_at_date }}</p>
                            </div>
                          </div>
                            

                          <div class="row">
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $likes = DB::table('blog_likes')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->where('status', 'like')
                                  ->get();
                                @endphp

                                @if(sizeof($likes)>0)
                                  <a href="#!" class="unlikeBlog_{{ $blog->id }}">
                                    <i class="fas fa-thumbs-up" onclick="unLikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                  
                                  @else
                                  <a href="#!" class="likeBlog_{{ $blog->id }}">
                                    <i class="far fa-thumbs-up" onclick="likeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                @endif

                                @php
                      $total_likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'like')
                        ->get();
                      @endphp
                      <span class="LikeCount_{{ $blog->id }}">{{ sizeof($total_likes) }}</span>
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $dislikes = DB::table('blog_likes')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->where('status', 'dislike')
                                  ->get();
                                @endphp

                                @if(sizeof($dislikes)>0)
                                  <a href="#!" class="undislikeBlog_{{ $blog->id }}">
                                    <i class="fas fa-thumbs-down" onclick="unDislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                  @else
                                  <a href="#!" class="dislikeBlog_{{ $blog->id }}">
                                    <i class="far fa-thumbs-down" onclick="dislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                @endif

                                @php
                      $total_dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp
                      <span class="DislikeCount_{{ $blog->id }}">{{ sizeof($total_dislikes) }}</span>
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $favourites = DB::table('favourites')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->get();
                                @endphp

                                @if(sizeof($favourites)>0)
                                  <a href="#!" class="AF_Latest_blog_{{ $blog->id }}">
                                    <i class="fas fa-star" onclick="removeFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                                  </a>
                                  @else
                                  <a href="#!" class="RF_Latest_blog_{{ $blog->id }}">
                                    <i class="far fa-star" onclick="addFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                                  </a>
                                @endif
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                <a data-toggle="modal" data-target="#socialShare">
                                  <i class="fa fa-share-alt"></i>
                                </a>
                              </h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-1">
                          <div class="dropdown float-right">
                            <a class="fa fa-ellipsis-v dropdown-toggle hide-da" id="image-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="image-action">
                              <a href="#!" class="dropdown-item" onclick="reportBlog('{{ $blog->id }}')"><i class="far fa-comment-alt"></i> Report</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
      <div class="carousel-item">
        <div class="row">
          @php
          $blogs = DB::table('blogs')
            ->select(['blogs.id', 'blogs.title', 'blogs.image', 'blogs.added_at_date', 'categories.category_name'])
            ->join('categories', 'blogs.category', '=', 'categories.id')
            ->where('blogs.category','!=','4')
            ->orderBy('blogs.id', 'DESC')
            ->get();

          $count = 0;
          @endphp

          @foreach($blogs as $blog)
            @php $count++; @endphp
            @if($count>5 && $count<8)
              <div class="col-md-6">
                <div class="card promoting-card">
                  <div class="card-body d-flex flex-row">
                    <div class="full-width">
                      <div class="row">
                        <div class="col-4">
                          <div class="view overlay">
                            <img class="card-img-top rounded-0" src="/images/blogs/{{ $blog->image }}" alt="{{ $blog->title }}" style="max-height: 110px">
                            <a href="#!"><div class="mask rgba-white-slight"></div></a>
                          </div>
                        </div>
                        <div class="col-7">
                          <h5 class="card-title h5-responsive mb-2">
                            <a href="#" class="text-dark"> {{ substr($blog->title,0,62) }}...</a></h5>
                          <div class="row">
                            <div class="col-12">
                              <span class="badge badge-primary float-left">{{ $blog->category_name }}</span>
                              <p class="card-text float-right"><i class="far fa-clock pr-2"></i>{{ $blog->added_at_date }}</p>
                            </div>
                          </div>
                            

                          <div class="row">
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $likes = DB::table('blog_likes')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->where('status', 'like')
                                  ->get();
                                @endphp

                                @if(sizeof($likes)>0)
                                  <a href="#!" class="unlikeBlog_{{ $blog->id }}">
                                    <i class="fas fa-thumbs-up" onclick="unLikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                  
                                  @else
                                  <a href="#!" class="likeBlog_{{ $blog->id }}">
                                    <i class="far fa-thumbs-up" onclick="likeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                @endif

                                @php
                      $total_likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'like')
                        ->get();
                      @endphp
                      <span class="LikeCount_{{ $blog->id }}">{{ sizeof($total_likes) }}</span>
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $dislikes = DB::table('blog_likes')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->where('status', 'dislike')
                                  ->get();
                                @endphp

                                @if(sizeof($dislikes)>0)
                                  <a href="#!" class="undislikeBlog_{{ $blog->id }}">
                                    <i class="fas fa-thumbs-down" onclick="unDislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                  @else
                                  <a href="#!" class="dislikeBlog_{{ $blog->id }}">
                                    <i class="far fa-thumbs-down" onclick="dislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                @endif

                                @php
                      $total_dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp
                      <span class="DislikeCount_{{ $blog->id }}">{{ sizeof($total_dislikes) }}</span>
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $favourites = DB::table('favourites')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->get();
                                @endphp

                                @if(sizeof($favourites)>0)
                                  <a href="#!" class="AF_Latest_blog_{{ $blog->id }}">
                                    <i class="fas fa-star" onclick="removeFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                                  </a>
                                  @else
                                  <a href="#!" class="RF_Latest_blog_{{ $blog->id }}">
                                    <i class="far fa-star" onclick="addFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                                  </a>
                                @endif
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                <a data-toggle="modal" data-target="#socialShare">
                                  <i class="fa fa-share-alt"></i>
                                </a>
                              </h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-1">
                          <div class="dropdown float-right">
                            <a class="fa fa-ellipsis-v dropdown-toggle hide-da" id="image-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="image-action">
                              <a href="#!" class="dropdown-item" onclick="reportBlog('{{ $blog->id }}')"><i class="far fa-comment-alt"></i> Report</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
      <div class="carousel-item">
        <div class="row">
          @php
          $blogs = DB::table('blogs')
            ->select(['blogs.id', 'blogs.title', 'blogs.image', 'blogs.added_at_date', 'categories.category_name'])
            ->join('categories', 'blogs.category', '=', 'categories.id')
            ->where('blogs.category','!=','4')
            ->orderBy('blogs.id', 'DESC')
            ->get();

          $count = 0;
          @endphp

          @foreach($blogs as $blog)
            @php $count++; @endphp
            @if($count>7 && $count<10)
              <div class="col-md-6">
                <div class="card promoting-card">
                  <div class="card-body d-flex flex-row">
                    <div class="full-width">
                      <div class="row">
                        <div class="col-4">
                          <div class="view overlay">
                            <img class="card-img-top rounded-0" src="/images/blogs/{{ $blog->image }}" alt="{{ $blog->title }}" style="max-height: 110px">
                            <a href="#!"><div class="mask rgba-white-slight"></div></a>
                          </div>
                        </div>
                        <div class="col-7">
                          <h5 class="card-title h5-responsive mb-2">
                            <a href="#" class="text-dark"> {{ substr($blog->title,0,62) }}...</a></h5>
                          <div class="row">
                            <div class="col-12">
                              <span class="badge badge-primary float-left">{{ $blog->category_name }}</span>
                              <p class="card-text float-right"><i class="far fa-clock pr-2"></i>{{ $blog->added_at_date }}</p>
                            </div>
                          </div>
                            

                          <div class="row">
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $likes = DB::table('blog_likes')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->where('status', 'like')
                                  ->get();
                                @endphp

                                @if(sizeof($likes)>0)
                                  <a href="#!" class="unlikeBlog_{{ $blog->id }}">
                                    <i class="fas fa-thumbs-up" onclick="unLikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                  
                                  @else
                                  <a href="#!" class="likeBlog_{{ $blog->id }}">
                                    <i class="far fa-thumbs-up" onclick="likeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                @endif

                                @php
                      $total_likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'like')
                        ->get();
                      @endphp
                      <span class="LikeCount_{{ $blog->id }}">{{ sizeof($total_likes) }}</span>
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $dislikes = DB::table('blog_likes')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->where('status', 'dislike')
                                  ->get();
                                @endphp

                                @if(sizeof($dislikes)>0)
                                  <a href="#!" class="undislikeBlog_{{ $blog->id }}">
                                    <i class="fas fa-thumbs-down" onclick="unDislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                  @else
                                  <a href="#!" class="dislikeBlog_{{ $blog->id }}">
                                    <i class="far fa-thumbs-down" onclick="dislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                @endif

                                @php
                      $total_dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp
                      <span class="DislikeCount_{{ $blog->id }}">{{ sizeof($total_dislikes) }}</span>
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $favourites = DB::table('favourites')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->get();
                                @endphp

                                @if(sizeof($favourites)>0)
                                  <a href="#!" class="AF_Latest_blog_{{ $blog->id }}">
                                    <i class="fas fa-star" onclick="removeFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                                  </a>
                                  @else
                                  <a href="#!" class="RF_Latest_blog_{{ $blog->id }}">
                                    <i class="far fa-star" onclick="addFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                                  </a>
                                @endif
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                <a data-toggle="modal" data-target="#socialShare">
                                  <i class="fa fa-share-alt"></i>
                                </a>
                              </h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-1">
                          <div class="dropdown float-right">
                            <a class="fa fa-ellipsis-v dropdown-toggle hide-da" id="image-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="image-action">
                              <a href="#!" class="dropdown-item" onclick="reportBlog('{{ $blog->id }}')"><i class="far fa-comment-alt"></i> Report</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselControls1" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselControls1" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

      
    <div class="row mt-3 mb-4">
      <div class="col-3 col-sm-3 col-md-5"></div>
      <div class="col-6 col-sm-6 col-md-2">
        <a href="#" class="btn btn-primary btn-block mb-2">View All</a>
      </div>
    </div>
  </div>
  <!-- Trending -->
  <div class="container-fluid mt-5">
    <h2 class="h2-responsive mt-4 mb-4 text-center">Trending</h2>
    <div class="row">
      <div class="col-sm-1"></div>
      @php
      $blogs = DB::table('blogs')
        ->select(['blogs.id', 'blogs.title', 'blogs.image', 'blogs.added_at_date', 'categories.category_name'])
        ->join('categories', 'blogs.category', '=', 'categories.id')
        ->where('blogs.category','!=','4')
        ->orderBy('blogs.views_count', 'DESC')
        ->limit(3)
        ->get();
      $count = 0;
      @endphp

      @if(sizeof($blogs)>0)
        @foreach ($blogs as $blog)
          @php $count++; @endphp
          @if($count==1)
            <div class="col-sm-4 mb-3">
              <div class="card promoting-card">
                <div class="view overlay">
                  <img class="card-img-top rounded-0" src="/images/blogs/{{ $blog->image }}" alt="{{ $blog->title }}" style="max-height: 240px;">
                  <a href="#!"><div class="mask rgba-white-slight"></div></a>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-11">
                      <h5 class="card-title h5-responsive mb-2">{{ substr($blog->title,0,62) }}...</h5>
                    </div>
                    <div class="col-1 pl-0">
                      <div class="dropdown float-right">
                        <a class="fa fa-ellipsis-v dropdown-toggle hide-da" id="image-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="image-action">
                          <a href="#!" class="dropdown-item" onclick="reportBlog('{{ $blog->id }}')"><i class="far fa-comment-alt"></i> Report</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row my-2">
                    <div class="col-12">
                      <span class="badge badge-primary float-left">{{ $blog->category_name }}</span>
                      <p class="card-text float-right"><i class="far fa-clock pr-2"></i> {{ $blog->added_at_date }} </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-3">
                      <h5 class="text-primary">
                        @php
                        $likes = DB::table('blog_likes')
                          ->select('id')
                          ->where('blog_id', $blog->id)
                          ->where('user_id', $auth)
                          ->where('status', 'like')
                          ->get();
                        @endphp

                        @if(sizeof($likes)>0)
                          <a href="#!" class="unlikeBlog_{{ $blog->id }}">
                            <i class="fas fa-thumbs-up" onclick="unLikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                          </a>
                          
                          @else
                          <a href="#!" class="likeBlog_{{ $blog->id }}">
                            <i class="far fa-thumbs-up" onclick="likeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                          </a>
                        @endif

                        @php
                      $total_likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'like')
                        ->get();
                      @endphp
                      <span class="LikeCount_{{ $blog->id }}">{{ sizeof($total_likes) }}</span>
                      </h5>
                    </div>
                    <div class="col-3">
                      <h5 class="text-primary">
                        @php
                        $dislikes = DB::table('blog_likes')
                          ->select('id')
                          ->where('blog_id', $blog->id)
                          ->where('user_id', $auth)
                          ->where('status', 'dislike')
                          ->get();
                        @endphp

                        @if(sizeof($dislikes)>0)
                          <a href="#!" class="undislikeBlog_{{ $blog->id }}">
                            <i class="fas fa-thumbs-down" onclick="unDislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                          </a>
                          @else
                          <a href="#!" class="dislikeBlog_{{ $blog->id }}">
                            <i class="far fa-thumbs-down" onclick="dislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                          </a>
                        @endif

                        @php
                      $total_dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp
                      <span class="DislikeCount_{{ $blog->id }}">{{ sizeof($total_dislikes) }}</span>
                      </h5>
                    </div>
                    <div class="col-3">
                      <h5 class="text-primary">
                        @php
                        $favourites = DB::table('favourites')
                          ->select('id')
                          ->where('blog_id', $blog->id)
                          ->where('user_id', $auth)
                          ->get();
                        @endphp

                        @if(sizeof($favourites)>0)
                          <a href="#!" class="AF_Latest_blog_{{ $blog->id }}">
                            <i class="fas fa-star" onclick="removeFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                          </a>
                          @else
                          <a href="#!" class="RF_Latest_blog_{{ $blog->id }}">
                            <i class="far fa-star" onclick="addFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                          </a>
                        @endif
                      </h5>
                    </div>
                    <div class="col-3">
                      <h5 class="text-primary">
                        <a data-toggle="modal" data-target="#socialShare">
                          <i class="fa fa-share-alt"></i>
                        </a>
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @else
            <div class="col-sm-3 mb-3">
              <div class="card promoting-card">
                <div class="view overlay">
                  <img class="card-img-top rounded-0" src="/images/blogs/{{ $blog->image }}" alt="{{ $blog->title }}" style="max-height: 200px">
                  <a href="#!"><div class="mask rgba-white-slight"></div></a>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-11">
                      <h5 class="card-title h5-responsive mb-2">{{ substr($blog->title,0,62) }}...</h5>
                    </div>
                    <div class="col-1 pl-0">
                      <div class="dropdown float-right">
                        <a class="fa fa-ellipsis-v dropdown-toggle hide-da" id="image-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="image-action">
                          <a href="#!" class="dropdown-item" onclick="reportBlog('{{ $blog->id }}')"><i class="far fa-comment-alt"></i> Report</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row my-2">
                    <div class="col-12">
                      <span class="badge badge-primary float-left">{{ $blog->category_name }}</span>
                      <p class="card-text float-right"><i class="far fa-clock pr-2"></i>{{ $blog->added_at_date }}</p>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-3">
                    <h5 class="text-primary">
                      @php
                      $likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('user_id', $auth)
                        ->where('status', 'like')
                        ->get();
                      @endphp

                      @if(sizeof($likes)>0)
                        <a href="#!" class="unlikeBlog_{{ $blog->id }}">
                          <i class="fas fa-thumbs-up" onclick="unLikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                        </a>
                        
                        @else
                        <a href="#!" class="likeBlog_{{ $blog->id }}">
                          <i class="far fa-thumbs-up" onclick="likeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                        </a>
                      @endif
                      

                      @php
                      $total_likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'like')
                        ->get();
                      @endphp
                      <span class="LikeCount_{{ $blog->id }}">{{ sizeof($total_likes) }}</span>
                    </h5>
                  </div>
                  <div class="col-3">
                    <h5 class="text-primary">
                      @php
                      $dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('user_id', $auth)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp

                      @if(sizeof($dislikes)>0)
                        <a href="#!" class="undislikeBlog_{{ $blog->id }}">
                          <i class="fas fa-thumbs-down" onclick="unDislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                        </a>
                        @else
                        <a href="#!" class="dislikeBlog_{{ $blog->id }}">
                          <i class="far fa-thumbs-down" onclick="dislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                        </a>
                      @endif

                      @php
                      $total_dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp
                      <span class="DislikeCount_{{ $blog->id }}">{{ sizeof($total_dislikes) }}</span>
                    </h5>
                  </div>
                  <div class="col-3">
                    <h5 class="text-primary">
                      @php
                      $favourites = DB::table('favourites')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('user_id', $auth)
                        ->get();
                      @endphp

                      @if(sizeof($favourites)>0)
                        <a href="#!" class="AF_Latest_blog_{{ $blog->id }}">
                          <i class="fas fa-star" onclick="removeFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                        </a>
                        @else
                        <a href="#!" class="RF_Latest_blog_{{ $blog->id }}">
                          <i class="far fa-star" onclick="addFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                        </a>
                      @endif
                    </h5>
                  </div>
                  <div class="col-3">
                    <h5 class="text-primary">
                      <a data-toggle="modal" data-target="#socialShare">
                        <i class="fa fa-share-alt"></i>
                      </a>
                    </h5>
                  </div>
                </div>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      @endif
    </div>
    <div id="carouselControls2" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="row">
          @php
          $blogs = DB::table('blogs')
            ->select(['blogs.id', 'blogs.title', 'blogs.image', 'blogs.added_at_date', 'categories.category_name'])
            ->join('categories', 'blogs.category', '=', 'categories.id')
            ->where('blogs.category','!=','4')
            ->orderBy('blogs.views_count', 'DESC')
            ->get();

          $count = 0;
          @endphp

          @foreach($blogs as $blog)
            @php $count++; @endphp
            @if($count>3 && $count<6)
              <div class="col-md-6">
                <div class="card promoting-card">
                  <div class="card-body d-flex flex-row">
                    <div class="full-width">
                      <div class="row">
                        <div class="col-4">
                          <div class="view overlay">
                            <img class="card-img-top rounded-0" src="/images/blogs/{{ $blog->image }}" alt="{{ $blog->title }}" style="max-height: 110px">
                            <a href="#!"><div class="mask rgba-white-slight"></div></a>
                          </div>
                        </div>
                        <div class="col-7">
                          <h5 class="card-title h5-responsive mb-2">
                            <a href="#" class="text-dark"> {{ substr($blog->title,0,62) }}...</a></h5>
                          <div class="row">
                            <div class="col-12">
                              <span class="badge badge-primary float-left">{{ $blog->category_name }}</span>
                              <p class="card-text float-right"><i class="far fa-clock pr-2"></i>{{ $blog->added_at_date }}</p>
                            </div>
                          </div>
                            

                          <div class="row">
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $likes = DB::table('blog_likes')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->where('status', 'like')
                                  ->get();
                                @endphp

                                @if(sizeof($likes)>0)
                                  <a href="#!" class="unlikeBlog_{{ $blog->id }}">
                                    <i class="fas fa-thumbs-up" onclick="unLikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                  
                                  @else
                                  <a href="#!" class="likeBlog_{{ $blog->id }}">
                                    <i class="far fa-thumbs-up" onclick="likeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                @endif

                                @php
                      $total_likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'like')
                        ->get();
                      @endphp
                      <span class="LikeCount_{{ $blog->id }}">{{ sizeof($total_likes) }}</span>
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $dislikes = DB::table('blog_likes')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->where('status', 'dislike')
                                  ->get();
                                @endphp

                                @if(sizeof($dislikes)>0)
                                  <a href="#!" class="undislikeBlog_{{ $blog->id }}">
                                    <i class="fas fa-thumbs-down" onclick="unDislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                  @else
                                  <a href="#!" class="dislikeBlog_{{ $blog->id }}">
                                    <i class="far fa-thumbs-down" onclick="dislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                @endif

                                @php
                      $total_dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp
                      <span class="DislikeCount_{{ $blog->id }}">{{ sizeof($total_dislikes) }}</span>
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $favourites = DB::table('favourites')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->get();
                                @endphp

                                @if(sizeof($favourites)>0)
                                  <a href="#!" class="AF_Latest_blog_{{ $blog->id }}">
                                    <i class="fas fa-star" onclick="removeFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                                  </a>
                                  @else
                                  <a href="#!" class="RF_Latest_blog_{{ $blog->id }}">
                                    <i class="far fa-star" onclick="addFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                                  </a>
                                @endif
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                <a data-toggle="modal" data-target="#socialShare">
                                  <i class="fa fa-share-alt"></i>
                                </a>
                              </h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-1">
                          <div class="dropdown float-right">
                            <a class="fa fa-ellipsis-v dropdown-toggle hide-da" id="image-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="image-action">
                              <a href="#!" class="dropdown-item" onclick="reportBlog('{{ $blog->id }}')"><i class="far fa-comment-alt"></i> Report</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
      <div class="carousel-item">
        <div class="row">
          @php
          $blogs = DB::table('blogs')
            ->select(['blogs.id', 'blogs.title', 'blogs.image', 'blogs.added_at_date', 'categories.category_name'])
            ->join('categories', 'blogs.category', '=', 'categories.id')
            ->where('blogs.category','!=','4')
            ->orderBy('blogs.views_count', 'DESC')
            ->get();

          $count = 0;
          @endphp

          @foreach($blogs as $blog)
            @php $count++; @endphp
            @if($count>5 && $count<8)
              <div class="col-md-6">
                <div class="card promoting-card">
                  <div class="card-body d-flex flex-row">
                    <div class="full-width">
                      <div class="row">
                        <div class="col-4">
                          <div class="view overlay">
                            <img class="card-img-top rounded-0" src="/images/blogs/{{ $blog->image }}" alt="{{ $blog->title }}" style="max-height: 110px">
                            <a href="#!"><div class="mask rgba-white-slight"></div></a>
                          </div>
                        </div>
                        <div class="col-7">
                          <h5 class="card-title h5-responsive mb-2">
                            <a href="#" class="text-dark"> {{ substr($blog->title,0,62) }}...</a></h5>
                          <div class="row">
                            <div class="col-12">
                              <span class="badge badge-primary float-left">{{ $blog->category_name }}</span>
                              <p class="card-text float-right"><i class="far fa-clock pr-2"></i>{{ $blog->added_at_date }}</p>
                            </div>
                          </div>
                            

                          <div class="row">
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $likes = DB::table('blog_likes')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->where('status', 'like')
                                  ->get();
                                @endphp

                                @if(sizeof($likes)>0)
                                  <a href="#!" class="unlikeBlog_{{ $blog->id }}">
                                    <i class="fas fa-thumbs-up" onclick="unLikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                  
                                  @else
                                  <a href="#!" class="likeBlog_{{ $blog->id }}">
                                    <i class="far fa-thumbs-up" onclick="likeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                @endif

                                @php
                      $total_likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'like')
                        ->get();
                      @endphp
                      <span class="LikeCount_{{ $blog->id }}">{{ sizeof($total_likes) }}</span>
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $dislikes = DB::table('blog_likes')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->where('status', 'dislike')
                                  ->get();
                                @endphp

                                @if(sizeof($dislikes)>0)
                                  <a href="#!" class="undislikeBlog_{{ $blog->id }}">
                                    <i class="fas fa-thumbs-down" onclick="unDislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                  @else
                                  <a href="#!" class="dislikeBlog_{{ $blog->id }}">
                                    <i class="far fa-thumbs-down" onclick="dislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                @endif

                                @php
                      $total_dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp
                      <span class="DislikeCount_{{ $blog->id }}">{{ sizeof($total_dislikes) }}</span>
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $favourites = DB::table('favourites')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->get();
                                @endphp

                                @if(sizeof($favourites)>0)
                                  <a href="#!" class="AF_Latest_blog_{{ $blog->id }}">
                                    <i class="fas fa-star" onclick="removeFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                                  </a>
                                  @else
                                  <a href="#!" class="RF_Latest_blog_{{ $blog->id }}">
                                    <i class="far fa-star" onclick="addFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                                  </a>
                                @endif
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                <a data-toggle="modal" data-target="#socialShare">
                                  <i class="fa fa-share-alt"></i>
                                </a>
                              </h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-1">
                          <div class="dropdown float-right">
                            <a class="fa fa-ellipsis-v dropdown-toggle hide-da" id="image-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="image-action">
                              <a href="#!" class="dropdown-item" onclick="reportBlog('{{ $blog->id }}')"><i class="far fa-comment-alt"></i> Report</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
      <div class="carousel-item">
        <div class="row">
          @php
          $blogs = DB::table('blogs')
            ->select(['blogs.id', 'blogs.title', 'blogs.image', 'blogs.added_at_date', 'categories.category_name'])
            ->join('categories', 'blogs.category', '=', 'categories.id')
            ->where('blogs.category','!=','4')
            ->orderBy('id', 'DESC')
            ->get();

          $count = 0;
          @endphp

          @foreach($blogs as $blog)
            @php $count++; @endphp
            @if($count>7 && $count<10)
              <div class="col-md-6">
                <div class="card promoting-card">
                  <div class="card-body d-flex flex-row">
                    <div class="full-width">
                      <div class="row">
                        <div class="col-4">
                          <div class="view overlay">
                            <img class="card-img-top rounded-0" src="/images/blogs/{{ $blog->image }}" alt="{{ $blog->title }}" style="max-height: 110px">
                            <a href="#!"><div class="mask rgba-white-slight"></div></a>
                          </div>
                        </div>
                        <div class="col-7">
                          <h5 class="card-title h5-responsive mb-2">
                            <a href="#" class="text-dark"> {{ substr($blog->title,0,62) }}...</a></h5>
                          <div class="row">
                            <div class="col-12">
                              <span class="badge badge-primary float-left">{{ $blog->category_name }}</span>
                              <p class="card-text float-right"><i class="far fa-clock pr-2"></i>{{ $blog->added_at_date }}</p>
                            </div>
                          </div>
                            

                          <div class="row">
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $likes = DB::table('blog_likes')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->where('status', 'like')
                                  ->get();
                                @endphp

                                @if(sizeof($likes)>0)
                                  <a href="#!" class="unlikeBlog_{{ $blog->id }}">
                                    <i class="fas fa-thumbs-up" onclick="unLikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                  
                                  @else
                                  <a href="#!" class="likeBlog_{{ $blog->id }}">
                                    <i class="far fa-thumbs-up" onclick="likeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                @endif

                                @php
                      $total_likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'like')
                        ->get();
                      @endphp
                      <span class="LikeCount_{{ $blog->id }}">{{ sizeof($total_likes) }}</span>
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $dislikes = DB::table('blog_likes')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->where('status', 'dislike')
                                  ->get();
                                @endphp

                                @if(sizeof($dislikes)>0)
                                  <a href="#!" class="undislikeBlog_{{ $blog->id }}">
                                    <i class="fas fa-thumbs-down" onclick="unDislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                  @else
                                  <a href="#!" class="dislikeBlog_{{ $blog->id }}">
                                    <i class="far fa-thumbs-down" onclick="dislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                                  </a>
                                @endif

                                @php
                      $total_dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp
                      <span class="DislikeCount_{{ $blog->id }}">{{ sizeof($total_dislikes) }}</span>
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                @php
                                $favourites = DB::table('favourites')
                                  ->select('id')
                                  ->where('blog_id', $blog->id)
                                  ->where('user_id', $auth)
                                  ->get();
                                @endphp

                                @if(sizeof($favourites)>0)
                                  <a href="#!" class="AF_Latest_blog_{{ $blog->id }}">
                                    <i class="fas fa-star" onclick="removeFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                                  </a>
                                  @else
                                  <a href="#!" class="RF_Latest_blog_{{ $blog->id }}">
                                    <i class="far fa-star" onclick="addFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                                  </a>
                                @endif
                              </h5>
                            </div>
                            <div class="col-3">
                              <h5 class="text-primary">
                                <a data-toggle="modal" data-target="#socialShare">
                                  <i class="fa fa-share-alt"></i>
                                </a>
                              </h5>
                            </div>
                          </div>
                        </div>
                        <div class="col-1">
                          <div class="dropdown float-right">
                            <a class="fa fa-ellipsis-v dropdown-toggle hide-da" id="image-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="image-action">
                              <a href="#!" class="dropdown-item" onclick="reportBlog('{{ $blog->id }}')"><i class="far fa-comment-alt"></i> Report</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselControls2" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselControls2" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

    <div class="row mt-3 mb-4">
      <div class="col-3 col-sm-3 col-md-5"></div>
      <div class="col-6 col-sm-6 col-md-2">
        <a href="#" class="btn btn-primary btn-block mb-2">View All</a>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <img src="https://101trading.co.uk/wp-content/uploads/2015/04/horizon_00364590-1030x412.jpg" class="img-fluid" style="width: 100%; height: 400px">
    </div>
  </div>
</div>

<!-- Videos -->
<div class="container-fluid mt-5">
    <h2 class="h2-responsive mt-4 mb-4 text-center">Videos</h2>
    <div class="row">
      <div class="col-sm-1"></div>
      @php
      $blogs = DB::table('blogs')
        ->select(['blogs.id', 'blogs.title', 'blogs.video', 'blogs.added_at_date', 'categories.category_name'])
        ->join('categories', 'blogs.category', '=', 'categories.id')
        ->where('blogs.category', '4')
        ->orderBy('blogs.views_count', 'DESC')
        ->limit(3)
        ->get();
      $count = 0;
      @endphp

      @if(sizeof($blogs)>0)
        @foreach ($blogs as $blog)
          @php $count++; @endphp
          @if($count==1)
            <div class="col-sm-4 mb-3">
              <div class="card promoting-card">
                <div class="view overlay">
                  <iframe width="100%" height="250px" src="https://www.youtube.com/embed/{{ explode('/',$blog->video)[3] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-11">
                      <h5 class="card-title h5-responsive mb-2">{{ substr($blog->title,0,62) }}...</h5>
                    </div>
                    <div class="col-1 pl-0">
                      <div class="dropdown float-right">
                        <a class="fa fa-ellipsis-v dropdown-toggle hide-da" id="image-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="image-action">
                          <a href="#!" class="dropdown-item" onclick="reportBlog('{{ $blog->id }}')"><i class="far fa-comment-alt"></i> Report</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row my-2">
                    <div class="col-12">
                      <span class="badge badge-primary float-left">{{ $blog->category_name }}</span>
                      <p class="card-text float-right"><i class="far fa-clock pr-2"></i> {{ $blog->added_at_date }} </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-3">
                      <h5 class="text-primary">
                        @php
                        $likes = DB::table('blog_likes')
                          ->select('id')
                          ->where('blog_id', $blog->id)
                          ->where('user_id', $auth)
                          ->where('status', 'like')
                          ->get();
                        @endphp

                        @if(sizeof($likes)>0)
                          <a href="#!" class="unlikeBlog_{{ $blog->id }}">
                            <i class="fas fa-thumbs-up" onclick="unLikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                          </a>
                          
                          @else
                          <a href="#!" class="likeBlog_{{ $blog->id }}">
                            <i class="far fa-thumbs-up" onclick="likeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                          </a>
                        @endif

                        @php
                      $total_likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'like')
                        ->get();
                      @endphp
                      <span class="LikeCount_{{ $blog->id }}">{{ sizeof($total_likes) }}</span>
                      </h5>
                    </div>
                    <div class="col-3">
                      <h5 class="text-primary">
                        @php
                        $dislikes = DB::table('blog_likes')
                          ->select('id')
                          ->where('blog_id', $blog->id)
                          ->where('user_id', $auth)
                          ->where('status', 'dislike')
                          ->get();
                        @endphp

                        @if(sizeof($dislikes)>0)
                          <a href="#!" class="undislikeBlog_{{ $blog->id }}">
                            <i class="fas fa-thumbs-down" onclick="unDislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                          </a>
                          @else
                          <a href="#!" class="dislikeBlog_{{ $blog->id }}">
                            <i class="far fa-thumbs-down" onclick="dislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                          </a>
                        @endif

                        @php
                      $total_dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp
                      <span class="DislikeCount_{{ $blog->id }}">{{ sizeof($total_dislikes) }}</span>
                      </h5>
                    </div>
                    <div class="col-3">
                      <h5 class="text-primary">
                        @php
                        $favourites = DB::table('favourites')
                          ->select('id')
                          ->where('blog_id', $blog->id)
                          ->where('user_id', $auth)
                          ->get();
                        @endphp

                        @if(sizeof($favourites)>0)
                          <a href="#!" class="AF_Latest_blog_{{ $blog->id }}">
                            <i class="fas fa-star" onclick="removeFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                          </a>
                          @else
                          <a href="#!" class="RF_Latest_blog_{{ $blog->id }}">
                            <i class="far fa-star" onclick="addFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                          </a>
                        @endif
                      </h5>
                    </div>
                    <div class="col-3">
                      <h5 class="text-primary">
                        <a data-toggle="modal" data-target="#socialShare">
                          <i class="fa fa-share-alt"></i>
                        </a>
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @else
            <div class="col-sm-3 mb-3">
              <div class="card promoting-card">
                <div class="view overlay">
                  <iframe width="100%" height="220px" src="https://www.youtube.com/embed/{{ explode('/',$blog->video)[3] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-11">
                      <h5 class="card-title h5-responsive mb-2">{{ substr($blog->title,0,35) }}...</h5>
                    </div>
                    <div class="col-1 pl-0">
                      <div class="dropdown float-right">
                        <a class="fa fa-ellipsis-v dropdown-toggle hide-da" id="image-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="image-action">
                          <a href="#!" class="dropdown-item" onclick="reportBlog('{{ $blog->id }}')"><i class="far fa-comment-alt"></i> Report</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row my-2">
                    <div class="col-12">
                      <span class="badge badge-primary float-left">{{ $blog->category_name }}</span>
                      <p class="card-text float-right"><i class="far fa-clock pr-2"></i>{{ $blog->added_at_date }}</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-3">
                      <h5 class="text-primary">
                        @php
                        $likes = DB::table('blog_likes')
                          ->select('id')
                          ->where('blog_id', $blog->id)
                          ->where('user_id', $auth)
                          ->where('status', 'like')
                          ->get();
                        @endphp

                        @if(sizeof($likes)>0)
                          <a href="#!" class="unlikeBlog_{{ $blog->id }}">
                            <i class="fas fa-thumbs-up" onclick="unLikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                          </a>
                          
                          @else
                          <a href="#!" class="likeBlog_{{ $blog->id }}">
                            <i class="far fa-thumbs-up" onclick="likeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                          </a>
                        @endif

                        @php
                      $total_likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'like')
                        ->get();
                      @endphp
                      <span class="LikeCount_{{ $blog->id }}">{{ sizeof($total_likes) }}</span>
                      </h5>
                    </div>
                    <div class="col-3">
                      <h5 class="text-primary">
                        @php
                        $dislikes = DB::table('blog_likes')
                          ->select('id')
                          ->where('blog_id', $blog->id)
                          ->where('user_id', $auth)
                          ->where('status', 'dislike')
                          ->get();
                        @endphp

                        @if(sizeof($dislikes)>0)
                          <a href="#!" class="undislikeBlog_{{ $blog->id }}">
                            <i class="fas fa-thumbs-down" onclick="unDislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                          </a>
                          @else
                          <a href="#!" class="dislikeBlog_{{ $blog->id }}">
                            <i class="far fa-thumbs-down" onclick="dislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                          </a>
                        @endif

                        @php
                      $total_dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp
                      <span class="DislikeCount_{{ $blog->id }}">{{ sizeof($total_dislikes) }}</span>
                      </h5>
                    </div>
                    <div class="col-3">
                      <h5 class="text-primary">
                        @php
                        $favourites = DB::table('favourites')
                          ->select('id')
                          ->where('blog_id', $blog->id)
                          ->where('user_id', $auth)
                          ->get();
                        @endphp

                        @if(sizeof($favourites)>0)
                          <a href="#!" class="AF_Latest_blog_{{ $blog->id }}">
                            <i class="fas fa-star" onclick="removeFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                          </a>
                          @else
                          <a href="#!" class="RF_Latest_blog_{{ $blog->id }}">
                            <i class="far fa-star" onclick="addFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                          </a>
                        @endif
                      </h5>
                    </div>
                    <div class="col-3">
                      <h5 class="text-primary">
                        <a data-toggle="modal" data-target="#socialShare">
                          <i class="fa fa-share-alt"></i>
                        </a>
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      @endif
    </div>
    <div id="carouselControls3" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="row">
          @php
          $blogs = DB::table('blogs')
            ->select(['blogs.id', 'blogs.title', 'blogs.video', 'blogs.added_at_date', 'categories.category_name'])
            ->join('categories', 'blogs.category', '=', 'categories.id')
            ->where('blogs.category', '4')
            ->orderBy('blogs.views_count', 'DESC')
            ->get();

          $count = 0;
          @endphp

          @foreach($blogs as $blog)
            @php $count++; @endphp
            @if($count>3 && $count<7)
              <div class="col-4">
                <div class="card promoting-card">
                  <div class="view overlay">
                    <iframe width="100%" height="250px" src="https://www.youtube.com/embed/{{ explode('/',$blog->video)[3] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-11">
                        <h5 class="card-title h5-responsive mb-2">{{ substr($blog->title,0,62) }}...</h5>
                      </div>
                      <div class="col-1 pl-0">
                        <div class="dropdown float-right">
                          <a class="fa fa-ellipsis-v dropdown-toggle hide-da" id="image-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="image-action">
                            <a href="#!" class="dropdown-item" onclick="reportBlog('{{ $blog->id }}')"><i class="far fa-comment-alt"></i> Report</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <span class="badge badge-primary float-left">{{ $blog->category_name }}</span>
                        <p class="card-text float-right"><i class="far fa-clock pr-2"></i>{{ $blog->added_at_date }}</p>
                      </div>
                    </div>
                        <div class="row">
                      <div class="col-3">
                        <h5 class="text-primary">
                          @php
                          $likes = DB::table('blog_likes')
                            ->select('id')
                            ->where('blog_id', $blog->id)
                            ->where('user_id', $auth)
                            ->where('status', 'like')
                            ->get();
                          @endphp

                          @if(sizeof($likes)>0)
                            <a href="#!" class="unlikeBlog_{{ $blog->id }}">
                              <i class="fas fa-thumbs-up" onclick="unLikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                            </a>
                            
                            @else
                            <a href="#!" class="likeBlog_{{ $blog->id }}">
                              <i class="far fa-thumbs-up" onclick="likeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                            </a>
                          @endif

                          @php
                      $total_likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'like')
                        ->get();
                      @endphp
                      <span class="LikeCount_{{ $blog->id }}">{{ sizeof($total_likes) }}</span>
                        </h5>
                      </div>
                      <div class="col-3">
                        <h5 class="text-primary">
                          @php
                          $dislikes = DB::table('blog_likes')
                            ->select('id')
                            ->where('blog_id', $blog->id)
                            ->where('user_id', $auth)
                            ->where('status', 'dislike')
                            ->get();
                          @endphp

                          @if(sizeof($dislikes)>0)
                            <a href="#!" class="undislikeBlog_{{ $blog->id }}">
                              <i class="fas fa-thumbs-down" onclick="unDislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                            </a>
                            @else
                            <a href="#!" class="dislikeBlog_{{ $blog->id }}">
                              <i class="far fa-thumbs-down" onclick="dislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                            </a>
                          @endif

                          @php
                      $total_dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp
                      <span class="DislikeCount_{{ $blog->id }}">{{ sizeof($total_dislikes) }}</span>
                        </h5>
                      </div>
                      <div class="col-3">
                        <h5 class="text-primary">
                          @php
                          $favourites = DB::table('favourites')
                            ->select('id')
                            ->where('blog_id', $blog->id)
                            ->where('user_id', $auth)
                            ->get();
                          @endphp

                          @if(sizeof($favourites)>0)
                            <a href="#!" class="AF_Latest_blog_{{ $blog->id }}">
                              <i class="fas fa-star" onclick="removeFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                            </a>
                            @else
                            <a href="#!" class="RF_Latest_blog_{{ $blog->id }}">
                              <i class="far fa-star" onclick="addFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                            </a>
                          @endif
                        </h5>
                      </div>
                      <div class="col-3">
                        <h5 class="text-primary">
                          <a data-toggle="modal" data-target="#socialShare">
                            <i class="fa fa-share-alt"></i>
                          </a>
                        </h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
      <div class="carousel-item">
        <div class="row">
          @php
          $blogs = DB::table('blogs')
            ->select(['blogs.id', 'blogs.title', 'blogs.video', 'blogs.added_at_date', 'categories.category_name'])
            ->join('categories', 'blogs.category', '=', 'categories.id')
            ->where('blogs.category', '4')
            ->orderBy('blogs.views_count', 'DESC')
            ->get();

          $count = 0;
          @endphp

          @foreach($blogs as $blog)
            @php $count++; @endphp
            @if($count>6 && $count<10)
              <div class="col-4">
                <div class="card promoting-card">
                  <div class="view overlay">
                    <iframe width="100%" height="250px" src="https://www.youtube.com/embed/{{ explode('/',$blog->video)[3] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-11">
                        <h5 class="card-title h5-responsive mb-2">{{ substr($blog->title,0,62) }}...</h5>
                      </div>
                      <div class="col-1 pl-0">
                        <div class="dropdown float-right">
                          <a class="fa fa-ellipsis-v dropdown-toggle hide-da" id="image-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="image-action">
                            <a href="#!" class="dropdown-item" onclick="reportBlog('{{ $blog->id }}')"><i class="far fa-comment-alt"></i> Report</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <span class="badge badge-primary float-left">{{ $blog->category_name }}</span>
                        <p class="card-text float-right"><i class="far fa-clock pr-2"></i>{{ $blog->added_at_date }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-3">
                        <h5 class="text-primary">
                          @php
                          $likes = DB::table('blog_likes')
                            ->select('id')
                            ->where('blog_id', $blog->id)
                            ->where('user_id', $auth)
                            ->where('status', 'like')
                            ->get();
                          @endphp

                          @if(sizeof($likes)>0)
                            <a href="#!" class="unlikeBlog_{{ $blog->id }}">
                              <i class="fas fa-thumbs-up" onclick="unLikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                            </a>
                            
                            @else
                            <a href="#!" class="likeBlog_{{ $blog->id }}">
                              <i class="far fa-thumbs-up" onclick="likeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                            </a>
                          @endif

                          @php
                      $total_likes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'like')
                        ->get();
                      @endphp
                      <span class="LikeCount_{{ $blog->id }}">{{ sizeof($total_likes) }}</span>
                        </h5>
                      </div>
                      <div class="col-3">
                        <h5 class="text-primary">
                          @php
                          $dislikes = DB::table('blog_likes')
                            ->select('id')
                            ->where('blog_id', $blog->id)
                            ->where('user_id', $auth)
                            ->where('status', 'dislike')
                            ->get();
                          @endphp

                          @if(sizeof($dislikes)>0)
                            <a href="#!" class="undislikeBlog_{{ $blog->id }}">
                              <i class="fas fa-thumbs-down" onclick="unDislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                            </a>
                            @else
                            <a href="#!" class="dislikeBlog_{{ $blog->id }}">
                              <i class="far fa-thumbs-down" onclick="dislikeBlog('{{ $blog->id }}','{{ $auth }}')"></i>
                            </a>
                          @endif

                          @php
                      $total_dislikes = DB::table('blog_likes')
                        ->select('id')
                        ->where('blog_id', $blog->id)
                        ->where('status', 'dislike')
                        ->get();
                      @endphp
                      <span class="DislikeCount_{{ $blog->id }}">{{ sizeof($total_dislikes) }}</span>
                        </h5>
                      </div>
                      <div class="col-3">
                        <h5 class="text-primary">
                          @php
                          $favourites = DB::table('favourites')
                            ->select('id')
                            ->where('blog_id', $blog->id)
                            ->where('user_id', $auth)
                            ->get();
                          @endphp

                          @if(sizeof($favourites)>0)
                            <a href="#!" class="AF_Latest_blog_{{ $blog->id }}">
                              <i class="fas fa-star" onclick="removeFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                            </a>
                            @else
                            <a href="#!" class="RF_Latest_blog_{{ $blog->id }}">
                              <i class="far fa-star" onclick="addFavourite('{{ $blog->id }}' ,'{{ $auth }}');"></i>
                            </a>
                          @endif
                        </h5>
                      </div>
                      <div class="col-3">
                        <h5 class="text-primary">
                          <a data-toggle="modal" data-target="#socialShare">
                            <i class="fa fa-share-alt"></i>
                          </a>
                        </h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselControls3" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselControls3" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <div class="row mt-3 mb-4">
    <div class="col-3 col-sm-3 col-md-5"></div>
    <div class="col-6 col-sm-6 col-md-2">
      <a href="#" class="btn btn-primary btn-block mb-2">View All</a>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
@endsection