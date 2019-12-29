<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

	public function account()
	{
		if (Auth::guest()) {
			return redirect()->back()->with(['errors' => ['not logged in']]);
		}

		/** @var User $user */
		$user = Auth::user();
		$user->load('addresses');

		return view('frontend.account', compact('user'));
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
