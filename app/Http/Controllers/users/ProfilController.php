<?php

namespace App\Http\Controllers\users;

use App\Helpers\CodeStatus;
use App\Http\Controllers\BaseController;
use App\Models\users\AccessRight;
use App\Models\users\ProfilAccess;
use App\Models\users\UserProfil;
use Illuminate\Http\Request;

class ProfilController extends BaseController
{
    public function index()
    {

        $profils = UserProfil::query()->whereIn('etat', [CodeStatus::ETAT_ACTIVE, CodeStatus::ETAT_INACTIVE])->get()->all();

        $this->title = trans('messages.liste_profil_menu');

        return view('users.profil.index', ['title' => $this->title, 'profils' => $profils]);
    }

    public function create()
    {

        $user_module = [];
        $model = null;
        $access_rights = AccessRight::query()->where('etat', CodeStatus::ETAT_ACTIVE)->get()->all();

        $this->title = trans('messages.add_profil_menu');

        return view('users.profil.form', ['title' => $this->title, 'model' => $model, 'user_module' => $user_module, 'access_rights' => $access_rights]);

    }

    public function store(Request $request)
    {
        $post = $request->all();

        $user_module = [];

        $module_ids_recup = $post['all_module'];

        if (trim($post['name'] != '')) {
            $module_ids = explode('_', $module_ids_recup);
            $all_module = '';

            if (sizeof($module_ids) > 0) {
                foreach ($module_ids as $module_id) {
                    $create_info = "0";
                    $delete_info = "0";
                    $read_info = "0";
                    $update_info = "0";

                    if (isset($post[$module_id . '_CREATE'])) {
                        if ($post[$module_id . '_CREATE'] == 1) $create_info = 1;
                    }
                    if (isset($post[$module_id . '_LIST'])) {
                        if ($post[$module_id . '_LIST'] == 1) $read_info = 1;
                    }

                    if (isset($post[$module_id . '_UPDATE'])) {
                        if ($post[$module_id . '_UPDATE'] == 1) $update_info = 1;
                    }

                    if (isset($post[$module_id . '_DELETE'])) {
                        if ($post[$module_id . '_DELETE'] == 1) $delete_info = 1;
                    }

                    $information = $module_id . '_' . $create_info . '_' . $read_info . '_' . $update_info . '_' . $delete_info;


                    if ($information != $module_id . "_0_0_0_0") {
                        if ($all_module == "") {
                            $all_module = $information;
                        } else {
                            $all_module .= ";" . $information;
                        }
                    }
                }

                $test_name = UserProfil::query()->where('name', $post['name'])
                    ->whereIn('etat', [CodeStatus::ETAT_ACTIVE, CodeStatus::ETAT_INACTIVE])->first();

                if ($test_name != null) {
                    $message = trans('messages.profil_exist');
                    $user_module = $this->createProfilAccess([
                       'all_module' => $all_module,
                       'profil_id' => null,
                       'user_id' => auth()->user()->id
                    ]);
                } else {
                    date_default_timezone_set('UTC');

                    $new_profil = new UserProfil();
                    $new_profil->name = $post['name'];
                    $new_profil->description = $post['description'];
                    $new_profil->etat = 1;
                    $new_profil->created_by = auth()->user()->id;
                    $new_profil->created_at = date("Y-m-d H:i:s");

                    if ($new_profil->save()) {
                        $user_module = $this->createProfilAccess([
                            'all_module' => $all_module,
                            'profil_id' => $new_profil->id,
                            'user_id' => auth()->user()->id
                        ], true);
                        return redirect()->route('profil.index')->with('success', trans('messages.profil_succes'));
                    } else {
                        $message = trans('messages.update_error');

                    }
                }
            } else {
                $message = trans('messages.update_error');

            }
        } else {
            $message = trans('messages.profil_empty');
        }
        \Session::flash('error', $message);
        return back()->withInput()->with('user_module', $user_module);
    }


    private function createProfilAccess(array $data, bool $action_save = false)
    {
        $user_module = [];
        $array_all_module = explode(';', $data['all_module']);
        foreach ($array_all_module as $module) {
            $info_module = explode('_', $module);
            if (sizeof($info_module) == 5) {
                $new_access = new ProfilAccess();
                $new_access->user_profil_id = $data['profil_id'];
                $new_access->access_right_id = $info_module[0];
                $new_access->pcreate = $info_module[1];
                $new_access->pread = $info_module[2];
                $new_access->pupdate = $info_module[3];
                $new_access->pdelete = $info_module[4];
                $new_access->created_by = $data['user_id'];
                $new_access->etat = 1;
                $new_access->created_at = date("Y-m-d H:i:s");
                if ($action_save) {
                    $new_access->save();
                } else {
                    $user_module[] = $new_access;
                }
            }
        }
        return $user_module;
    }

    public
    function show(UserProfil $profil)
    {

    }

    public
    function edit(UserProfil $profil)
    {

    }

    public
    function update(UserProfil $profil)
    {

    }

    public
    function destroy(UserProfil $profil)
    {

    }

    public
    function operations()
    {

    }

}
