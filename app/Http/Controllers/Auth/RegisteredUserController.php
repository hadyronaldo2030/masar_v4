<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'jobTitle' => ['required', 'string', 'max:255'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'role' => ['sometimes', 'nullable', 'in:hr,finance,manger,dataentry,employee'],

        ]);

        // Upload Images 
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->move(public_path('images'), $request->file('image')->getClientOriginalName()); 
        }

        $imageName2 = null;
        if ($request->hasFile('image2')) {
            $imageName2 = time() . '2.' . $request->image2->extension();
            $request->image2->move(public_path('images'), $imageName2);
        }

        $imageName3 = null;
        if ($request->hasFile('image3')) {
            $imageName3 = time() . '3.' . $request->image3->extension();
            $request->image3->move(public_path('images'), $imageName3);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jobTitle' => $request->jobTitle,
            'image' => $imagePath ? $imagePath->getFilename() : null,
            'role' => $request->role ? : 'admin',
            'age' => $request->age,
            'salary' => $request->salary,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'gender' => $request->gender,
            'department' => $request->department,
            'status' => $request->status,
            'image' => $imagePath,
            'image2' => $imageName2 ?? '',
            'image3' => $imageName3 ?? '',        
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
