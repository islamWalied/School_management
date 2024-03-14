@extends('layouts.app')
@section('title','Change Password')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Profile</li>
    <li class="breadcrumb-item active">Change Password</li>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <x-alert type="success"/>
                    <x-alert type="danger"/>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <!-- /.card-header -->
                        @php
                            $type =  \Illuminate\Support\Facades\Auth::user()->user_type
                        @endphp

                        <!-- form start -->
                        <form method="POST" action="{{route($type . '.update-password')}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group col-md-6">
                                    <label for="old_password">Old Password</label>
                                    <input type="password" class="form-control" id="old_password" value="{{ old('old_password') }}" name="old_password" placeholder="Old Password">
                                    @error('old_password')
                                    <div class="text-red">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="new_password">New Password</label>
                                    <input type="password" class="form-control" id="new_password" value="{{ old('new_password') }}" name="new_password" placeholder="New Password">
                                    @error('new_password')
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
