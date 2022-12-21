<?php

namespace App\Helpers;

use App\Models\users\ProfilAccess;

class Utils
{
    public static function have_access($wording_access_right)
    {
        try {
            $position = "0_0_0_0";

            $user = \Auth::user();

            if ($user) {

                if ($user->user_parent_id == 0) {
                    $position = "1_1_1_1";
                } else {
                    $profil_access = ProfilAccess::query()
                        ->join('access_rights', 'access_rights.id', '=', 'profil_access.access_right_id')
                        ->where('access_rights.wording', '=', $wording_access_right)
                        ->where('profil_access.user_profil_id', '=', $user->user_profil_id)->get()->all();
                    if (sizeof($profil_access) == 1) {
                        $position = $profil_access[0]['pcreate'] . "_" . $profil_access[0]['pread'] . "_" . $profil_access[0]['pupdate'] . "_" . $profil_access[0]['pdelete'];
                    }
                }
            }

            return $position;
        } catch (\Exception $e) {
            return redirect()->route('login');
        }
    }

    public static function emptyContent()
    {
        return '<div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show" role="alert">
    <i class="ri-error-warning-line label-icon"></i><strong>' . trans('messages.liste_empty') . '</strong>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }

    public static function required()
    {
        return ' <span style="color:red">**</span>';
    }

    public static function reset_btn(): string
    {
        return '<button type="reset" name="Reset" class="btn btn-sm btn-danger bg-gradient-dark float-end" style="margin-left:10px;margin-right:20px">'.trans('messages.resetbutton').'</button>';
    }

    public static function back_btn(string $url, array $params = []): string
    {
        return '<a href="' . route($url, $params) . '" class="btn btn-sm btn-info bg-gradient-dark float-end" style="margin-left:10px;margin-right:20px">' . trans('messages.back') . '</a>';
    }

    public static function submit_btn(): string
    {
        return '<button type="submit" id="updatebutton" class="btn btn-primary btn-sm float-end mb-0" name="updatebutton">'.trans('messages.submitbutton').'</button>';
    }
}
