<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class LmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'tanar']);
        $role = Role::create(['name' => 'diak']);
        //
    }
}
