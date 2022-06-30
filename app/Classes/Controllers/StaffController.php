<?php

namespace Classes\Controllers;

/*Кнопка 1 «испытательный срок»:
В табличном виде выводятся все сотрудники в алфавитном порядке у которых не пройден испытательный срок (3 месяца с даты устройства)

Кнопка 2 «Уволенные»
В табличном виде выводятся на текущую дату все уволенные сотрудники с причинами.

Кнопка 3 «Начальники»
В табличном виде выводится последний нанятый сотрудник у каждого начальника. */


use Classes\Models\User;
use Classes\Utility\Facades\View\View;
use Classes\Utility\HttpRequest\Request;

class StaffController extends Controller
{
    public function index(Request $request) {

    }

    public function fired() {

    }

    public function hired() {

    }

    public function single(Request $request) {
        View::render('user/user');
    }


}