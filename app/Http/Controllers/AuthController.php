<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth',['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email|string',
            'password' => 'required|string'
        ];

        $this->validate($request,$rules);

        $credentials = $request->only('email','password');

        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'status' => 'fail',
                'code' => 401,
                'message' => 'Unauthorized'
            ],Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'data' => [
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer'
                ]
            ]
        ],Response::HTTP_OK);
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string',
            'password' => 'required|string'
        ];

        $this->validate($request,$rules);

        $user = User::create([
            'name' => $request->input('name'),
            'email'=> $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
        // $user = DB::table('users')->insert([
        //     'name' => $request->input('name'),
        //     'email'=> $request->input('email'),
        //     'password' => Hash::make($request->input('password'))
        // ]);

        $token = Auth::login($user);

        return response()->json([
            'status' => 'success',
            'code' => 201,
            'data' => [
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer' 
                ]
            ]
        ],Response::HTTP_CREATED);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'data' => [
                'message' => 'Successfully logged out'
            ]
        ], Response::HTTP_OK);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'data' => [
                'user' => Auth::user(),
                'authorization' => [
                    'token' => Auth::refresh(),
                    'type' => 'bearer' 
                ]
            ]
        ],Response::HTTP_OK);
    }
}