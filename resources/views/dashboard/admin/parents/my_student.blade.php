@extends('layouts.app')
@section('title','Parent Students List ' . $getParent->name)
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Parent Students List</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
                <x-alert type="success"/>
                <x-alert type="danger"/>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search Student</h3>
                </div>
                <form method="" action="">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="student_id">Student ID</label>
                                <input id="student_id" type="text" class="form-control" value="{{ Request::get('student_id') }}" name="student_id" placeholder="Student ID">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" class="form-control" value="{{ Request::get('last_name') }}" name="last_name" placeholder="Last Name">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" value="{{ Request::get('email') }}" name="email"  placeholder="Email">
                            </div>
                            <div class="form-group col-md-3 mt-auto">
                                <button type="submit" class="btn btn-primary" >Search</button>
                                <a href="{{route('admin.parents.my_student',$parent_id->id)}}" class="btn btn-success">Clear</a>
                            </div>

                        </div>

                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
            @if(!empty($getSearchStudents))
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Parent Students List ( Total:  )</h3>
                    </div>
                <div class="card-body p-0 overflow-auto">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Parent Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($getSearchStudents as $value)

                            <tr>
                                <td>{{$value->id}}</td>
                                <td><a href="{{asset('/storage/'.$value->image)}}" ><img src="{{asset('storage/'.$value->image)}}" class="rounded-circle" width="60px" height="60px" alt="image"/></a></td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->last_name}}</td>
                                <td>{{$value->parent_name}}</td>
                                <td >{{$value->email}}</td>

                                <td>{{date('Y-m-d  h:m:s', strtotime($value->created_at))}}</td>
                                <td style="min-width: 200px">
                                    <a href="{{route('admin.student.assign_student_parent',[$value->id,$parent_id->id])}}" class="btn btn-info">Add Student to Parent</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            @endif
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Parent Students List ( Total:  )</h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body p-0 overflow-auto">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Parent Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($getRecord as $value)

                            <tr>
                                <td>{{$value->id}}</td>
                                <td><a href="{{asset('/storage/'.$value->image)}}" ><img src="{{asset('storage/'.$value->image)}}" class="rounded-circle" width="60px" height="60px" alt="image"/></a></td>
                                <td>{{$value->name}} {{$value->last_name}}</td>
                                <td>{{$value->parent_name}}</td>
                                <td >{{$value->email}}</td>

                                <td>{{date('Y-m-d  h:m:s', strtotime($value->created_at))}}</td>
                                <td style="min-width: 200px">
                                    <a href="{{route('admin.student.delete_student_parent',$value->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
{{--    {{ $getRecord->withQueryString()->links()}}--}}
@endsection
