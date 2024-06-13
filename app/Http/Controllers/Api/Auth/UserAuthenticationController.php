<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\MailSendEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SigninRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\Repositories\VerificationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthenticationController extends Controller
{
    public function signIn(SigninRequest $request)
    {
        $user = UserRepository::findByEmail($request->email);

        $credentials = ['email' => $user->email, 'password' => $request->password];
        if (Auth::attempt($credentials)) {
            return $this->json('Signed in successfully', [
                'user' => new UserResource($user),
                'access' => UserRepository::getAccessToken($user),
            ]);
        }

        return $this->json('Credential is invalid!', [], 422);
    }

    public function forgotPassword(Request $request)
    {
        $user = UserRepository::findByEmail($request->email);
        if (!$user) {
            return $this->json('Invalid email address!', [], 422);
        }

        $varificationCode = VerificationRepository::storeByRequest($user);
        MailSendEvent::dispatch($user, $varificationCode, 'forgot-password');

        return $this->json('Recovery email successfully send', []);
    }

    public function checkOtp(Request $request)
    {
        $varificationCode = VerificationRepository::query()->where('email', $request->email)->first();

        if ($varificationCode->code != $request->otp) {
            return $this->json('Credential is invalid OTP!', [], 422);
        }

        $varificationCode = VerificationRepository::updateByRequest($varificationCode);

        return $this->json('Signed in successfully', [
            'token' => $varificationCode->token,
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $varificationCode = VerificationRepository::query()->where('token', $request->token)->first();
        $user = UserRepository::query()->where('email', $varificationCode->email)->first();
        UserRepository::resetPassword($request, $user);
        return $this->json('Your password is changed successfully.');
    }

    public function logout()
    {
        $user = auth()->user();
        $user->token()->revoke();
        return $this->json('Signed out successfully');
    }
}
