@extends('layouts.app')
@section('title','Class List')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Class List</li>
@endsection
@section('content')
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right mb-3">
                            <a href="{{route('admin.class.trash')}}" class="btn btn-secondary">Trash</a>
                            <a href="{{route('admin.class.add')}}" class="btn btn-primary">Add New Class</a>
                        </div>
                        <div class="card">
                            <x-alert type="success"/>
                            <x-alert type="danger"/>
                            <div class="card-header">
                                <h3 class="card-title">Search Classes</h3>
                            </div>
                            <form method="" action="">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <input type="text" class="form-control" value="{{ Request::get('class_name') }}" name="class_name" placeholder="Class Name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select id="status" class="form-control" name="status">
                                                <option value="active" @selected(request('status') == 'active')>Active</option>
                                                <option value="inactive" @selected(request('status') == 'inactive')>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button type="submit" class="btn btn-primary" >Search</button>
                                            <a href="{{route('admin.class.list')}}" class="btn btn-success">Clear</a>
                                        </div>

                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                        <div class="card">

                            <div class="card-header">
                                <h3 class="card-title">Class List</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped text-center">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
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
                                            <td>{{$value->status}}</td>
                                            <td>{{$value->created_by_name}}</td>
                                            <td>
                                                <a href="{{route('admin.class.edit',$value->id)}}" class="btn btn-info">Edit</a>

                                                <form action="{{route('admin.class.delete',$value->id)}}" method="post" style="display: inline-block">
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
