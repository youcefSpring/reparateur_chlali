<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\ShopCategoryRepository;
use App\Repositories\EmailVerificationRepository;
use App\Repositories\GeneralSettingRepository;
use App\Repositories\ShopRepository;
use App\Http\Requests\ShopOwnerRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function signup()
    {
        $shopCategories = ShopCategoryRepository::getAll();
        return view('auth.registration', compact('shopCategories'));
    }

    public function signupRequest(ShopOwnerRequest $request)
    {
        if (!config('mail.mailers.smtp.username') || !config('mail.mailers.smtp.password')) {
            return back()->with('error', 'Now you can not do signup because admin have not configured signup yet');
        }
        $user = UserRepository::storeByRequest($request);
        $shop = ShopRepository::storeByRequest($request, $user);
        GeneralSettingRepository::storeByRequest($request, $shop);
        $user->shopUser()->attach($shop->id);
        $user->assignRole('admin');
        EmailVerificationRepository::sendMailByUser($user);
        return to_route('signin.index')->with('success', 'Sign Up successfully done! Please check your email inbox or spam');
    }

    public function varification($token)
    {
        $varificationCode = EmailVerificationRepository::query()->where('token', $token)->first();
        if (!$varificationCode) {
            return to_route('signin.index')->with('error', 'This Email already varified!');
        }
        UserRepository::emailVarifyAt($varificationCode->user);
        $varificationCode->delete();
        return to_route('signin.index')->with('success', 'Email successfully varified! But wait for authorize confirmation');
    }
}
