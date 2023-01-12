<?php

namespace App\Http\Controllers\dashboard;

use App\Helpers\Utils;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Traits\SelectMenu;

class DashboardController extends BaseController
{
    use SelectMenu;
    public function __construct()
    {
        $this->setSelectMenu('BOARD');
    }

    public function index()
    {
        Utils::Rule('manage_dashboard', 'ALL');
        $this->setSelectSmenu("READ_DASHBOARD");
        $this->select_menu();

        return view('dashboard.dashboard');
    }
}
