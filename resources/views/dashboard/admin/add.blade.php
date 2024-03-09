@extends('layouts.app')
@section('title','Add Admin')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Admin</li>
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
                            <h3 class="card-title">Add new Admin</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{route('admin.add')}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name" placeholder="Name">
                                    @error('name')
                                        <div class="text-red">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" value="{{ old('email') }}" name="email"  placeholder="Email">
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
