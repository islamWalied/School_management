@extends('layouts.app')
@section('title','Parents List')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Parents List </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="text-right mb-3">
                <a href="{{route('admin.parents.add')}}" class="btn btn-primary">Add New Parents</a>
            </div>
                <x-alert type="success"/>
                <x-alert type="danger"/>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search Parents</h3>
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
                                <label for="phone_number">Phone Number</label>
                                <input id="phone_number" type="text" class="form-control" value="{{ Request::get('phone_number') }}" name="phone_number" placeholder="Phone Number">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" value="{{ Request::get('email') }}" name="email"  placeholder="Email">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="occupation">Occupation</label>
                                <input id="occupation" type="text" class="form-control" value="{{ Request::get('occupation') }}" name="occupation" placeholder="Occupation">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="address">Address</label>
                                <input id="address" type="text" class="form-control" value="{{ Request::get('address') }}" name="address" placeholder="Address">
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
                                <a href="{{route('admin.parents.list')}}" class="btn btn-success">Clear</a>
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
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Phone Number</th>
                            <th>Occupation</th>
                            <th>Address</th>
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
                                <td>{{$value->gender}}</td>
                                <td>{{$value->status}}</td>
                                <td>{{$value->phone_number}}</td>
                                <td>{{$value->occupation}}</td>
                                <td>{{$value->address}}</td>
                                <td>{{date('Y-m-d  h:m:s', strtotime($value->created_at))}}</td>
                                <td style="min-width: 200px">
                                    <a href="{{route('admin.parents.edit',$value->id)}}" class="btn btn-info">Edit</a>

                                    <form action="{{route('admin.parents.delete',$value->id)}}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn btn-danger">Delete</button>
                                    </form>
                                    <a href="{{route('admin.parents.my_student',$value->id)}}" class="btn btn-primary">My Student</a>

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
