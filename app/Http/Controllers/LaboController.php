<?php

namespace App\Http\Controllers;

class LaboController extends BaseController
{

    public function index()
    {
        $this->setTitle('Hehehe');

        return view('labo_index', ['title' => $this->getTitle()]);
    }
}
