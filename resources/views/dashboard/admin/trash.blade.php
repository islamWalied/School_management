@extends('layouts.app')
@section('title','Admin')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Admin</li>
    <li class="breadcrumb-item active">Trashed</li>
@endsection


@section('content')
    <div class="mb-3 text-right">
        <a href="{{route('admin.list')}}" class="btn btn-primary">
            Back
        </a>
    </div>
    <table class="table">
        <x-alert type="info"/>
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Created At</th>
            <th >Deleted At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->deleted_at}}</td>
                <td>
                    <form action="{{route('admin.restore',$user->id)}}" method="post" style="display: inline-block">
                        @csrf
                        @method('Patch')
                        <button type="submit" class="btn btn btn-info">Restore</button>
                    </form>
                    <form action="{{route('admin.forceDelete',$user->id)}}" method="post" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

        @empty
            <tr> <td colspan="7">No Admins Found</td> </tr>
        @endforelse
        </tbody>
    </table>

    {{ $users->links() }}
@endsection
