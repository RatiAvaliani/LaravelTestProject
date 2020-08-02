<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tokens;

class TokensController extends Controller {

    public function create() {
        return response(Tokens::create(true));
    }

    public function destroy($id) {
        return response(Tokens::remove($id, true));
    }
}
