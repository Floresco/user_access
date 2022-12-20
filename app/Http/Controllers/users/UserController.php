<?php

namespace App\Http\Controllers\users;

use App\Helpers\CodeStatus;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\users\ProfilAccess;
use App\Models\users\UserProfil;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function index() {}

    public function create() {
        $model = null;
        $profils = UserProfil::query()
            ->whereIn('etat', [CodeStatus::ETAT_ACTIVE, CodeStatus::ETAT_INACTIVE])
            ->where('name','<>',CodeStatus::USER_PROFIL_SUPER_ADMIN)
            ->get()->all();

        $this->title = trans('messages.add_user_menu');

        return view('users.users.index', ['title'=>$this->title, 'model' => $model, 'profils' => $profils]);
    }

    public function store(Request $request){}
}
