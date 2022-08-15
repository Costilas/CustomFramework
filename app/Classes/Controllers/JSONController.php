<?php

namespace Classes\Controllers;

use Classes\Models\User;
use Classes\Utility\HttpRequest\Request;

class JSONController extends Controller
{
    public function getSingleUserJson(Request $request) {
        echo User::find($request->get('user_id'))?->toJSON();
    }
}