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
                        <div class="card-header">
                            <h3 class="card-title">{{$subject->name}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{route('admin.subject.update',$subject->id)}}">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Subject Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{old('name',$subject->name)}}" placeholder="Subject Name">
                                    @error('name')
                                        <div class="text-red">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="subject_type">Subject Type</label>
                                    <select id="subject_type" class="form-control" name="subject_type">
                                        <option value="theory" @selected($subject->status == 'theory')>Theory</option>
                                        <option value="practical" @selected($subject->status == 'practical')>Practical</option>
                                    </select>
                                    @error('subject_type')
                                        <div class="text-red">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" class="form-control" name="status">
                                        <option value="active" @selected($subject->status == 'active')>Active</option>
                                        <option value="inactive" @selected($subject->status == 'inactive')>Inactive</option>
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
