<?php

namespace Database\Seeders;

use App\Helpers\CodeStatus;
use App\Models\users\User;
use App\Models\users\UserProfil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin_profil = UserProfil::query()->where('name',CodeStatus::USER_PROFIL_SUPER_ADMIN)->first();

        $data = [
            'user1' => [
                'username' => 'super.admin',
                'email' => 'super.admin@project.com',
                'password' => \Hash::make('Azerty123'),
                'status' => 10,
                'firstname' => 'Super',
                'lastname' => 'Admin',
                'gender' => null,
                'user_profil_id' => $super_admin_profil?->id ?? null,
                'user_parent_id' => 0,
            ],
        ];

        \Schema::disableForeignKeyConstraints();
        User::query()->truncate();
        foreach ($data as $user) {
            User::query()->create($user);
        }
        \Schema::enableForeignKeyConstraints();
    }
}
