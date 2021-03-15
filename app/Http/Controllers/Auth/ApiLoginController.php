<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class ApiLoginController extends Controller
{
    use ThrottlesLogins;

    public function login(UserRequest $request)
    {
        $user = User::where('email', $request->get('email'))->first();
        $user->withAccessToken($user->createToken('access-token'));

        return fractal($user, new UserTransformer())
            ->parseIncludes('access_token')
            ->respond();
    }
}
