<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Profile;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Throwable;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'birthday' => ['required', 'date', 'before:now'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::beginTransaction();
        try{
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // $profile=Profile::create([
            //     'user_id'=>$user->id,
            //     'first_name'=>$request->first_name,
            //     'last_name'=>$request->last_name,
            //     'birthday'=>$request->birthday,
            // ]);

            $profile= $user->profile()->create([
                'user_id'=>$user->id,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'birthday'=>$request->birthday,
            ]); //من خلال العلاقه
            DB::commit(); //لاعتماد العمليات
        }catch(Throwable $e){
            DB::rollBack(); //التراجع عن العمليات
            throw $e;//بدونها هيعمل لوجن لليوزر وهوا اصلا م في يوزر
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
