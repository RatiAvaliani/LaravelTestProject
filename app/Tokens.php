<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use App\RequestLogs;
use Illuminate\Http\Request;

class Tokens extends Model {

    static $messages = [
        'wrongId' => 'This Token dose\'t exists or your trying to get to other users token (sorry but you can\'t)',
        'accountStatus' => 'This account needs to be activated',
        'successCreate' => 'New token created',
        'successRemove' => 'Token removed'
    ];

    public static function getAll () {
        return \DB::select('SELECT id, access_token, expires_at FROM user_tokens WHERE user_id = :id', ['id' => Auth::user()->id]);
    }

    public static function remove ($tokenId, $tokenReturn=null) {
        $userId = Auth::user()->id;
        RequestLogs::create($userId, $tokenId, $_SERVER['REQUEST_METHOD'], json_encode(['tokenId' => $tokenId]), 'Remove');

        $res = \DB::delete('DELETE FROM user_tokens WHERE id = :id AND user_id = :user_id', ['id' => $tokenId, 'user_id' => $userId]);

        if ($res === 0) {
            if (!is_null($tokenReturn)) return ['status' => 0, 'message' => self::$messages['wrongId']];

            return redirect()->back()->withErrors(['message' => self::$messages['wrongId']]);
        }

        if (!is_null($tokenReturn)) return ['status' => 1, 'message' => self::$messages['successRemove']];
        return redirect()->back();
    }

    public static function create ($tokenReturn=null) {
        $userId = Auth::user()->id;
        $token = Auth::user()->createToken('authToken')->accessToken;
        $expDate = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") . ' + 30 days'));

        \DB::insert('INSERT INTO user_tokens (user_id, access_token, expires_at) 
	                            SELECT ?, ?, ?
    	                            WHERE IF ((SELECT is_verified FROM users WHERE id = ?) = 1, true, false)',

            [$userId, $token, $expDate, $userId]);

        $tokenId = \DB::getPDO()->lastInsertId();

        if ((int) $tokenId ==  0) {
            if (!is_null($tokenReturn)) return ['status' => 0, 'message' => self::$messages['accountStatus']];

            return redirect()->back()->withErrors(['message' => self::$messages['accountStatus']]);
        }

        RequestLogs::create($userId, $tokenId, $_SERVER['REQUEST_METHOD'], json_encode($_REQUEST), 'Create');

        if (!is_null($tokenReturn)) return ['status' => 1, 'message' => self::$messages['successCreate'], 'token' => $token];
        return redirect()->back();
    }
}
