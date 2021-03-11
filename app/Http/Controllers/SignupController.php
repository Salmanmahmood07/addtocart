<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Session;
use DB;
use Input;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Routing\Redirector;

class SignupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signup()
    {
        return view('signup');
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
    public function usersignup(Request $request)
    {
        $obj = new User();
        $obj->name=$request->name;
        $obj->email=$request->email;
        $obj->password=\Hash::make($request->password);
        $obj->verifyToken = Hash::make(uniqid());
        $obj->type='User';

    if($obj->save()){
            return Response::json(['success' => '1','message' => 'User registered successfully']);

          }
          else {
            return Response::json(['success' => '0','validation'=>'0','message' => 'Something is wrong. Please try again.']);

          }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_authenticate(Request $request)
    {
        $messages=array(
        'email.required'=>'This field is required',
        'email.email'=>'Invalid Email',
        'password.password'=>'This field is required'
      );
      $rules=array(
        'email'=>'required|email',
        'password'=>'required|min:5|max:18'
      );
      $validator=\Validator::make($request->all(),$rules,$messages);
      if ($validator->fails())
      {
      return back()->withErrors($validator)->withInput();
    }else {
      $data = User::where('email','=',$request->email)->first();
      if($data){
        if(\Hash::check($request->password, $data->password))
        {
          if($data->type=='User'){

         Auth::attempt(['email' => $request->email, 'password' => $request->password]);
         Session::put('user_id', $data->id);
         Session::put('user_name', $data->name);
         Session::put('email', $data->email);
         //dd($data);
          return redirect('/home');
         //return view('/tutor.dashboard');
          }
       }
       else {
             Session::flash('login_feedback', 'Invalid User.');
             return back()->withErrors($validator)->withInput();
           }
     }else
     {
       Session::flash('login_feedback', 'Provided credentials are incorrect. Please try again');
       return back()->withErrors($validator)->withInput();
     }
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
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
}
