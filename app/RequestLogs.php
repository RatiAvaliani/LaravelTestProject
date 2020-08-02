<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class RequestLogs extends Model
{
    public static function create (...$variables) {
        \DB::insert('INSERT INTO user_request_logs SET user_id = ?, token_id = ?, request_method = ?, request_params = ?, comments = ?', $variables);
        self::updateRequestCount();
    }

    public static function getAll () {
        $userId = Auth::user()->id;
        return \DB::select('SELECT * FROM user_request_logs WHERE user_id = ?', [$userId]);
    }

    public static function updateRequestCount () {
        $userId = Auth::user()->id;
        \DB::update('UPDATE users SET requests_count = requests_count+1 WHERE id = ?', [$userId]);
    }
}
