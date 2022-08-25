<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:8"
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 406);
        }

        try {
            $user = new User();
            $user->name = $validator->getData()['name'];
            $user->email = $validator->getData()['email'];
            $user->password = Hash::make($validator->getData()['password']);
            $user->setRememberToken(Str::random(70));

            $user->save();

            // send verification code to the email
            echo $user->email;

            $success = true;
            $message = "User register successfully";

            $response = [
                'success' => $success,
                'message' => $message
            ];

            return response($response, 201);


        } catch (\Exception $err) {
            $success = false;
            $message = $err;
            $response = [
                'success' => $success,
                'message' => $message
            ];
            return response($response, 401);
        }


    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->only('email', 'password'), [
            "email" => "required|string|email|max:255",
            "password" => "required|string|min:8"
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 406);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            echo Auth::attempt($credentials); // 1 if auth user else 0
            $user = User::where('email', $request['email'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;
            return Response(['access_token' => $token, 'token_type' => 'Bearer',], 200);
        }
    }

    public function activate_account(Request $request, $token)
    {
        $remember_token = $token;
        try {
            $user = User::where('remember_token', $token)->firstOrFail();
            $user->remember_token = Null;
            $user->email_verified_at = now();
            $user->save();

            return Response(["message" => "User Activated"], 200);
        } catch (\Exception $err) {
            return Response(["message" => "User not found"], 404);
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the currently authenticated user...
        $user = Auth::user();

        // Get the currently authenticated user's ID...
        $id = Auth::id();

        // Determining If The Current User Is Authenticated
        if (Auth::check()) {
            echo 'false';
        }

        $users = User::paginate(3);
//        $users = User::orderBy('created_at', 'asc')->get();
        return Response($users, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $user = User::
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
