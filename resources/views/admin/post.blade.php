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
          height: 200
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
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Posts</li>
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
                        <h3 class="card-title">All Post</h3>
                        <button type="button" class="ml-auto btn btn-outline-primary" data-toggle="modal"
                            data-target="#add_post_form_model">
                            New Post
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Title</th>
                                    <th>Tag</th>
                                    <th>Category</th>
                                    <th>Images</th>
                                    <th>Publish time</th>
                                    <th>User</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="post_list_tbody">
                                @php
                                $sl=1;
                                @endphp
                                @foreach ($posts as $post)
                                <tr>
                                    <td>{{$sl ++}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>
                                        @foreach ($post->post_tag as $tag)
                                            <span class="badge badge-primary">{{$tag->name}}</span>
                                        @endforeach
                                    </td>
                                    <td>{{$post->category->name}}</td> 
                                    <td><img src="{{asset('images/post').'/'.$post->image}}" style="max-width: 60px" alt="img"></td>
                                    <td>{{$post->publish_at}}</td>
                                    <td>{{$post->user->name}}</td>
                                    <td class="d-flex">
                                        <span>
                                            <a href="{{ route('post.show',[$post->id])}}" class="btn btn-link" ><i
                                                  
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                        <span>
                                            <a href="{{ route('post.edit',[$post->id])}}" class="btn btn-link" ><i
                                                    class="fas fa-pencil-alt text-info" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                        <span>
                                            <form action="{{route('post.destroy',[$post->id])}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link"><i class="fa fa-trash text-danger"
                                                    aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">«</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <!-- /.card -->

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>





{{-- add post model --}}
<div class="modal fade" id="add_post_form_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="" action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" class="form-control" name="title" id="post_title" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label for="post_category">Category</label>
                        <select class="form-control" name="category" id="">
                            <option value="" selected style="display: none">Select Option</option>
                            @foreach ($categorys as $item)
                            <option value="{{$item->id}}">{{$item->name}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tags</label>
                        <div class="d-flex flex-wrap">
                            @foreach ($tags as $item)
                                    <div class="m-2">
                                        <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="tags[]" type="checkbox" id="tag{{$item->id}}" value="{{$item->id}}">
                                        <label for="tag{{$item->id}}" class="custom-control-label">{{$item->name}}</label>
                                    </div>
                              </div>
                            @endforeach
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label for="featured_img">Featured Image </label>
                        <input class=" form-control-file" type="file" name="image" id="featured_img">
                    </div>
                    <div class="form-group">
                        <label for="catagory_description">Description</label>
                        <textarea class="form-control" name="description" id="catagory_description" rows="3"
                            placeholder="Enter Description"></textarea>
                    </div>
                    <input class="btn btn-block btn-primary" type="submit" value="Publish">
                </form>
            </div>
        </div>
    </div>
</div>



<!-- /.Main content -->

@endsection




