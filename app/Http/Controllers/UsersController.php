<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function dashboard()
    {
        $user = User::all();

        return view('users.dashboard', [
            'users' => $user
        ]);
    }

    public function formSignup()
    {
        return view('auth.signup');
    }

    public function processSignup(Request $request)
    {
        $request->validate(User::$rules, User::$errorMessages);

        $data = $request->except(['_token']);
        $data['password'] = Hash::make($data['password']);
        $cart = Cart::create([
            'total' => 0
        ]);
        $data['cart_id'] = $cart->cart_id;

        $user = User::create($data);

        Auth::login($user);

        return redirect()
            ->route('home')
            ->with('status.message', 'El usuario <b>' . Auth::user()->email . '</b> se creó correctamente');
    }

    public function myProfile(int $id)
    {
        $user = User::findOrFail($id);

        return view('users.profile.index', [
            // 'user' => $user,
            'user' => $user
        ]);
    }

    public function formEdit(int $id)
    {
        $user = User::findOrFail($id);

        return view('users.profile.edit', [
            'user' => $user,

        ]);

    }

    public function processEdit(int $id, Request $request)
    {
        $user = User::findOrFail($id);

        $request->validate(User::$updateRules, User::$errorMessages);

        $data = $request->except(['_token']);

        $user->update($data);

        return redirect()
            ->route('profile.index', ['id' => $user->user_id])
            ->with('status.message', 'Los datos se editaron correctamente');

    }
}
