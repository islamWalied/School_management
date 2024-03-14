@extends('layouts.app')
@section('title','Students List')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Students List </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="text-right mb-3">
                <a href="{{route('admin.student.add')}}" class="btn btn-primary">Add New Student</a>
            </div>
                <x-alert type="success"/>
                <x-alert type="danger"/>
            <div class="card">
{{--                <div class="card-header">--}}
{{--                    <h3 class="card-title">Search Admin</h3>--}}
{{--                </div>--}}
{{--                <form method="" action="">--}}
{{--                    @csrf--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="form-group col-md-3">--}}
{{--                                <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Name">--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-3">--}}
{{--                                <input type="email" class="form-control" value="{{ Request::get('email') }}" name="email"  placeholder="Email">--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-3">--}}
{{--                                <input type="date" class="form-control" value="{{ Request::get('date') }}" name="date">--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-md-3">--}}
{{--                                <button type="submit" class="btn btn-primary" >Search</button>--}}
{{--                                <a href="{{route('admin.list')}}" class="btn btn-success">Clear</a>--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <!-- /.card-body -->--}}
{{--                </form>--}}
            </div>
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Students List ( Total: {{$getRecord->total()}} )</h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body p-0 overflow-auto">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Admission Number</th>
                            <th>Admission Date</th>
                            <th>Roll Number</th>
                            <th>Class</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Date Of Birth</th>
                            <th>Religion</th>
                            <th>Phone Number</th>
                            <th>Blood Group</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($getRecord as $value)

                            <tr>
                                <td><a href="{{asset('storage/'.$value->image)}}" ><img src="{{asset('storage/'.$value->image)}}" class="rounded-circle" width="60px" height="60px" alt="image"/></a></td>
                                <td>{{$value->name}}</td>
                                <td >{{$value->email}}</td>
                                <td>{{$value->admission_number}}</td>
                                <td>{{$value->admission_date}}</td>
                                <td>{{$value->roll_number}}</td>
                                <td>{{$value->class_name}}</td>
                                <td>{{$value->gender}}</td>
                                <td>{{$value->status}}</td>
                                <td>{{$value->date_of_birth}}</td>
                                <td>{{$value->religion}}</td>
                                <td>{{$value->phone_number}}</td>
                                <td>{{$value->blood_group}}</td>
                                <td>{{$value->height}}</td>
                                <td>{{$value->weight}}</td>
                                <td>{{date('Y-m-d  h:m:s', strtotime($value->created_at))}}</td>
                                <td style="min-width: 200px">
                                    <a href="{{route('admin.student.edit',$value->id)}}" class="btn btn-info">Edit</a>

                                    <form action="{{route('admin.student.delete',$value->id)}}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn btn-danger">Delete</button>
                                    </form>
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
    {{ $getRecord->withQueryString()->links()}}
@endsection
