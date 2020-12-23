@extends('layouts.admin')

@section('main_content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 d-flex">
                <h1 class="m-0 text-dark">Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Categorys</li>
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
                        <h3 class="card-title">All Category</h3>
                        <button type="button" class="ml-auto btn btn-outline-primary" data-toggle="modal"
                            data-target="#add_category_form_model">
                            New Category
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Slag</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="catagory_list_tbody">
                                
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







{{-- add category model --}}
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="add_category_form_model" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_categorys_form">
                    <div class="form-group">
                        <label for="catagory_name">Name</label>
                        <input type="text" class="form-control" name="catagory_name" id="catagory_name"
                            placeholder="Enter Catagory">
                            <span class=" text-danger" id="catagory_name_alrt"></span>
                    </div>
                    <div class="form-group">
                        <label for="catagory_slag">Slag</label>
                        <input type="text" class="form-control" name="catagory_slag" id="catagory_slag" placeholder="Enter Slag">
                        <span class=" text-danger" id="catagory_slag_alrt"></span>
                    </div>
                    <div class="form-group">
                        <label for="catagory_description">Description</label>
                        <textarea class="form-control" name="catagory_description" id="catagory_description" rows="3"
                            placeholder="Enter Slag"></textarea>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>







<!-- /.Main content -->














@endsection
