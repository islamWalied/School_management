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
                <div class="card-header">
                    <h3 class="card-title">Search Admin</h3>
                </div>
                <form method="" action="">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" class="form-control" value="{{ Request::get('last_name') }}" name="last_name" placeholder="Last Name">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="admission_number">Admission Number</label>
                                <input id="admission_number" type="text" class="form-control" value="{{ Request::get('admission_number') }}" name="admission_number" placeholder="Admission Number">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="gender">Admission Date</label>
                                <input id="admission_date" type="date" class="form-control" value="{{ Request::get('admission_date') }}" name="admission_date" placeholder="Admission Date">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="date_of_birth">Dat Of Birth</label>
                                <input id="date_of_birth" type="date" class="form-control" value="{{ Request::get('date_of_birth') }}" name="date_of_birth">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="roll_number">Roll Number</label>
                                <input id="roll_number" type="text" class="form-control" value="{{ Request::get('roll_number') }}" name="roll_number" placeholder="Roll Number">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="religion">Religion</label>
                                <input id="religion" type="text" class="form-control" value="{{ Request::get('religion') }}" name="religion" placeholder="Religion">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="phone_number">Phone Number</label>
                                <input id="phone_number" type="text" class="form-control" value="{{ Request::get('phone_number') }}" name="phone_number" placeholder="Phone Number">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="blood_group">Blood Group</label>
                                <input id="blood_group" type="text" class="form-control" value="{{ Request::get('blood_group') }}" name="blood_group" placeholder="Blood Group">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="height">Height</label>
                                <input id="height" type="text" class="form-control" value="{{ Request::get('height') }}" name="height"  placeholder="Height">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="weight">Weight</label>
                                <input id="weight" type="text" class="form-control" value="{{ Request::get('weight') }}" name="weight"  placeholder="Weight">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" value="{{ Request::get('email') }}" name="email"  placeholder="Email">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="class">Classes</label>
                                <select id="class" class="form-control" name="class_model_id">
                                    <option value="">Select Class</option>
                                    @foreach($getClass as $class)
                                        <option @selected(Request::get('class_model_id')  == $class->name) value="{{$class->name}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="gender">Gender</label>
                                <select id="gender" class="form-control" name="gender">
                                    <option value="">Select Gender</option>
                                    <option {{Request::get('gender') == 'male' ? 'selected' : ''}} value="male">Male</option>
                                    <option {{Request::get('gender') == 'female' ? 'selected' : ''}} value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="status">Status</label>
                                <select id="status" class="form-control" name="status">
                                    <option value="">Select Status</option>
                                    <option {{Request::get('status') == 'active' ? 'selected' : ''}} value="active">Active</option>
                                    <option {{Request::get('status') == 'inactive' ? 'selected' : ''}} value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 mt-auto">
                                <button type="submit" class="btn btn-primary" >Search</button>
                                <a href="{{route('admin.student.list')}}" class="btn btn-success">Clear</a>
                            </div>

                        </div>

                    </div>
                    <!-- /.card-body -->
                </form>
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
