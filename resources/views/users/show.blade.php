@extends('layouts.app')

@section('content')
    <div class="container-fluid row">
        <div class="col-md-4">
            <a class="btn btn-default pull-right" href="{{ route('admin::users.index') }}">Back</a>
        </div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <img class="img-responsive" src="{{asset('storage/images/' . $user->image)}}">
                </div>
                <div class="panel-body">
                    <h3 class="text-center text-primary">{{$user->name}}</h3>
                    <hr>
                    <div class="list-group">
                        <div class="list-group-item">
                            <label class="text">Gender</label>
                            <p class="">{{ $user->gender }}</p>
                        </div>
                        <div class="list-group-item">
                            <label class="text">Email</label>
                            <p class="">{{ $user->email }}</p>
                        </div>
                        <div class="list-group-item">
                            <label class="text">Date Of Birth</label>
                            <p class="">{{ $user->dateOfBirth }}</p>
                        </div>
                        <div class="list-group-item">
                            <label class="text">Join On</label>
                            <p class="">{{ $user->created_at }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-info pull-left" href="{{ route('users.edit', ['id' => $user->id]) }}">Update Profile</a>
            <form action="{{route('users.destroy', ['id' => $user->id])}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE">
                @roles('Administrator')
                    <input class="btn btn-danger pull-right" type="submit" value="Delete User">
                @endroles

                @roles('User')
                <input class="btn btn-danger pull-right" type="submit" value="Delete Account">
                @endroles
            </form>
        </div>
    </div>
@endsection