<?php

namespace App\Http\Controllers;

class LaboController extends BaseController
{

    public function index()
    {
        $this->title = 'Hehehe';

        return view('labo_index', ['title' => $this->title]);
    }
}
