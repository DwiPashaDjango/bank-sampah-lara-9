@extends('layouts.frontend.app',[
	'title' => 'Detail gallery',
])
 <h2>Images for gallery : <span class="text-primary">{{$gallery->title}}</span> </h2>
 <a href="/" class="btn btn-primary">Go Back</a>
 <div class="row mt-4">
   @foreach ($image as $image)
       <div class="col-md-3">
         <div class="card text-white bg-secondary mb-3" style="max-width: 20rem;">
           <div class="card-body">
             <img src="/photo_image/{{$image->image}}" class="card-img-top">
           </div>
         </div>
       </div>
   @endforeach
 </div>
@endsection

                                        <!-- Tags -->
                    <!-- <div class="post-tags">
                        <ul>
                            <li><a href="#">Manual</a></li>
                            <li><a href="#">Liberty</a></li>
                            <li><a href="#">Interpritation</a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="related-posts section-padding-100-0">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-6">
                    <div class="single-blog-area mb-100">
                        <img src="{{ asset('templates/frontend/clever') }}/img/blog-img/3.jpg" alt="">
                        
                        <div class="blog-content">
                            <a href="#" class="blog-headline">
                                <h4>English Grammer</h4>
                            </a>
                            <div class="meta d-flex align-items-center">
                                <a href="#">Sarah Parker</a>
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                <a href="#">Art &amp; Design</a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim nulla, mollis eu metus in, sagittis</p>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-lg-6">
                    <div class="single-blog-area mb-100">
                        <img src="{{ asset('templates/frontend/clever') }}/img/blog-img/4.jpg" alt="">
                        
                        <div class="blog-content">
                            <a href="#" class="blog-headline">
                                <h4>English Grammer</h4>
                            </a>
                            <div class="meta d-flex align-items-center">
                                <a href="#">Sarah Parker</a>
                                <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                                <a href="#">Art &amp; Design</a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim nulla, mollis eu metus in, sagittis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-12 col-lg-6">
                <div class="post-a-comments mb-70">
                    <h4>Post a Comment</h4>

                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="text" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn clever-btn w-100">Post A Comment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            
            <div class="col-12 col-lg-6">
                <div class="comments-area">
                    <h4>Comments (12)</h4>

                    <ol class="comments-list">

                        <li class="single_comment_area">
                            
                            <div class="single-comment-wrap mb-30">
                                <div class="d-flex justify-content-between mb-30">

                                    <div class="comment-admin d-flex">
                                        <div class="thumb">
                                            <img src="{{ asset('templates/frontend/clever') }}/img/bg-img/t1.png" alt="">
                                        </div>
                                        <div class="text">
                                            <h6>Sarah Parker</h6>
                                            <span>Sep 29, 2017 at 9:48 am</span>
                                        </div>
                                    </div>

                                    <div class="reply">
                                        <a href="#">Reply</a>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim nulla, mollis eu metus in, sagittis.</p>
                            </div>

                            <ol class="children">
                                <li class="single_comment_area">
                                    
                                    <div class="single-comment-wrap">
                                        <div class="d-flex justify-content-between mb-30">
                                            
                                            <div class="comment-admin d-flex">
                                                <div class="thumb">
                                                    <img src="{{ asset('templates/frontend/clever') }}/img/bg-img/t2.png" alt="">
                                                </div>
                                                <div class="text">
                                                    <h6>Sarah Parker</h6>
                                                    <span>Sep 29, 2017 at 9:48 am</span>
                                                </div>
                                            </div>
        
                                            <div class="reply">
                                                <a href="#">Reply</a>
                                            </div>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim nulla, mollis eu metus in, sagittis.</p>
                                    </div>
                                </li>
                            </ol>
                        </li>

                        <li class="single_comment_area mb-30">
                            
                            <div class="single-comment-wrap">
                                <div class="d-flex justify-content-between mb-30">
                                    
                                    <div class="comment-admin d-flex">
                                        <div class="thumb">
                                            <img src="{{ asset('templates/frontend/clever') }}/img/bg-img/t3.png" alt="">
                                        </div>
                                        <div class="text">
                                            <h6>Sarah Parker</h6>
                                            <span>Sep 29, 2017 at 9:48 am</span>
                                        </div>
                                    </div>

                                    <div class="reply">
                                        <a href="#">Reply</a>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim nulla, mollis eu metus in, sagittis.</p>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="col-12">
                <div class="load-more text-center mt-50">
                    <a href="#" class="btn clever-btn btn-2">Load More</a>
                </div>
            </div>
        </div>
    </div> -->
</div>
@stop