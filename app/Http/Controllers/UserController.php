<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all users in database
        $users = User::all();
        return $users;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create a new user
        $userCheck = User::where([
            ['email', $request->email]
        ])->first();

        if ($userCheck) return ["failed" => "this email is already registered"];

        $user = new User;

        $user->email = $request->email;
        $user->password = $request->password;
        $user->name = $request->name;

        $user->save();

        return $user;
    }

    public function login(Request $request)
    {
        // Find a user in database by credentials
        $user = User::where([
            ['email', $request->email],
            ['password', $request->password]
        ])->first();

        if ($user) {
            http_response_code(200);
            return $user;
        } else {
            http_response_code(400);
            return ["error" => "Email or Password wrong"];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete a user
        
    }
}
