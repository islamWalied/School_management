@extends('layouts.app')
@section('title','Admin List')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Admin List</li>
@endsection
@section('content')
                <div class="row">
                    <div class="col-md-12">
                        <div class="div text-right  mb-3">
                            <a href="{{route('admin.add')}}" class="btn btn-primary">Add New Admin</a>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Admin List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped text-center">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($getRecord as $value)

                                        <tr>
                                            <td>{{$value->id}}</td>
                                            <td>{{$value->name}}</td>
                                            <td>{{$value->email}}</td>
                                            <td>{{$value->created_at}}</td>
                                            <td>
                                                <a href="{{route('admin.edit',$value->id)}}" class="btn btn-info">Edit</a>

                                                <form action="{{route('admin.delete',$value->id)}}" method="post" style="display: inline-block">
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
@endsection
