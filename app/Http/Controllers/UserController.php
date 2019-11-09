<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response(User::all());
    }

    public function store(User $user)
    {
        dd($user);
    }

    public function show(Request $request)
    {
        $request->validate([
            'email' => 'required_without:id|email|exist:users,email',
            'id' => 'required_without:email|integer|exist:users,id'
        ]);

        if ($request->has('email')) {
            return User::where('email', $request->get('email'));
        } elseif ($request->has('id')) {
            return User::where('id', $request->get('id'));
        }

        throw new ModelNotFoundException('User not found');
    }
}
