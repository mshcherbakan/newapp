<?php

namespace App\Http\Controllers;

use App\Jobs\DownloadUserApi;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        if (null != $request->input('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }
        $users = $query
            ->orderBy('name')
            ->paginate(1);

        return view('users.index', compact('users'));
    }
}
