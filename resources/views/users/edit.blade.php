@extends('layouts.app')

@section('content')
    <div class="container-fluid row">
        <div class="col-md-4">
            <a class="btn btn-default pull-right" href="{{ route('users.show', ['id' => $user->id]) }}">Back</a>
        </div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <img class="img-circle center-block" src="{{asset('storage/images/' . $user->image)}}" style="height: 150px">
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('users.update', ['id' => $user->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date-of-birth" class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6">
                                <select class="form-control" name="gender">
                                    @if($user->gender == 'Male')
                                        <option selected="true">Male</option>
                                        <option>Female</option>
                                    @else
                                        <option>Male</option>
                                        <option selected="false">Female</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date-of-birth" class="col-md-4 control-label">Date of Birth</label>

                            <div class="col-md-6">
                                <input id="date-of-birth" type="date" class="form-control" name="dateOfBirth" value="{{ $user->dateOfBirth }}" required>
                            </div>
                        </div>

                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection