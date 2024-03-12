@extends('layouts.app')
@section('title','Assign Subjects to Classes')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Subject</li>
    <li class="breadcrumb-item active">Assign</li>
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
                            <h3 class="card-title">Assign Subjects</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{route('admin.assign.add')}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group col-md-6">
                                    <label for="class_id">Class Name</label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">Select Class</option>
                                        @foreach($getClass as $class)
                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="subject_name">Subject Name</label>
                                    @foreach($getSubject as $subject)
                                        <div>
                                            <label class="font-weight-normal">
                                                <input type="checkbox"  name="subject_id[]" value="{{$subject->id}}"> {{$subject->name}}
                                            </label>
                                        </div>
                                    @endforeach
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
