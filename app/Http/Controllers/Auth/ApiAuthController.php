<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function login()
    {
        $validate = Validator::make(request()->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ], [
            'email.exists' => 'invalid email',
            'email.required' => 'email required',
            'password.required' => 'password required',
        ]);

        if ($validate->fails()) {
            return entityResponse($validate->errors(), 422, 'error', 'Validation Error');
        }

        try {
            $condition = ['status' => 1, 'email' => request()->input('email')];
            $user = User::query()->where($condition)->first();
            if (! Hash::check(request()->input('password'), $user->password)) {
                return '';
            }
            $payload = $user->toArray();
            $payload = ['id' => $user->id, 'name' => $user->name];
            $token = $this->guard()
                ->claims($payload)
                ->setTTL(request()->input('remember_me') ? 60 * 60 : 30 * 60)
                ->login($user, request()->input('remember_me') ?? false);

            return entityResponse([
                "token" => $token,
                "user" => $user,
            ], 201, 'success', 'Login successful');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function me()
    {
        try {
            $fields = ['id', 'name', 'email', 'status'];
            $relations = [];
            $condition = ['id' => $this->guard()->id()];

            $user = User::query()->with($relations)->select($fields)->where($condition)->first();

            return entityResponse([
                "user" => $user,
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function register()
    {
        try {
            $data = request()->all();
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            return entityResponse($user);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    private function guard()
    {
        return Auth::guard('api');
    }


    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jwtlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }
}
