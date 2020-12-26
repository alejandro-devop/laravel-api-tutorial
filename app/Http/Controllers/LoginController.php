<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user()?: new User();
            $user->generateToken();
            return response()->json([
                'data' => $user->toArray(),
            ]);
        } else {
            return response()->json(['message' => 'Fail to authenticate'], 401);
        }
        // return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();
        if ($user && $user instanceof User) {
            $user->api_token = null;
            $user->save();
        }
        return response()->json(['data' => 'User logged out'], 200);
    }
}
