<?php

use App\Helpers\Utils;

$manage_profil = Utils::have_access("manage_profil");
$manage_admin = Utils::have_access("manage_admin");

?>

<?php if ($manage_profil != "0_0_0_0" || $manage_admin != "0_0_0_0") : ?>

<li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">{{trans('messages.user_manage')}}</span>
</li>
    <?php if ($manage_profil != "0_0_0_0") : ?>
    <?php $test = explode('_', $manage_profil) ?>

<li class="nav-item">
    <a class="nav-link menu-link" href="#sidebarUserProfil" data-bs-toggle="collapse" role="button"
       aria-expanded="false" aria-controls="sidebarUserProfil">
        <i class="ri-dashboard-2-line"></i> <span
            data-key="t-user-profil">{{trans('messages.menu_profil_admin')}}</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarUserProfil">
        <ul class="nav nav-sm flex-column">
                <?php if ($test[0] == 1) : ?>

            <li class="nav-item">
                <a href="{{route('profil.create')}}" class="nav-link" data-key="t-add-profil">
                    {{trans('messages.add_profil_menu')}} </a>
            </li>
            <?php endif; ?>

                <?php if ($test[1] == 1 or $test[2] == 1 or $test[3] == 1) : ?>

            <li class="nav-item">
                <a href="{{route('profil.index')}}" class="nav-link"><span
                        data-key="t-list-profil">{{trans('messages.all_profil_admin')}}</span>
                </a>
            </li>
            <?php endif; ?>

        </ul>
    </div>
</li>
<?php endif ?>


    <?php if ($manage_admin != "0_0_0_0") : ?>
    <?php $test = explode('_', $manage_admin) ?>


<li class="nav-item">
    <a class="nav-link menu-link" href="#sidebarUser" data-bs-toggle="collapse" role="button"
       aria-expanded="false" aria-controls="sidebarUser">
        <i class="ri-dashboard-2-line"></i> <span data-key="t-user">{{trans('messages.menu_otheradmin')}}</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarUser">
        <ul class="nav nav-sm flex-column">
                <?php if ($test[0] == 1) : ?>

            <li class="nav-item">
                <a href="{{route('user.create')}}" class="nav-link" data-key="t-add-user">
                    {{trans('messages.add_admin')}} </a>
            </li>
            <?php endif ?>

                <?php if ($test[1] == 1 or $test[2] == 1 or $test[3] == 1) : ?>
            <li class="nav-item">
                <a href="{{route('user.index')}}" class="nav-link"><span
                        data-key="t-list-user">{{trans('messages.all_admin')}}</span>
                </a>
            </li>
            <?php endif ?>

        </ul>
    </div>
</li>
<?php endif; ?>

<?php endif; ?>
