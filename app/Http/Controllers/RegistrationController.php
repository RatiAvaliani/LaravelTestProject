<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegistrationController extends Controller {

    public function register () {
        return view('registration.create');
    }

    public function registerPost () {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $registeredUser = User::create(request(['name', 'email', 'password']));

        auth()->login($registeredUser);

        return redirect()->to('/myTokens');
    }
}
