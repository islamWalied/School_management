@extends('layouts.app')
@section('title','Trashed Class')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Class</li>
    <li class="breadcrumb-item active">Trashed</li>
@endsection


@section('content')
    <div class="mb-3 text-right">
        <a href="{{route('admin.class.list')}}" class="btn btn-primary">
            Back
        </a>
    </div>
    <table class="table">
        <x-alert type="info"/>
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Status</th>
            <th scope="col">Created By</th>
            <th >Deleted At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($classes as $class)
            <tr>
                <th scope="row">{{$class->id}}</th>
                <td>{{$class->name}}</td>
                <td>{{$class->status}}</td>
                <td>{{$class->created_by}}</td>
                <td>{{$class->deleted_at}}</td>
                <td>
                    <form action="{{route('admin.class.restore',$class->id)}}" method="post" style="display: inline-block">
                        @csrf
                        @method('Patch')
                        <button type="submit" class="btn btn btn-info">Restore</button>
                    </form>
                    <form action="{{route('admin.class.forceDelete',$class->id)}}" method="post" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

        @empty
            <tr> <td colspan="7">No Classes Found</td> </tr>
        @endforelse
        </tbody>
    </table>

    {{ $classes->links() }}
@endsection
