@extends('layouts.app')
@section('title','Edit Subject')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Subject</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <!-- form start -->
                        <form method="POST" action="{{route('admin.assign.update_status',$classSubject->id)}}">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group col-md-6">
                                    <label for="class_id">Class Name</label>
                                    <select id="class_id" class="form-control" name="class_id">
                                        <option value="">Select Class</option>
                                        @foreach($getClass as $class)
                                            <option value="{{$class->id}}" @selected($class->id == $classSubject->class_model_id)>{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="subject_name">Subject Name</label>
                                    <select id="subject_name" class="form-control" name="subject_id">
                                        <option value="">Select Subject</option>
                                            @foreach($getSubject as $subject)
                                                <option value="{{$subject->id}}" @selected($subject->id == $classSubject->subject_id)>{{$subject->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">Status</label>
                                    <select id="status" class="form-control" name="status">
                                        <option value="active" @selected($classSubject->status == 'active')>Active</option>
                                        <option value="inactive" @selected($classSubject->status == 'inactive')>Inactive</option>
                                    </select>
                                    @error('status')
                                    <div class="text-red">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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
