@extends('layouts.app')
@section('title','Add Subject')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Subject</li>
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
                            <h3 class="card-title">Add new Subject</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{route('admin.subject.add')}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group col-md-6">
                                    <label for="name">Subject Name</label>
                                    <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name" placeholder="Subject Name">
                                    @error('name')
                                        <div class="text-red">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">Subject Type</label>
                                    <select id="status" class="form-control" name="subject_type">
                                        <option value="theory">Theory</option>
                                        <option value="practical">Practical</option>
                                    </select>
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
