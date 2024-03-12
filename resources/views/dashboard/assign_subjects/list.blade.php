@extends('layouts.app')
@section('title','Subject Assign List')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Subject Assign List</li>
@endsection
@section('content')
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right mb-3">
                            <a href="{{route('admin.assign.add')}}" class="btn btn-primary">Assign New</a>
                        </div>
                        <div class="card">
                            <x-alert type="success"/>
                            <x-alert type="danger"/>
                            <div class="card-header">
                                <h3 class="card-title">Search Assign Subjects</h3>
                            </div>
                            <form method="" action="">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <input type="text" class="form-control" value="{{ Request::get('subject_name') }}" name="subject_name" placeholder="Subject Name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input type="text" class="form-control" value="{{ Request::get('class_name') }}" name="class_name" placeholder="Class Name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <input type="date" class="form-control" value="{{ Request::get('date') }}" name="date">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button type="submit" class="btn btn-primary" >Search</button>
                                            <a href="{{route('admin.assign.list')}}" class="btn btn-success">Clear</a>
                                        </div>

                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                        <div class="card">

                            <div class="card-header">
                                <h3 class="card-title">Subject List</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped text-center">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Class Name</th>
                                        <th>Subject Name</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($getRecord as $value)

                                        <tr>
                                            <td>{{$value->id}}</td>
                                            <td>{{$value->class_name}}</td>
                                            <td>{{$value->subject_name}}</td>
                                            <td>{{$value->status}}</td>
                                            <td>{{$value->created_by_name}}</td>
                                            <td>{{date('Y-m-d  h:m:s', strtotime($value->created_at))}}</td>
                                            <td>
                                                <a href="{{route('admin.assign.edit',$value->id)}}" class="btn btn-info">Edit</a>

                                                <form action="{{route('admin.assign.delete',$value->id)}}" method="post" style="display: inline-block">
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
