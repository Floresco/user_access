<?php

namespace App\Http\Controllers\users;

use App\Helpers\CodeStatus;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\users\User;
use App\Models\users\UserProfil;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::query()
            ->whereIn('etat', [CodeStatus::ETAT_ACTIVE, CodeStatus::ETAT_INACTIVE])
            ->where('user_parent_id', '<>', 0)
            ->get()->all();

        $this->title = trans('messages.all_admin');

        return view('users.users.index', ['title' => $this->title, 'users' => $users]);
    }

    public function create()
    {
        $model = null;
        $profils = UserProfil::query()
            ->whereIn('etat', [CodeStatus::ETAT_ACTIVE, CodeStatus::ETAT_INACTIVE])
            ->where('name', '<>', CodeStatus::USER_PROFIL_SUPER_ADMIN)
            ->get()->all();

        $this->title = trans('messages.add_user_menu');

        return view('users.users.form', ['title' => $this->title, 'model' => $model, 'profils' => $profils]);
    }

    /**
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $test_email = User::query()->where('email', $validated['email'])->whereIn('etat', [CodeStatus::ETAT_ACTIVE, CodeStatus::ETAT_INACTIVE])->first();
        if ($test_email == null) {
            $test_phone = User::query()->where('phone', $validated['phone'])->whereIn('etat', [CodeStatus::ETAT_ACTIVE, CodeStatus::ETAT_INACTIVE])->first();
            if ($test_phone == null) {
                $user = new User($validated);
                $user->password = \Hash::make($validated['password']);
                $user->status = CodeStatus::USER_VERIFIED;
                $user->user_parent_id = auth()->id();
                $profil = UserProfil::find($validated['user_profil_id']);
                $model = $profil->users()->save($user);
                if ($model) {
                    \Session::flash('success', trans('messages.succes_creation_user'));
                    return redirect()->route('user.create');
                } else {
                    $message = trans('messages.update_error');
                }
            } else {
                $message = trans('messages.phone_used');
            }
        } else {
            $message = trans('messages.email_used');
        }

        \Session::flash('error', $message);
        return back()->withInput();
    }

    public function edit(User $user)
    {
        $model = $user;
        $profils = UserProfil::query()
            ->whereIn('etat', [CodeStatus::ETAT_ACTIVE, CodeStatus::ETAT_INACTIVE])
            ->where('name', '<>', CodeStatus::USER_PROFIL_SUPER_ADMIN)
            ->get()->all();

        $this->title = trans('messages.update_information') . ": " . $user->lastname . " " . $user->firstname;

        return view('users.users.form', ['title' => $this->title, 'model' => $model, 'profils' => $profils]);
    }

    public function update(User $user, UserRequest $request)
    {
        $validated = $request->validated();
        $test_email = User::query()
            ->where('email', $validated['email'])
            ->where('id', '<>', $validated['key'])
            ->whereIn('etat', [CodeStatus::ETAT_ACTIVE, CodeStatus::ETAT_INACTIVE])->first();
        if ($test_email == null) {
            $test_phone = User::query()
                ->where('phone', $validated['phone'])
                ->where('id', '<>', $validated['key'])
                ->whereIn('etat', [CodeStatus::ETAT_ACTIVE, CodeStatus::ETAT_INACTIVE])->first();
            if ($test_phone == null) {
                $user->update($validated);
                if ($user->save()) {
                    \Session::flash('success', trans('messages.update_success'));
                    return redirect()->route('user.index');
                } else {
                    $message = trans('messages.update_error');
                }
            } else {
                $message = trans('messages.phone_used');
            }
        } else {
            $message = trans('messages.email_used');
        }

        \Session::flash('error', $message);
        return back()->withInput();
    }

    public function editPassword(User $user)
    {
        $model = $user;
        $this->title = trans('messages.reset_password') . ": " . $user->lastname . " " . $user->firstname;

        return view('users.users.password_form', ['title' => $this->title, 'model' => $model]);
    }

    public function resetPassword(ResetPasswordRequest $request, User $user)
    {
        $validated = $request->validated();
        $user->password = \Hash::make($validated['password']);
        if ($user->save()) {
            \Session::flash('success', trans('messages.update_success'));
            return redirect()->route('user.index');
        } else {
            $message = trans('messages.update_error');
        }
        \Session::flash('error', $message);
        return back();
    }

    public function operation(User $user, Request $request)
    {
        $post = $request->all();
        $message = trans('messages.update_error');
        switch ($post['operation']) {
            case 1:
                $user->etat = $post['operation'];
                $message = trans('messages.active_user_success');
                break;
            case 2:
                $user->etat = $post['operation'];
                $message = trans('messages.desactive_user_success');
                break;
            case 3:
                $user->etat = $post['operation'];
                $message = trans('messages.delete_user_success');
                break;
        }
        if ($user->save()) {
            \Session::flash('success', $message);
            return redirect()->route('user.index');
        }
        \Session::flash('error', $message);
        return redirect()->back();
    }
}
