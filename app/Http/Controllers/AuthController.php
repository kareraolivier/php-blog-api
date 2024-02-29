<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\UnauthorizedException;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Register a newly created user in storage.
     */
    public function register(Request $request)
    {
        //validating fields for user
        $fields = $request->validate(
            [
                'name' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|confirmed'
            ]
        );

        //creating user
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    /**
     * Search the specified email from user.
     */

    public function getEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * Login a  user in storage.
     */
    public function login(Request $request)
    {
        $fields = $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );
        //check email if it exist
        $user = $this->getEmail($fields['email']);

        //check password of a client
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        };

        //creating token
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 200);

        // return response()->json(['error' => 'Unauthorized'], 401);
    }


    /**
     * Logout the logined in user
     */
    public function logout()
    {
        /** @var \Laravel\Sanctum\HasApiTokens $user */
        $user = auth()->user();
        $user->tokens()->delete();
        return ['message' => 'Logged out'];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = User::find($id);
        $update->update($request->all());
        return $update;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return User::destroy($id);
    }
}
