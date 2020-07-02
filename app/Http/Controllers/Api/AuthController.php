<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use http\Env\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => DB::table('users')->where('id', Auth::user()->id)->first(),
        ]);
    }

    public function register(Request $request)

    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|unique:users,phone',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ]);

        $user = new User();
        $user->name = $request->get('name');
        $user->phone = $request->get('phone');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        $token = $user->createToken('App');

        return response()->json([
            'success' => true,
            'token' => $token->plainTextToken
        ]);

    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|unique:users,phone,' . $id,
        ]);

        $user->fill($request->only([
            'name',
            'phone',
        ]));

        if (strlen($request->get('password')) > 6) {
            $user->password = bcrypt($request->get('password'));
        }



        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'User info has been updated successfully.',
            'data' => User::where('id', Auth::user()->id)->first(),
        ]);
    }

    public function login(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        $user = User::where('phone', $username)->orWhere('email', $username)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'The email or phone number does not exist.'
            ], 401);
        }

        $isPasswordSame = Hash::check($password, $user->password);

        if (!$isPasswordSame) {
            return response()->json([
                'success' => false,
                'message' => 'The password is invalid.'
            ]);
        }

        return response()->json([
            'success' => true,
            'token' => $user->createToken('App')->plainTextToken,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone
            ]
        ]);
    }
}
