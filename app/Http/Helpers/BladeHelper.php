<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/3/2018
 * Time: 10:50 AM
 */
use Illuminate\Support\Facades\Auth;

if(!function_exists('roles'))
{
    function roles($roles)
    {
        $user = Auth::user();

        if($user != null)
        {
            $userRole = $user->role->name;
            if(is_array($roles) ? in_array($userRole, $roles) : $userRole == $roles)
                return true;
        }

        return false;
    }
}

if(!function_exists('endroles'))
{
    function endroles()
    {
        return "endif";
    }
}