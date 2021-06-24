<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use App\Notifications\EmployeNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    { 
        $departements=Department::all();
        return view('auth.register',compact('departements'));
    }


    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'departement' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'unique:users'],
            'password' => 'required|string|confirmed|min:8',
            ]);
            // dd($request->all());
            $uuid= Str::uuid($request).'-'.Str::random(8);
        // dd($uuid);
        $department= Department::where('uuid',$request['departement'])->firstOrFail();

        $user = User::create([
            'uuid'=> $uuid,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'department_id' => $department->id,
        ]);
        // Auth::login($user);
        // dd(Auth::user());
        event(new Registered($user));
        
        $user->notify(new EmployeNotification());

        return view('auth.verify-email');
    }
}
