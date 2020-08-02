<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller {
    private $errorMessages = [
        'incorrectLogin' => 'The email or password is incorrect'
    ];

    public function login () {
        return view('login.index');
    }

    public function loginPost() {
        if (auth()->attempt(request(['email', 'password'])) === false) {
            return redirect()->back()->withErrors(['message' => $this->errorMessages['incorrectLogin']]);
        }

        return redirect()->to('/myTokens');
    }

    public function logout (){
        auth()->logout();
        return redirect()->to('/');
    }
}
