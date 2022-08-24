<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\user;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUsers() 
    {
        return user::all();
    }

    public function store(Request $request)
    {

        // instanciate a new user
        $user = new user;
        // user->name (table and value) = $request->name (frontend inputs)
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $result = $user->save();

        if($result) {
            return redirect('/');
        }else {
            return 'Unable to register';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */

    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }

    public function verifyUser(Request $request)
    {

        $email = $request->email;
        $password = $request->password;

        $emailUser = DB::table('users')->where('email', $email)->value('email');
        $passwordUser = DB::table('users')->where('password', $password)->value('password');

        if($emailUser !== null) {
            if($passwordUser !== null) {
                return redirect('/');
            }else {
                // return 'Wrong password';
                dd('wrong password');
            }
        }else {
            dd('wrong email');
        }

    }
}
