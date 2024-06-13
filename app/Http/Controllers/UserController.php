<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(User $user)
    {
        return view('user.profile', compact('user'));
    }

    public function profileUpdate(UserRequest $request, User $user)
    {
        if (app()->environment('local')) {
            return back()->with('error', 'This section is not available for demo version!');
        }
        UserRepository::updateByRequest($request, $user);
        return back()->with('success', 'Profile is updated successfully!');
    }

    public function changePassword(ChangePasswordRequest $request, User $user)
    {
        if (app()->environment('local')) {
            return back()->with('error', 'This section is not available for demo version!');
        }
        $credentials = ['email' => auth()->user()->email, 'password' => $request->current_password];
        if (Auth::attempt($credentials)) {
            UserRepository::updateByPassword($request, $user);
            return back()->with('success', 'Password updated successfully!');
        }

        return back()->with("error", "Current Password doesn't match");
    }
}
