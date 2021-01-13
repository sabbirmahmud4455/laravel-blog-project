@extends('layouts.miniblog')

@section('contant')


<div class="site-section bg-light">
    <div class="container">
        <div class="row align-items-stretch retro-layout-2">
            <div class="col-md-4">
                @if ($home_top_left->count())
                @foreach ($home_top_left as $item)
                <a href="{{route("frontend.single",[$item->id])}}" class="h-entry mb-30 v-height gradient"
                    style="background-image: url('{{asset("images/post/$item->image")}}');">
                    <div class="text">
                        <h2>{{$item->title}}</h2>
                        <span class="date">{{$item->updated_at->diffForHumans()}}</span>
                    </div>
                </a>
                @endforeach
                @else
                <h4>No post Found</h4>
                @endif

            </div>
            <div class="col-md-4">
                @if ($home_top_mid->count())
                @foreach ($home_top_mid as $item)

                <a href="{{route("frontend.single",[$item->id])}}" class="h-entry img-5 h-100 gradient"
                    style="background-image: url('{{asset("images/post/$item->image")}}');">
                    <div class="text">
                        <div class="post-categories mb-3">
                            @foreach ($item->post_tag as $i)
                            <span class="post-category bg-danger">{{$i->name}}</span>
                            @endforeach
                        </div>
                        <h2>{{$item->title}}</h2>
                        <span class="date">{{$item->updated_at->diffForHumans()}}</span>
                    </div>
                </a>
                @endforeach
                @else
                <h4>No Post Found</h4>
                @endif


            </div>
            <div class="col-md-4">
                @if ($home_top_mid->count())
                @foreach ($home_top_right as $item)
                <a href="{{route("frontend.single",[$item->id])}}" class="h-entry mb-30 v-height gradient"
                    style="background-image: url('{{asset("images/post/$item->image")}}');">
                    <div class="text">
                        <h2>{{$item->title}}</h2>
                        <span class="date">{{$item->updated_at->diffForHumans()}}</span>
                    </div>
                </a>
                @endforeach
                @else
                <h4>No Post Found</h4>
                @endif

            </div>
        </div>
    </div>
</div>
<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <h2>Recent Posts</h2>
            </div>
        </div>
        <div class="row">
            @if ($recent_posts)
            @foreach ($recent_posts as $recent_post)
            <div class="col-lg-4 mb-4">
                <div class="entry2">
                    <a href="{{route("frontend.single",[$recent_post->id])}}"><img
                            src="{{asset('images/post')}}/{{$recent_post->image}}" alt="Image"
                            class="img-fluid rounded"></a>
                    <div class="excerpt">
                        @foreach ($recent_post->post_tag as $post_tag)
                        <span class="post-category text-white bg-secondary mb-3">{{$post_tag->name}}</span>
                        @endforeach

                        <h2><a href="single.html">{{$recent_post->title}}</a></h2>
                        <div class="post-meta align-items-center text-left clearfix">
                            <figure class="author-figure mb-0 mr-3 float-left"><img
                                    src="{{asset('miniblog')}}/images/person_1.jpg" alt="Image" class="img-fluid">
                            </figure>
                            <span class="d-inline-block mt-1">By <a href="#">{{$recent_post->user->name}}</a></span>
                            <span>{{$recent_post->updated_at->diffForHumans()}}</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo sunt tempora dolor
                            laudantium sed optio, explicabo ad deleniti impedit facilis fugit recusandae! Illo,
                            aliquid, dicta beatae quia porro id est.</p>
                        <p><a href="#">Read More</a></p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="pagination">{{$recent_posts->links()}}</div>
            @else
            <h4>No post Found</h4>
            @endif

        </div>



        <div class="row text-center pt-5 border-top">
            <div class="col-md-12">
                <div class="custom-pagination">

                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-section bg-light">
    <div class="container">
        <div class="row align-items-stretch retro-layout">
            <div class="col-md-5 order-md-2">
                <a href="single.html" class="hentry img-1 h-100 gradient"
                    style="background-image: url('{{asset("miniblog")}}/images/img_4.jpg');">
                    <span class="post-category text-white bg-danger">Travel</span>
                    <div class="text">
                        <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                        <span>February 12, 2019</span>
                    </div>
                </a>
            </div>
            <div class="col-md-7">
                <a href="single.html" class="hentry img-2 v-height mb30 gradient"
                    style="background-image: url('{{asset("miniblog")}}/images/img_1.jpg');">
                    <span class="post-category text-white bg-success">Nature</span>
                    <div class="text text-sm">
                        <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                        <span>February 12, 2019</span>
                    </div>
                </a>
                <div class="two-col d-block d-md-flex">
                    <a href="single.html" class="hentry v-height img-2 gradient"
                        style="background-image: url('{{asset("miniblog")}}/images/img_2.jpg');">
                        <span class="post-category text-white bg-primary">Sports</span>
                        <div class="text text-sm">
                            <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                            <span>February 12, 2019</span>
                        </div>
                    </a>
                    <a href="single.html" class="hentry v-height img-2 ml-auto gradient"
                        style="background-image: url('{{asset("miniblog")}}/images/img_3.jpg');">
                        <span class="post-category text-white bg-warning">Lifestyle</span>
                        <div class="text text-sm">
                            <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                            <span>February 12, 2019</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-section bg-lightx">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-5">
                <div class="subscribe-1 ">
                    <h2>Subscribe to our newsletter</h2>
                    <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit nesciunt
                        error illum a explicabo, ipsam nostrum.</p>
                    <form action="#" class="d-flex">
                        <input type="text" class="form-control" placeholder="Enter your email address">
                        <input type="submit" class="btn btn-primary" value="Subscribe">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection
