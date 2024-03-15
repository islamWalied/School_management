@extends('layouts.app')
@section('title','Edit Parents')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Parents</li>
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
                            <h3 class="card-title">Edit {{$getRecord->name}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{route('admin.parents.update',$getRecord->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" id="name" value="{{ old('name',$getRecord->name) }}" name="name" placeholder="First Name">
                                        @error('name')
                                        <div class="text-red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" value="{{ old('last_name',$getRecord->last_name) }}" name="last_name" placeholder="Last Name">
                                        @error('name')
                                        <div class="text-red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="gender">Gender</label>
                                        <select id="gender" class="form-control" name="gender">
                                            <option value="">Select Gender</option>
                                            <option {{old('gender',$getRecord->gender) == 'male' ? 'selected' : ''}} value="male">Male</option>
                                            <option {{old('gender',$getRecord->gender) == 'female' ? 'selected' : ''}} value="female">Female</option>
                                        </select>
                                        @error('gender')
                                        <div class="text-red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="status">Status</label>
                                        <select id="status" class="form-control" name="status">
                                            <option value="">Select Status</option>
                                            <option {{old('status',$getRecord->status) == 'active' ? 'selected' : ''}} value="active">Active</option>
                                            <option {{old('status',$getRecord->status) == 'inactive' ? 'selected' : ''}}  value="inactive">Inactive</option>
                                        </select>
                                        @error('status')
                                        <div class="text-red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone_number">Mobile Number</label>
                                        <input type="text" class="form-control" id="phone_number" value="{{ old('phone_number',$getRecord->phone_number) }}" name="phone_number" placeholder="Mobile Number">
                                        @error('phone_number')
                                        <div class="text-red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="occupation">Occupation</label>
                                        <input type="text" class="form-control" id="occupation" value="{{ old('occupation',$getRecord->occupation) }}" name="occupation" placeholder="Occupation">
                                        @error('occupation')
                                        <div class="text-red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" value="{{ old('address',$getRecord->address) }}" name="address" placeholder="Address">
                                        @error('address')
                                        <div class="text-red">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="profile_picture">Profile Picture</label>
                                        <input type="file" class="form-control" id="profile_picture" name="image">
                                        @error('image')
                                        <div class="text-red">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" value="{{ old('email',$getRecord->email) }}" name="email"  placeholder="Email">
                                    @error('email')
                                    <div class="text-red">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"  placeholder="Password">
                                    @error('password')
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
