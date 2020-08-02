<?php

namespace App\Http\Controllers;

use App\Tokens;
use App\User;
use App\RequestLogs;
use Illuminate\Http\Request;

class TokensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('tokens.index', ['tokens' => Tokens::getAll(), 'tokenLogs' => RequestLogs::getAll(), 'requestCount' => User::requestCount()]);
    }

    public function create() {
        return Tokens::create();
    }

    public function destroy($id) {
        return Tokens::remove($id);
    }
}
