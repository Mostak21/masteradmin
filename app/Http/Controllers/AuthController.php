<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register');
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);


        $user= new User;
        $user->name=$request->name;
        $user->email=$request->email;
        if($request->password==$request->confirmpassword)
        {
            $user->password= Hash::make($request->password);
        }

       if($user->save()) {

           return redirect('login');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
    }


    public function login(){
        return view('login');
    }

    public function loginattempt(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user=User::where('email',$request->email)->first();
        //dd($user);
        if($user){
            if(Hash::check($request->password,$user->password)){
                auth()->login($user, true);
                return redirect()->route('dashboard');
            }
            else{
                return redirect()->route('login')->with('passworderror', 'Incorrect Password');
            }
        }
        else{
            return redirect()->route('login')->with('emailerror', 'No user Associate with this email');
        }

    }
}
