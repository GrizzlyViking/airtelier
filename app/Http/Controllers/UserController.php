<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

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

	public function account(Request $user)
	{
		/** @var User $user */
		$user = Auth::user();
		$user->load('addresses');

		return view('frontend.account', compact('user'));
    }

	public function update(Request $request)
	{
		/** @var User $user */
		$user = Auth::user();
		$user->update($request->all());

		if ($address = $user->addresses->first()) {
			$address->update($request->all());
		} else {
			$address = Address::create($request->all());
			$user->addresses()->attach($address);
		}

		return redirect()->back()->with(['success' => ['account updated.']]);
    }

    public function show(User $user)
    {
    	if (request()->route()->named('frontend.account.show')) {
			$user = Auth::user();
			$user->load('addresses');

			return view('frontend.account', compact('user'));
		}

    	return $user;
    }
}
