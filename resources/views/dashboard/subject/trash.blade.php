@extends('layouts.app')
@section('title','Trashed Subjects')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Subject</li>
    <li class="breadcrumb-item active">Trashed</li>
@endsection


@section('content')
    <div class="mb-3 text-right">
        <a href="{{route('admin.subject.list')}}" class="btn btn-primary">
            Back
        </a>
    </div>
    <table class="table">
        <x-alert type="info"/>
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Subject Type</th>
            <th scope="col">Status</th>
            <th scope="col">Created By</th>
            <th >Deleted At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($subjects as $subject)
            <tr>
                <th scope="row">{{$subject->id}}</th>
                <td>{{$subject->name}}</td>
                <td>{{$subject->subject_type}}</td>
                <td>{{$subject->status}}</td>
                <td>{{$subject->created_by}}</td>
                <td>{{$subject->deleted_at}}</td>
                <td>
                    <form action="{{route('admin.subject.restore',$subject->id)}}" method="post" style="display: inline-block">
                        @csrf
                        @method('Patch')
                        <button type="submit" class="btn btn btn-info">Restore</button>
                    </form>
                    <form action="{{route('admin.subject.forceDelete',$subject->id)}}" method="post" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

        @empty
            <tr> <td colspan="7">No Subjects Found</td> </tr>
        @endforelse
        </tbody>
    </table>

    {{ $subjects->links() }}
@endsection
