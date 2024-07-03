<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function list()
    {
        $users = User::latest()->paginate(10);
        return view('list_users', compact('users'));
    }
}
