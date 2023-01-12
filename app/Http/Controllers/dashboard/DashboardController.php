<?php

namespace App\Http\Controllers\dashboard;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        Utils::Rule('manage_dashboard','ALL');
        return view('dashboard.dashboard');
    }
}
