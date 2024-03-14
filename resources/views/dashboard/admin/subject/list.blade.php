@extends('layouts.app')
@section('title','Subject List')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Subject List</li>
@endsection
@section('content')
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right mb-3">
                            <a href="{{route('admin.subject.trash')}}" class="btn btn-secondary">Trash</a>
                            <a href="{{route('admin.subject.add')}}" class="btn btn-primary">Add New Subject</a>
                        </div>
                        <div class="card">
                            <x-alert type="success"/>
                            <x-alert type="danger"/>
                            <div class="card-header">
                                <h3 class="card-title">Search Subjects</h3>
                            </div>
                            <form method="" action="">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <input type="text" class="form-control" value="{{ Request::get('subject_name') }}" name="subject_name" placeholder="Subject Name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select id="status" class="form-control" name="status">
                                                <option value="active" @selected(request('status') == 'active')>Active</option>
                                                <option value="inactive" @selected(request('status') == 'inactive')>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select id="subject_type" class="form-control" name="subject_type">
                                                <option value="theory" @selected(request('subject_type') == 'theory')>Theory</option>
                                                <option value="practical" @selected(request('subject_type') == 'practical')>Practical</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button type="submit" class="btn btn-primary" >Search</button>
                                            <a href="{{route('admin.subject.list')}}" class="btn btn-success">Clear</a>
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
                                        <th>Name</th>
                                        <th>Subject Type</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($getRecord as $value)

                                        <tr>
                                            <td>{{$value->id}}</td>
                                            <td>{{$value->name}}</td>
                                            <td>{{$value->subject_type}}</td>
                                            <td>{{$value->status}}</td>
                                            <td>{{$value->created_by_name}}</td>
                                            <td>
                                                <a href="{{route('admin.subject.edit',$value->id)}}" class="btn btn-info">Edit</a>

                                                <form action="{{route('admin.subject.delete',$value->id)}}" method="post" style="display: inline-block">
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
