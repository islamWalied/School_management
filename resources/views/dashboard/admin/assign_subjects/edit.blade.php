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
                        <form method="POST" action="{{route('admin.assign.update',$classSubject->id)}}">
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

                                    @foreach($getSubject as $subject)
                                        @php
                                            $checked = '';
                                        @endphp
                                        @foreach($getAssignSubjectID as $subject_id)
                                            @if($subject_id->subject_id == $subject->id)
                                                @php
                                                    $checked = 'checked';
                                                @endphp
                                            @endif
                                        @endforeach
                                        <div>
                                            <label class="font-weight-normal">
                                                <input {{$checked}} type="checkbox"  name="subject_id[]" value="{{$subject->id}}"> {{$subject->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group">
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
