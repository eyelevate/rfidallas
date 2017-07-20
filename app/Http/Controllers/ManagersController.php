<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ManagersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $role = 2;
        $columns = $user->prepareTableColumns();
        $rows = $user->prepareTableRows($user->where('role_id',$role)->get(),$role);
        return view('managers.index', compact(['columns','rows']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('managers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate the form
        $this->validate(request(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create and save the user.
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Redirect to the previous page.

        flash('You successfully created a new manager.')->success()->important();
        
        return redirect()->route('managers_index');
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
    public function edit(User $manager)
    {
        return view('managers.edit',compact('manager'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $manager model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $manager)
    {

        if (trim($request->password == '')) {
            $this->validate(request(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|string|email|max:255'
            ]);
            $manager->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email
            ]);
        } else {
            $this->validate(request(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6|confirmed',
            ]);
            $manager->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => bcrypt($data['password']),
            ]);
        }

        flash('You have successfully updated a manager.')->success()->important();
        return redirect()->route('managers_index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $manager)
    {
        if($manager->delete()) 
        {
            flash('You have successfully deleted '.$manager->email.' as a manager.')->success();
            return redirect()->route('managers_index');
        }
    }
}
