<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;
use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller{
    /**
     * 将用户重定向到GitHub认证页面
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * 从GitHub获取认证用户信息
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
        if (!User::where('github_id', $user->getId())->first()){
            $userModel = new User();
            $userModel->github_id = $user->getId();
            $userModel->email = $user->getEmail();
            $userModel->name = $user->getName();
            $userModel->avatar = $user->getAvatar();
            $userModel->save();
        }
        $userInstance = User::where('github_id', $user->id)->firstOrFail();
        Auth::login($userInstance);
        return redirect('/home');
    }

    public function register(RegisterFormRequest $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();
        return response([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        $credentials =  $request->only(['email', 'password']);
        if (! $token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
            return response(['status' => 'success',
                'token' => $token])
                ->header('Authorization', $token);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }
    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }

    public function logout()
    {
        JWTAuth::invalidate();
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

}
