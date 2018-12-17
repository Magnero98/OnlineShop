<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\Deletion;

class UserController extends Controller
{
    use Deletion;

    public function __construct()
    {
        $this->middleware('isUserProfile')
            ->only(['show', 'edit']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', '0')->paginate(5);

        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('users.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->dateOfBirth = $request->dateOfBirth;
        $user->save();

        if(Auth::user()->role->name == 'Administrator')
            return redirect(route('admin::users.index'));
        else if(Auth::user()->role->name == 'User')
            return redirect(route('users.show', ['id' => Auth::user()->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->deleteUser($id);

        if(Auth::user()->role->name == 'Administrator')
        {
            return redirect(route('users.index'));
        }
        else if(Auth::user()->role->name == 'User')
        {
            Auth::logout();
            return redirect(route('login'));
        }
    }
}
