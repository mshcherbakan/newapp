<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return User::all();
    }

    public function create(Request $request)
    {
        $password = Hash::make($request->input('password'));

        User::create(
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $password
            ]
        );

        return 'OK';
    }

    public function delete(User $user)
    {
        $user->delete();
        echo 'OK';
    }
}
