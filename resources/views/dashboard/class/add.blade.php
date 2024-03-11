@extends('layouts.app')
@section('title','Add Class')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Class</li>
    <li class="breadcrumb-item active">Add</li>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add new Class</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{route('admin.class.add')}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group col-md-6">
                                    <label for="class_name">Class Name</label>
                                    <input type="text" class="form-control" id="class_name" value="{{ old('class_name') }}" name="class_name" placeholder="Class Name">
                                    @error('class_name')
                                        <div class="text-red">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">Status</label>
                                    <select id="status" class="form-control" name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
