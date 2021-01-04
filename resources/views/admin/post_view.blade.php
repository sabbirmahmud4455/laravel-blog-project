@extends('layouts.admin')

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
                    <li class="breadcrumb-item"><a href="/dashboard/post">Posts</a></li>
                    <li class="breadcrumb-item active">Single Post</li>
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
                        <h3 class="card-title">Post</h3>
                        
                        <a class="ml-auto btn btn-outline-primary" href="/dashboard/post">Posts list</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">

                            <tbody id="post_list_tbody">
                                <tr>
                                    <td scope="row" style="width: 200px">Image</td>
                                    <td> <img style="max-width: 200px" src="{{asset("images/post")."/".$post->image}}"
                                            alt="Image"></td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 200px">Title</td>
                                    <td>{{$post->title}}</td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 200px">Category</td>
                                    <td>{{$post->category->name}}</td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 200px">Tags</td>
                                    <td>
                                        @foreach ($post->post_tag as $item)
                                        <span class=" badge badge-primary">{{$item->name}}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" style="width: 200px">Description</td>
                                    <td>{!!$post->description!!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

            <!-- /.card -->

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>






<!-- /.Main content -->

@endsection
