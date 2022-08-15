<?php

namespace Classes\Controllers;

use Classes\Models\User;
use Classes\Utility\Facades\View\View;
use Classes\Utility\HttpRequest\Request;

class StaffController extends Controller
{
    public function index(Request $request) {

    }

    public function create():void {
        View::render('user/create');
    }

    public function store(Request $request) {

    }

    public function single(Request $request):void {
        $request->get('');
        View::render('user/user');
    }
}