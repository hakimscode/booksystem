<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'id' => 1,
                'role' => 'Super Admin'
            ],
            [
                'id' => 2,
                'role' => 'Admin'
            ],
            [
                'id' => 3,
                'role' => 'Non-Admin'
            ]
        ]);
    }
}
