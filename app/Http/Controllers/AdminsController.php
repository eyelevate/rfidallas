<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AdminsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $customers = $user->getOnlineByRole($user->allOnline(),4);
        $employees = $user->getOnlineByRole($user->allOnline(),3);
        $managers = $user->getOnlineByRole($user->allOnline(),2);
        $partners = $user->getOnlineByRole($user->allOnline(),1);
        return view('admins.index',compact('customers','employees','managers','partners'));
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('admins_index');
        }
        return view('admins.login');
    }

    public function authenticate(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            if (Auth::user()->role_id > 3) {
                flash()->message('Successfully logged in, however, you are not authorized to view this page.')->warning();
                return redirect()->route('home');
            } else {
                flash()->message('Successfully logged in as '.Auth::user()->email.'!')->success();
                return (session()->has('intended_url')) ? redirect()->to(session()->get('intended_url')) : redirect()->intended('/admins');
            }
           
        } else {
           flash()->message('Could not log you in please try again..')->error();
           Auth::logout();
           return redirect()->route('admins_login'); 
        }

    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            flash()->message('Successfully logged out!')->success();
        } else {
            flash()->message('Warning: no instances of a logged in session remaining. Please try logging in again.')->warning();
        }

        return redirect()->route('admins_login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
