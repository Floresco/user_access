<?php

namespace Database\Seeders;

use App\Models\users\AccessRight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessRightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'wording' => 'manage_admin',
            ],
            [
                'wording' => 'manage_profil',
            ],
        ];

        \Schema::disableForeignKeyConstraints();
        AccessRight::query()->truncate();
        foreach ($data as $access_right) {
            AccessRight::query()->create($access_right);
        }
        \Schema::enableForeignKeyConstraints();
    }
}
