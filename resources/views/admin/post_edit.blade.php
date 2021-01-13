@extends('layouts.admin')

 

@section('style')
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/summernote/summernote-bs4.min.css">
@endsection
@section('script')
    <script src="{{asset('admin')}}/plugins/summernote/summernote-bs4.min.js"></script>
    <script>
        $('#catagory_description').summernote({
          placeholder: 'Description',
          tabsize: 2,
          height: 300
        });
      </script>
@endsection

@section('main_content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 d-flex">
                <h1 class="m-0 text-dark">Posts</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/dashboard/post">Posts</a></li>
                    <li class="breadcrumb-item active">Edit Post</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex">
                        <h3 class="card-title">Edit Post</h3>
                        
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form id="edit_post_form" action="{{route('post.update',[$post->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="post_title">Title</label>
                                <input type="text" class="form-control" name="title" id="post_title" placeholder="Enter Title" value="{{$post->title}}">
                            </div>
                            <div class="form-group">
                                <label for="post_category">Category</label>
                                <select class="form-control" name="category" id="post_category">
                                    @foreach ($categorys as $item)
                                    <option @if ($item->id==$post->category->id) selected @endif value="{{$item->id}}">{{$item->name}} </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Tags</label>
                                <div class="d-flex flex-wrap">
                                    @foreach ($tags as $item)
                                            <div class="m-2">
                                                <div class="custom-control custom-checkbox">
                                                <input @foreach ($post->post_tag as $post_tag)  @if ($item->id==$post_tag->id) checked @endif   @endforeach class="custom-control-input" name="tags[]" type="checkbox" id="tag{{$item->id}}" value="{{$item->id}}">
                                                <label for="tag{{$item->id}}" class="custom-control-label">{{$item->name}}</label>
                                            </div>
                                      </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="featured_img">Featured Image</label>
                                <div class=" d-flex">
                                    <input class="form-control-file" type="file" name="image" id="featured_img">
                                   
                                    @if ($post->image)
                                        <img src="{{asset('images/post').'/'.$post->image}}" class="ml-auto" style="max-width: 100px;" alt="img">
                                    @else
                                        <span>No image found</span>
                                    @endif
                                
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catagory_description">Description</label>
                                <textarea id="catagory_description"  class="form-control" name="description" rows="3"
                                    >{{$post->description}}</textarea>
                            </div>
                            <input class="btn btn-block btn-primary" type="submit" value="Update">
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <!-- /.card -->

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>




<!-- /.Main content -->














@endsection
