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
    private $validations = [
        'name'              => 'string|max:50|nullable',
        'surname'           => 'string|max:50|nullable',
        'email'             => 'required|string|email|max:255|unique:users',
        'password'          => 'required|confirmed|min:8',
    ];

    private $validationMessages = [
        'required'              => 'Campo obbligatorio.',
        'min'                   => 'Il campo :attribute deve avere almeno :min caratteri.',
        'max'                   => 'Il campo :attribute non deve superare i :max caratteri.',
    ];

    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate($this->validations, $this->validationMessages);

        $data = $request->all();

        $user = User::create([
            'name' => ucwords($data['name']),
            'surname' => ucwords($data['surname']),
            'email' => strtolower($data['email']),
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
