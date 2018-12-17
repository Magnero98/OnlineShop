@extends('layouts.app')

@section('content')
    <div class="container-fluid row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Join On</th>
                <th>Show</th>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @if($user->role->name == 'Administrator')
                        <tr class="success">
                    @elseif($user->role->name == 'User')
                        <tr>
                    @endif
                        <td><img class="img-circle center-block" src="{{asset('storage/images/' . $user->image)}}" style="height: 45px;"></td>
                        <td >{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td><a class="btn btn-primary center-block" href="{{route('users.show', ['id' => $user->id])}}">Show Details</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$users->links()}}
    </div>
    </div>
@endsection